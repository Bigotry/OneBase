<?php

namespace app\admin\logic;

use app\admin\service\AdminServiceBase;
use app\admin\logic\AuthRule;

/**
* admin模型逻辑基类
*/
class AdminBase extends AdminServiceBase
{

    //admin模块初始化操作
    public function AdminInit()
    {
        
        if( !MEMBER_ID ){
            
            return createJump('redirect', 'AdminPublic/login');
        }
        
        if (!IS_ROOT && config('admin_allow_ip')) {
            
            // 检查IP地址访问
            if (!in_array(get_client_ip(), explode(',', config('admin_allow_ip')))) {
                
                return createJump('error', '禁止访问!');
            }
        }
        
        // 检测系统权限
        if (!IS_ROOT) {
                
            if (!$this->checkRule($this->url,array('in', array(AuthRule::RULE_URL, AuthRule::RULE_MAIN)))) {

                return createJump('error', '未授权访问!');
            }
        }
        
    }
    
    
    
    /**
    * 权限检测
    * @param string  $rule    检测的规则
    * @param string  $mode    check模式
    * @return boolean
    */
    final protected function checkRule($rule, $type = AuthRule::rule_url, $mode='url')
    {
        static $Auth = null;

        if (!$Auth) {
            $Auth = new \com\Auth();
        }

        if (!$Auth->check($rule, MEMBER_ID, $type, $mode)) {
            return false;
        }

        return true;
    }
    
    
    
    
    /**
     * 返回后台节点数据
     * @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     */
    protected function returnNodes($tree = true)
    {
        static $tree_nodes = array();
        
        if ($tree && !empty($tree_nodes[(int)$tree])) {
            
            return $tree_nodes[$tree];
        }
        
        $menu_model = model('Menu');
        
        if ((int)$tree) {
            
            $list = $menu_model->getListAll('id,pid,title,url,tip,hide', 'sort asc');
            
            foreach ($list as $key => $value) {
                
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    
                    $list[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
            
            
            $nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);
            
            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            
            $nodes = $menu_model->getListAll('title,url,tip,pid', 'sort asc');
            
            foreach ($nodes as $key => $value) {
                
                if(stripos($value['url'], MODULE_NAME) !== 0){
                    
                    $nodes[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
        }
        
        $tree_nodes[(int)$tree]   = $nodes;
        
        return $nodes;
    }
    
    
    
    // 获取后台菜单
    public function getMenus()
    {
        
        $controller = CONTROLLER_NAME;
    
        $menu_model = model('Menu');

        // 获取主菜单
        $where['pid']   =   0;
        $where['hide']  =   0;

        $menus['main']  =  $menu_model->getMenuList($where, 'id,title,url', 'sort asc');

        $menus['child'] =   array(); //设置子节点

        foreach ($menus['main'] as $key => $item) {

            // 判断主菜单权限
            if ( !IS_ROOT && !$this->checkRule(strtolower(MODULE_NAME.'/'.$item['url']), AuthRule::RULE_MAIN, null) ) {
                unset($menus['main'][$key]);
                continue;//继续循环
            }

            if (CONTROLLER_NAME.'/'.ACTION_NAME == strtolower($item['url'])) {
                $menus['main'][$key]['class']='current';
            }

        }

        // 查找当前子菜单
        $pid = $menu_model->getFieldSingleMenu("pid !=0 AND url like '%{$controller}/".ACTION_NAME."%'",'pid');

        if ($pid) {

            // 查找当前主菜单
            $nav =  $menu_model->getMenuInfo($pid);

            if ($nav['pid']) {
                $nav = $menu_model->getMenuInfo($nav['pid']);
            }

            foreach ($menus['main'] as $key => $item) {

                // 获取当前主菜单的子菜单项
                if ($item['id'] == $nav['id']) {

                    $menus['main'][$key]['class']='current';

                    //生成child树
                    $groups = $menu_model->getFieldMultiMenu(array('group'=>array('neq',''),'pid' =>$item['id']), 'group', '', true);

                    //获取二级分类的合法url
                    $where          =   array();
                    $where['pid']   =   $item['id'];
                    $where['hide']  =   0;

                    $second_urls = $menu_model->getMenuList($where, 'id,url');

                    if (!IS_ROOT) {

                        // 检测菜单权限
                        $to_check_urls = array();

                        foreach ($second_urls as $key=>$to_check_url) {

                            if (stripos($to_check_url,MODULE_NAME) !== 0){

                                $rule = MODULE_NAME.'/'.$to_check_url;
                            }else{

                                $rule = $to_check_url;
                            }

                            if ($this->checkRule($rule, AuthRuleModel::RULE_URL,null)) {
                                $to_check_urls[] = $to_check_url;
                            }

                        }
                    }


                    // 按照分组生成子菜单树
                    foreach ($groups as $g) {

                        $map = array('group'=>$g);

                        if (isset($to_check_urls)) {

                            if (empty($to_check_urls)) {
                                // 没有任何权限
                                continue;
                            } else {
                                $map['url'] = array('in', $to_check_urls);
                            }
                        }

                        $map['pid']     =   $item['id'];
                        $map['hide']    =   0;

                        $menu_list = $menu_model->getMenuList($map, 'id,pid,title,url,tip', 'sort asc');

                        $menus['child'][$g] = list_to_tree($menu_list, 'id', 'pid', 'operater', $item['id']);
                    }
                }
            }
        }
        
        return $menus;
    }
    
}
