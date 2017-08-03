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
     * 初始化行为入口
     */
    public function run()
    {
        
        // 初始化常量
        $this->initConst();
        
        // 初始化配置
        $this->initConfig();
        
        // 初始化数据库
        $this->initDbInfo();
        
        // 初始化缓存
        $this->initCacheInfo();
        
        // 注册命名空间
        $this->registerNamespace();
    }
    
    /**
     * 初始化数据库
     */
    private function initDbInfo()
    {
        
        $database_config = config('database');
        
        $list_rows = config('list_rows');
    
        define('DB_PREFIX', $database_config['prefix']);
        
        empty($list_rows) ? define('DB_LIST_ROWS', 10) : define('DB_LIST_ROWS', $list_rows);
    }
    
    /**
     * 初始化缓存
     */
    private function initCacheInfo()
    {
        
        // 自动缓存信息key
        define('AUTO_CACHE_KEY'             , 'auto_cache_info');
        
        // 缓存版本key名称
        define('CACHE_VERSION_KEY'          , 'version');
        
        // 缓存表key名称
        define('CACHE_TABLE_KEY'            , 'table');
        
        // 缓存key名称
        define('CACHE_CACHE_KEY'            , 'cache_key');
        
        // 缓存执行数量
        define('CACHE_EXE_NUMBER_KEY'       , 'exe_number');
        
        // 缓存命中数量
        define('CACHE_EXE_HIT_KEY'          , 'hit_number');
        
        // 缓存存储最大数量
        define('CACHE_MAX_NUMBER_KEY'       , 'max_number');
        
        // 初始化自动缓存信息数组
        $auto_cache_info = cache(AUTO_CACHE_KEY) ?: [];
        
        $list  = Db::query('SHOW TABLE STATUS');
        
        foreach ($list as $v):
            
        $table_name = str_replace('_', '', str_replace(DB_PREFIX, '', $v['Name']));

        empty($auto_cache_info[CACHE_TABLE_KEY][$table_name]) && $auto_cache_info[CACHE_TABLE_KEY][$table_name][CACHE_VERSION_KEY] = DATA_DISABLE;

        endforeach;
            
        empty($auto_cache_info[CACHE_EXE_NUMBER_KEY]) && $auto_cache_info[CACHE_EXE_NUMBER_KEY] = DATA_DISABLE;
        
        empty($auto_cache_info[CACHE_EXE_HIT_KEY])    && $auto_cache_info[CACHE_EXE_HIT_KEY] = DATA_DISABLE;
        
        empty($auto_cache_info[CACHE_CACHE_KEY])      && $auto_cache_info[CACHE_CACHE_KEY] = [];
        
        $auto_cache_info[CACHE_MAX_NUMBER_KEY] = 1000;
        
        cache(AUTO_CACHE_KEY, $auto_cache_info, DATA_DISABLE);
    }
    
    /**
     * 初始化常量
     */
    private function initConst()
    {
        
        // 初始化目录常量
        $this->initDirConst();
        
        // 初始化结果常量
        $this->initResultConst();
        
        // 初始化数据状态常量
        $this->initDataStatusConst();
        
        // 初始化时间常量
        $this->initTimeConst();
        
        // 初始化系统常量
        $this->initSystemConst();
        
        // 初始化路径常量
        $this->initPathConst();
    }
    
    /**
     * 初始化目录常量
     */
    private function initDirConst()
    {
        
        define('LAYER_LOGIC_NAME'     , 'logic');
        define('LAYER_MODEL_NAME'     , 'model');
        define('LAYER_SERVICE_NAME'   , 'service');
        define('LAYER_CONTROLLER_NAME', 'controller');
    }
    
    /**
     * 初始化结果常量
     */
    private function initResultConst()
    {
        
        define('RESULT_SUCCESS' , 'success');
        define('RESULT_ERROR'   , 'error');
        define('RESULT_REDIRECT', 'redirect');
        define('RESULT_MESSAGE' , 'message');
        define('RESULT_URL'     , 'url');
        define('RESULT_DATA'    , 'data');
    }
    
    /**
     * 初始化数据状态常量
     */
    private function initDataStatusConst()
    {
        
        define('DATA_COMMON_STATUS' ,  'status');
        define('DATA_NORMAL'        ,  1);
        define('DATA_DISABLE'       ,  0);
        define('DATA_DELETE'        , -1);
        define('DATA_SUCCESS'       , 1);
        define('DATA_ERROR'         , 0);
    }
    
    /**
     * 初始化时间常量
     */
    private function initTimeConst()
    {
        
        define('TIME_CT_NAME' ,  'create_time');
        define('TIME_UT_NAME' ,  'update_time');
        define('TIME_NOW'     ,   time());
    }
    
    /**
     * 初始化系统常量
     */
    private function initSystemConst()
    {
        
        define('SYS_APP_NAMESPACE'   , config('app_namespace'));
        define('SYS_HOOK_DIR_NAME'   , 'hook');
        define('SYS_ADDON_DIR_NAME'  , 'addon');
        define('SYS_COMMON_DIR_NAME' , 'common');
        define('SYS_ADMINISTRATOR_ID', 1);
        define('SYS_ENCRYPT_KEY'     , '}a!vI9wX>l2V|gfZp{8`;jzR~6Y1_q-e,#"MN=r:');
    }
    
    /**
     * 初始化路径常量
     */
    private function initPathConst()
    {
        
        define('PATH_ADDON'     , ROOT_PATH   . SYS_ADDON_DIR_NAME . DS);
        define('PATH_PUBLIC'    , ROOT_PATH   . 'public'    . DS);
        define('PATH_UPLOAD'    , PATH_PUBLIC . 'upload'    . DS);
        define('PATH_PICTURE'   , PATH_UPLOAD . 'picture'   . DS);
        define('PATH_FILE'      , PATH_UPLOAD . 'file'      . DS);
        define('PATH_SERVICE'   , ROOT_PATH   . DS . SYS_APP_NAMESPACE . DS . SYS_COMMON_DIR_NAME . DS . LAYER_SERVICE_NAME . DS);
    }
    
    /**
     * 初始化配置信息
     */
    private function initConfig()
    {
        
        $model = model(SYS_COMMON_DIR_NAME . '/Config');
        
        $config_list = $model->all();
        
        $config_array = [];
        
        foreach ($config_list as $info):
            
        $config_array[$info['name']] = $info['value'];
        
        endforeach;
        
        config($config_array);
    }
    
    /**
     * 注册命名空间
     */
    private function registerNamespace()
    {
        
        // 注册插件根命名空间
        Loader::addNamespace(SYS_ADDON_DIR_NAME, PATH_ADDON);
    }
}
