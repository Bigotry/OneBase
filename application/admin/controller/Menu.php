<?php

namespace app\admin\controller;

class Menu extends AdminBase
{
    /**
     * 后台菜单首页
     */
    public function index()
    {
        
        if (isset($this->param['pid'])) {
            
            $pid = $this->param['pid'];
        } else {
            
            $pid = 0;
        }
        
        $menu_model = model('Menu');
        
        $this->assign('data', $menu_model->get($pid));
        
        $all_menu   =   $menu_model->column('id,title');
        
//        $type       =   C('CONFIG_GROUP_LIST');

        $map['pid'] = $pid;
        
        if (isset($this->param['title'])) {
            
            $title = trim($this->param['title']);
            $map['title'] = array('like', "%{$title}%");
            
            $this->assign('title',$title);
        } else {
            
            $this->assign('title', '');
        }
            
        $list  =  $menu_model->where($map)->field(true)->order('sort asc,id asc')->select();
        
        foreach ($list as &$key) {
            
            if ($key['pid']) {
                
                $key['up_title'] = $all_menu[$key['pid']];
            }
        }
        
        $this->assign('list',$list);
        $this->assign('pid',$pid);
        $this->assign('meta_title', '菜单列表');
        
        return $this->fetch();
    }
    
    
    /**
     * 删除后台菜单
     */
    public function del()
    {
        
        if (isset($this->param['id'])) {
            
            $id = array_unique((array)$this->param['id']);
        } else {
            
            $this->error('请选择要操作的数据!');
        }
        
        $map = array('id' => array('in', $id) );
        $menu_model = model('Menu');
        
        if ($menu_model->where($map)->delete()) {

            $this->success('操作成功!');
        } else {

            $this->error('操作失败!');
        }
        
    }

}
