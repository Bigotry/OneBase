<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\behavior;

use think\Loader;
use think\Db;

/**
 * 初始化基础信息行为
 */
class InitBase
{

    /**
     * 行为入口
     */
    public function run()
    {
        
        // 初始化系统常量
        $this->initConst();
        
        // 初始化路径常量
        $this->initPathConst();
        
        // 初始化配置信息
        $this->initConfig();
        
        // 初始化数据库信息
        $this->initDbInfo();
        
        // 初始化缓存信息
        $this->initCacheInfo();
        
        // 注册命名空间
        $this->registerNamespace();
    }
    
    /**
     * 初始化数据库信息
     */
    private function initDbInfo()
    {
        
        $database_config = config('database');
        
        $list_rows = config('list_rows');
    
        define('DB_PREFIX', $database_config['prefix']);
        
        empty($list_rows) ? define('DB_LIST_ROWS', 10) : define('DB_LIST_ROWS', $list_rows);
    }
    
    /**
     * 初始化缓存信息
     */
    private function initCacheInfo()
    {
        
        // 自动缓存信息key
        define('AUTO_CACHE_KEY', 'auto_cache_info');
        
        // 缓存版本key名称
        define('CACHE_VERSION_KEY', 'version');
        
        // 缓存表key名称
        define('CACHE_TABLE_KEY', 'table');
        
        // 缓存key名称
        define('CACHE_CACHE_KEY', 'cache_key');
        
        // 缓存执行数量
        define('CACHE_EXE_NUMBER_KEY', 'exe_number');
        
        // 缓存命中数量
        define('CACHE_EXE_HIT_KEY', 'hit_number');
        
        // 缓存存储最大数量
        define('CACHE_MAX_NUMBER_KEY', 'max_number');
        
        // 初始化自动缓存信息数组
        $auto_cache_info = cache(AUTO_CACHE_KEY) ?: [];
        
        $list  = Db::query('SHOW TABLE STATUS');
        
        foreach ($list as $v)
        {
            
            $table_name = str_replace('_', '', str_replace(DB_PREFIX, '', $v['Name']));
            
            empty($auto_cache_info[CACHE_TABLE_KEY][$table_name]) && $auto_cache_info[CACHE_TABLE_KEY][$table_name][CACHE_VERSION_KEY] = DATA_DISABLE;
        }
        
        empty($auto_cache_info[CACHE_EXE_NUMBER_KEY]) && $auto_cache_info[CACHE_EXE_NUMBER_KEY] = DATA_DISABLE;
        
        empty($auto_cache_info[CACHE_EXE_HIT_KEY])    && $auto_cache_info[CACHE_EXE_HIT_KEY] = DATA_DISABLE;
        
        empty($auto_cache_info[CACHE_CACHE_KEY])      && $auto_cache_info[CACHE_CACHE_KEY] = [];
        
        $auto_cache_info[CACHE_MAX_NUMBER_KEY] = 1000;
        
        cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    }
    
    /**
     * 初始化系统常量
     */
    private function initConst()
    {
        
        // 通用模块名称
        define('MODULE_COMMON_NAME', 'common');
        
        // 逻辑层名称
        define('LAYER_LOGIC_NAME', 'logic');

        // 数据模型层名称
        define('LAYER_MODEL_NAME', 'model');

        // 系统服务层名称
        define('LAYER_SERVICE_NAME', 'service');

        // 系统控制器层名称
        define('LAYER_CONTROLLER_NAME', 'controller');

        // 返回结果集key
        define('RESULT_SUCCESS' , 'success');
        define('RESULT_ERROR'   , 'error');
        define('RESULT_REDIRECT', 'redirect');
        define('RESULT_MESSAGE' , 'message');
        define('RESULT_URL'     , 'url');
        define('RESULT_DATA'    , 'data');

        // 数据状态
        define('DATA_STATUS' ,  'status');
        define('DATA_NORMAL' ,  1);
        define('DATA_DISABLE',  0);
        define('DATA_DELETE' , -1);
        
        // 时间常量
        define('DATA_CREATE_TIME' ,  'create_time');
        define('DATA_UPDATE_TIME' ,  'update_time');
        define('NOW_TIME' , time());
        
        // 系统超级管理员ID
        define('ADMINISTRATOR_ID', 1);
        
        // 系统加密KEY
        define('DATA_ENCRYPT_KEY', '}a!vI9wX>l2V|gfZp{8`;jzR~6Y1_q-e,#"MN=r:');
    }
    
    /**
     * 初始化路径常量
     */
    private function initPathConst()
    {
        
        // 插件目录名称
        define('ADDON_DIR_NAME', 'addon');
        
        // 插件根目录路径
        define('ADDON_PATH', ROOT_PATH . ADDON_DIR_NAME . DS);
        
        // 静态资源目录路径
        define('PUBLIC_PATH', ROOT_PATH . 'public' . DS);
        
        // 文件上传目录路径
        define('UPLOAD_PATH', PUBLIC_PATH . 'upload' . DS);
        
        // 文件上传目录相对路径
        define('UPLOAD_PATH_RELATIVE', '/public/upload/');
        
        // 图片上传目录路径
        define('PICTURE_PATH', UPLOAD_PATH . 'picture' . DS);
    }
    
    /**
     * 初始化配置信息
     */
    private function initConfig()
    {
        
        // 配置模型
        $model = model(MODULE_COMMON_NAME.'/Config');
        
        // 获取所有配置信息
        $config_list = $model->all();
        
        // 写入配置
        foreach ($config_list as $info) {
            
           config($info['name'], $info['value']);
        }
    }
    
    /**
     * 注册命名空间
     */
    private function registerNamespace()
    {
        
        // 注册插件根命名空间
        Loader::addNamespace(ADDON_DIR_NAME, ADDON_PATH);
    }
}
