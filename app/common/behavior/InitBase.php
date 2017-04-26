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
        
        // 缓存表信息前缀
        define('CACHE_PREFIX', 'cache_info_');
        
        // 缓存表版本key名称
        define('CACHE_VERSION_NAME', 'version');
        
        // 缓存标签key名称
        define('CACHE_TAGS_NAME', 'cache_info_tags');
        
        $list  = Db::query('SHOW TABLE STATUS');
        
        foreach ($list as $v) {
            
            $table_name = str_replace('_', '', str_replace(DB_PREFIX, '', $v['Name']));
            
            $cache_key = CACHE_PREFIX.$table_name;
            
            cache($cache_key) ?: cache($cache_key, [CACHE_VERSION_NAME => 0], 0);
        }
        
        // 缓存信息标签
        cache(CACHE_TAGS_NAME) ?: cache(CACHE_TAGS_NAME, []);
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
