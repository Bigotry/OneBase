<?php

/**
 * Home基类
 */

namespace app\home\controller;

use app\common\controller\CommonBase;

class HomeBase extends CommonBase
{
    //基类初始化
    public function _initialize()
    {
        parent::_initialize();
        echo 'HomeBaseInit...<br/>';
    }
    
}
