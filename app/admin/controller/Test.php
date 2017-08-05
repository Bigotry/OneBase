<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\ControllerBase;
use app\admin\logic\Test as LogicTest;
/**
 * 测试控制器
 */
class Test extends ControllerBase
{
    
    /**
     * 测试控制器默认方法
     */
    public function index()
    {
        
        // 测试
        $testLogic = get_sington_object('testLogic', LogicTest::class);
       
        $data = $testLogic->index();
       
        dump($data);
    }
}
