<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 服务逻辑
 */
class Service extends AdminBase
{
    
    // 对象实例
    protected static $instance = [];
    
    // 驱动模型
    public static $driverModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$driverModel = model('Driver');
    }
    
    /**
     * 获取驱动信息
     */
    public function getDriverInfo($where = [], $field = true)
    {
        
        return self::$driverModel->getInfo($where, $field);
    }
    
    /**
     * 驱动安装
     */
    public function driverInstall($data = [])
    {
        
        $where['service_name'] = $data['service_name'];
        $where['driver_name']  = $data['driver_name'];
        
        $info = self::$driverModel->getInfo($where);
        
        $info['config']       = serialize($data['param']);
        $info['service_name'] = $data['service_name'];
        $info['driver_name']  = $data['driver_name'];
        
        $url = url('service/servicelist', ['service_name' => $data['service_name']]);
        
        $result = self::$driverModel->setInfo($info);
        
        $result && action_log('安装', '驱动安装或设置，service_name：' . $data['service_name'] . '，driver_name' . $data['driver_name']);
        
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, self::$driverModel->getError()];
    }
    
    /**
     * 驱动卸载
     */
    public function driverUninstall($data = [])
    {
        
        $where['service_name'] = $data['service_class'];
        $where['driver_name']  = $data['driver_class'];
        
        $result = self::$driverModel->deleteInfo($where, true);
        
        $result && action_log('卸载', '驱动卸载，service_name：' . $data['service_class'] . '，driver_name' . $data['driver_class']);
        
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, self::$driverModel->getError()];
    }
    
    /**
     * 获取服务 or 驱动列表
     */
    public function getServiceList($service_name)
    {
        
        $object_list = $this->getObjectList($service_name);
              
        $list = [];
        
        foreach ($object_list as $object)
        {
            
            if (is_null($service_name)) {
                
                $info = $object->serviceInfo();
            } else {
                
                $info = $object->driverInfo();
                
                $dv_info = self::$driverModel->getInfo(['driver_name' => $info['driver_class']]);

                empty($dv_info) ? $info['is_install'] = DATA_DISABLE : $info['is_install'] = DATA_NORMAL;
            }
            
            $list[] = $info;
        }
        
        return $list;
    }
    
    /**
     * 获取对象列表
     */
    public function getObjectList($service_name)
    {
        
        if (is_null($service_name)) {
            
            $file_list  = file_list(PATH_SERVICE);

            $object_path = SYS_DS_CONS . SYS_APP_NAMESPACE . SYS_DS_CONS . SYS_COMMON_DIR_NAME . SYS_DS_CONS . LAYER_SERVICE_NAME;
            
        } else {
            
            $driver_name = strtolower($service_name);
            
            $file_list  = file_list(PATH_SERVICE . $driver_name. DS . 'driver');

            $object_path = SYS_DS_CONS . SYS_APP_NAMESPACE . SYS_DS_CONS . SYS_COMMON_DIR_NAME . SYS_DS_CONS . LAYER_SERVICE_NAME . SYS_DS_CONS . $driver_name . SYS_DS_CONS . SYS_DRIVER_DIR_NAME;
        }
        
        foreach ($file_list as $v) {
            
            $class_name = str_replace(EXT, '', $v);
            
            if (false === strpos($class_name, 'Base') && !isset(self::$instance[$class_name])) {
                
                $class = $object_path . SYS_DS_CONS . $class_name;
        
                self::$instance[$class_name] = new $class();
            }
        }
        
        return self::$instance;
    }
    
}
