<?php

namespace app\install\controller;

class Index extends InstallBase
{
    //安装首页
    public function index()
    {
        return view('index');
    }
    
    
    //安装完成
    public function complete()
    {
        $step = session('step');

        if (!$step) {
            $this->redirect('index');
        } elseif($step != 3) {
            $this->redirect("Install/step{$step}");
        }

        // 写入安装锁定文件
        file_put_contents('../data/install.lock','lock');
        
        $this->assign('info',session('config_file'));
            
        session('step', null);
        session('error', null);
        session('update',null);
        
        return view('complete');
    }
    
}
