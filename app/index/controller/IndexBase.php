<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\common\controller\ControllerBase;

/**
 * 前端模块基类控制器
 */
class IndexBase extends ControllerBase
{
    
    /**
     * IndexBase constructor                                      构造方法
     * @param   LogicAdminBase          $adminBaseLogic          后台基础逻辑
     * @param   LogicMenu               $menuLogic               菜单逻辑
     * @param   LogicAuthGroupAccess    $authGroupAccessLogic    权限组授权逻辑
     */
    public function __construct()
    {
        
        // 执行父类构造方法
        parent::__construct();
        
        $this->assign('seo_info', $this->logicSeo->getSeoInfo());
        
        $this->assign('api_domain', config('api_domain'));
        
        $this->assign('access_token', get_access_token());
    }
}
