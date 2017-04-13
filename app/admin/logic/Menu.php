<?php

namespace app\admin\logic;

/**
* 菜单模型
*/
class Menu extends AdminBase
{
    
    //面包屑
    public static $crumbs   = array();
    
    //菜单树结构视图
    public static $menuTree   = array();
    
    //将格式数组转换为树
    public function menuToTree($menu_list = array(), $level = 0, $name = 'name', $child = 'child')
    {
        
        foreach ($menu_list as $info) {
            
            $tmp_str = str_repeat("&nbsp;", $level * 4);
            
            $tmp_str .= "├";

            $info['level'] = $level;
            
            $info[$name] = empty($level) ? $info[$name]."&nbsp;" : $tmp_str . $info[$name] . "&nbsp;";
            
            if (!array_key_exists($child, $info)) {

                array_push(self::$menuTree, $info);
            } else {
                
                $tmp_ary = $info[$child];
                
                unset($info[$child]);
                
                array_push(self::$menuTree, $info);
                
                $this->menuToTree($tmp_ary, ++$level, $name, $child); //进行下一层递归
            }
        }
        
        return self::$menuTree;
    }
    
    
    //将菜单转为视图
    public function menuToView($menu_list = array(), $child = 'child')
    {
        $menu_view = '';
        
        //遍历菜单列表
        foreach ($menu_list as $menu_info) {

            $url = url($menu_info['url']);
            
            if (!empty($menu_info[$child])) {
             
                $icon = empty($menu_info['icon']) ? 'fa-dot-circle-o' : $menu_info['icon'];
                
                $menu_view.=  "<li menu_id='".$menu_info['id']."'>
                                 <a href='$url'><i class='fa $icon'></i> <span>".$menu_info['name']."</span>
                                   <span class='pull-right-container'>
                                     <i class='fa fa-angle-left pull-right'></i>
                                   </span>
                                 </a>
                                 <ul class='treeview-menu'>".$this->menuToView($menu_info[$child],  $child)."</ul>
                               </li>";
                
            } else {
                
                $icon = empty($menu_info['icon']) ? 'fa-circle-o' : $menu_info['icon'];
                
                $menu_view .= "<li menu_id='".$menu_info['id']."'><a href='$url'><i class='fa $icon'></i> <span>".$menu_info['name']."</span></a></li>";
            }
       }
       
       return $menu_view;
    }
    
    
    
    
    
    //将菜单转为节点视图
    public function menuToNode($menu_list = array(), $child = 'child')
    {
        
        $menu_view = '';
        
        $id = input('id');
        
        $model = model('AuthGroup', 'logic');
        
        $auth_group_info = $model->getGroupInfo(array('id' => $id), 'rules');
        
        $rules_array = str2arr($auth_group_info['rules']);
        
        //遍历菜单列表
        foreach ($menu_list as $menu_info) {
            
            $icon = empty($menu_info['icon']) ? 'fa-dot-circle-o' : $menu_info['icon'];
            
            $checkbox_select = in_array($menu_info['id'], $rules_array) ? "checked='checked'" : '';
            
            if (!empty($menu_info[$child])) {
                
                $menu_view.=  "<div class='box box-header admin-node-header'>

                                          <div class='box-header'>
                                              <div class='checkbox'>
                                                <label>
                                                  <input class='rules_all' type='checkbox' name='rules[]' value='".$menu_info['id']."' $checkbox_select > <i class='fa $icon'></i>  ".$menu_info['name']."
                                                </label>
                                              </div>
                                          </div>

                                    <div class='box-body'> ".$this->menuToNode($menu_info[$child],  $child)." </div>
                                </div>";
                
            } else {
                
                $menu_view.=    "<label class='admin-node-label'>  <input type='checkbox' name='rules[]' value='".$menu_info['id']."'  $checkbox_select > &nbsp;<i class='fa $icon'></i>  ".$menu_info['name']."  </label>";
            }
       }
       
       return $menu_view;
    }
    
    
    
    
    
    
    
    //菜单选择
    public function selectMenu($menu_view = '')
    {
        
        //访问信息
        $map['url']    = URL;
        $map['module'] = MODULE_NAME;
        $map['status'] = 1;
                
        $menu_info = $this->getMenuInfo($map);
        
        //获取自己及父菜单列表
        $this->getParentMenuList($menu_info['id']);
 
        //选中面包屑中的菜单
        foreach (self::$crumbs as $menu_info) {
            
            $replace_data = "menu_id='".$menu_info['id']."'";
            
            $menu_view = str_replace($replace_data, " class='active' ", $menu_view);
        }
        
       return $menu_view;
    }
    
    
    //获取自己及父菜单列表
    public function getParentMenuList($menu_id = 0)
    {
        
        $menu_info = $this->getMenuInfo(array('id' => $menu_id));
        
        !empty($menu_info['pid']) && $this->getParentMenuList($menu_info['pid']);
        
        self::$crumbs [] = $menu_info;
    }
    
    //获取面包屑支持无限级
    public function getCrumbsView()
    {
        
        $crumbs_view = "<ol class='breadcrumb'>";
      
        foreach (self::$crumbs as $menu_info) {
            
            $icon = empty($menu_info['icon']) ? 'fa-circle-o' : $menu_info['icon'];
            
            $crumbs_view .= "<li><a><i class='fa $icon'></i> ".$menu_info['name']."</a></li>";
        }
        
        $crumbs_view .= "</ol>";
        
        return $crumbs_view;
    }
    
    //获取菜单列表
    public function getMenuList($where = [], $field = true, $order = '', $paginate = 10)
    {
        
        return load_model($this->name)->getList($where, $field, $order, array('rows' => $paginate));
    }
    
    //获取菜单信息
    public function getMenuInfo($where = [], $field = true)
    {
        
        return load_model($this->name)->getInfo($where, $field);
    }
    
    //菜单添加
    public function menuAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('menuList', array('pid' => $data['pid'] ? $data['pid'] : 0));
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '菜单添加成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //菜单编辑
    public function menuEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError(), null];
        }
        
        $model = load_model($this->name);
        
        $url = url('menuList', array('pid' => $data['pid'] ? $data['pid'] : 0));
        
        return $model->setInfo($data) ? [RESULT_SUCCESS, '菜单编辑成功', $url] : [RESULT_ERROR, $model->getError(), null];
    }
    
    //菜单删除
    public function menuDel($where = [])
    {
        
        $model = load_model($this->name);
        
        return $model->deleteInfo($where) ? [RESULT_SUCCESS, '菜单删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
}
