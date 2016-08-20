<?php

namespace app\admin\controller;

class Member extends AdminBase
{
    
    public $model;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        $this->model =  model('Member');
    }
    
    //会员列表
    public function index()
    {
        
        $list = $this->model->getMemberList(array('status' => 1));
        
        $this->assign('list', $list);
        
        $this->assign('meta_title', '会员信息');
        
        return $this->fetch();
    }
    
    //新增会员
    public function addMember()
    {
        
        $this->model->addMember($this->param);
        
        $this->assign('meta_title', '新增用户');
        
        return $this->fetch('add_member');
    }
    

}
