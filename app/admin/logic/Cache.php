<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 缓存逻辑
 */
class Cache extends AdminBase
{
    
    // 缓存对象实例
    protected static $instance = [];
    
    /**
     * 获取缓存列表
     */
    public function getCacheList()
    {
        
        $list = load_model($this->name)->getList();
        
        $cache_driver_list = $this->getCacheInfoList();
        
        $cache_list = array_extract_map($list, 'type');
        
        $result_list = [];
        
        foreach ($cache_driver_list as $driver) {
            
            if(isset($cache_list[$driver['cache_type']])){

                $driver = array_merge($driver, $cache_list[$driver['cache_type']]->toArray());

                $driver['is_install'] = true;

            } else {

                $driver['is_install'] = false;
            }
            
            $result_list[] = $driver;
        }
        
        return $result_list;
    }
    
    
    /**
     * 获取缓存驱动列表
     */
    public function getCacheDriverList()
    {
        
        $app_namespace = config('app_namespace');
        
        $file_list  = file_list($app_namespace.'/common/'.LAYER_SERVICE_NAME.'/cache/driver');
        
        $driver_path = "\\$app_namespace\\common\\".LAYER_SERVICE_NAME."\\cache\\driver";
        
        
        foreach ($file_list as $v) {
            
            $class_name = str_replace(EXT, '', $v);
            
            if (!isset(self::$instance[$class_name])) {
                
                $class = $driver_path.'\\'.$class_name;
                
                self::$instance[$class_name] = new $class();
            }
        }
        
        return self::$instance;
    }
    
    /**
     * 获取缓存信息列表
     */
    public function getCacheInfoList()
    {
        
        $driver_list = $this->getCacheDriverList();
       
        $list = [];
        
        foreach ($driver_list as $driver) {
            
            $list[] = $driver->cacheInfo();
        }
        
        return $list;
    }
}
