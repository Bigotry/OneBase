<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

use think\Db;

/**
 * 插件逻辑
 */
class Addon extends LogicBase
{
    
    // 插件实例
    protected static $instance = [];
    
    /**
     * 获取插件列表
     */
    public function getAddonList()
    {
        
        $object_list = $this->getUninstalledList();
       
        $list = [];
        
        $model = load_model($this->name);
        
        foreach ($object_list as $object) {
            
            $addon_info = $object->addonInfo();
            
            $info = $model->getInfo(['name' => $addon_info['name']]);
            
            $addon_info['is_install'] = empty($info) ? DATA_DISABLE : DATA_NORMAL;
            
            $list[] = $addon_info;
        }
        
        return $list;
    }
    
    /**
     * 获取未安装插件列表
     */
    public function getUninstalledList()
    {
        
        $dir_list = get_dir(PATH_ADDON);
        
        foreach ($dir_list as $v) {
            
            $class = "\\".SYS_ADDON_DIR_NAME."\\$v\\".ucfirst($v);
            
            if (!isset(self::$instance[$class])) {
                
                self::$instance[$class] = new $class();
            }
        }
        
        return self::$instance;
    }
    
    /**
     * 获取钩子列表
     */
    public function getHookList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return load_model('Hook')->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 执行插件sql
     */
    public function executeSql($name = '', $sql_name = '')
    {
        
	$sql_string = file_get_contents(PATH_ADDON . $name . DS . 'data' . DS . $sql_name.'.sql');
        
	$sql = explode(";\n", str_replace("\r", "\n", $sql_string));
        
	foreach ($sql as $value) {
            
            !empty(trim($value)) && Db::execute($value);
	}
    }
}
