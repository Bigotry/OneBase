<?php

namespace app\admin\controller;

class Index extends AdminBase
{
    
    //后台首页
    public function index()
    {
        
        $this->setTitle('首页');
        
        return $this->fetch('index');
    }

}
