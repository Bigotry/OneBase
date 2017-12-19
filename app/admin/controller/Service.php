<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 服务控制器
 */
class Service extends AdminBase
{
    
    /**
     * 服务 or 驱动 列表
     */
    public function serviceList($service_name = null)
    {
        
        $title = is_null($service_name) ? '系统服务列表' : '服务驱动列表';
        
        $this->setTitle($title);
        
        $this->assign('list', $this->request->logicService->getServiceList($service_name));
        
        $view = is_null($service_name) ? 'service_list' : 'driver_list';
        
        return $this->fetch($view);
    }
    
    /**
     * 驱动安装
     */
    public function driverInstall()
    {
        
        IS_POST && $this->jump($this->request->logicService->driverInstall($this->param));
        
        $model = model(ucfirst($this->param['service_class']), LAYER_SERVICE_NAME);
        
        $param = $model->driverParam($this->param['driver_class']);
        
        $info = $this->request->logicService->getDriverInfo(['service_name' => $this->param['service_class'], 'driver_name' => $this->param['driver_class']]);
        
        $info['config'] = unserialize($info['config']);
        
        $this->assign('param', $param);
        
        $this->assign('info',  $info);
        
        return $this->fetch('driver_install');
    }
    
    /**
     * 驱动卸载
     */
    public function driverUninstall()
    {
        
        $this->jump($this->request->logicService->driverUninstall($this->param));
    }
}
