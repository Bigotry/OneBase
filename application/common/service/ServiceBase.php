<?php

namespace app\common\service;

/**
* 服务基类
*/
class ServiceBase extends \think\Model
{
    
    private static $model = [];

    protected function initialize()
    {
        $name = $this->name;
        
        if (!isset(self::$model[$name])) {
            
            self::$model[$name] = model($name);
        }
    }

    //写入单条信息
    protected function setInfo($data = [], $where = [], $get_id = true, $replace = false)
    {
        
        return self::$model[$this->name]->allowField(true)->save($data, $where, $get_id, $replace);
    }
    
    //写入多条信息
    protected function setList($data_list = [], $replace = false)
    {
        
        return self::$model[$this->name]->saveAll($data_list, $replace);
    }
    
    //更新信息
    protected function updateInfo($data = [], $where = [])
    {
        
        return self::$model[$this->name]->update($data, $where);
    }
    
    //删除信息
    protected function deleteInfo($data = [])
    {
        
        if (empty($data)) {
            
            return self::$model[$this->name]->delete();
        } else {
            
            return self::$model[$this->name]->destroy($data);
        }
    }
    
    //获取单条信息
    protected function getInfo($data = [], $field = true)
    {
        
        $model = self::$model[$this->name];
        
        if (is_numeric($data)) {
            
            return $model::field($field)->find($data);
        }
        
        return $model::where($data)->field($field)->find();
    }
    
    //获取某列单个值
    protected function getFieldSingle($data = [], $field = 'id', $default = null)
    {
        
        $model = self::$model[$this->name];
        
        return $model::where($data)->value($field, $default);
    }
    
    //获取多列多个值
    protected function getFieldMulti($data = [], $field = 'id', $key = '', $distinct = false)
    {
        
        $model = self::$model[$this->name];
        
        if ($distinct) {
            
           return $model::where($data)->distinct($distinct)->column($field, $key); 
        }
        
        return $model::where($data)->column($field, $key);
    }
    
    //获取多条信息
    protected function getList($data = [], $field = true, $order = '')
    {
        
        $model = self::$model[$this->name];

        return $model::where($data)->field($field)->order($order)->select();
    }
    
    //获取多条信息带分页
    protected function getListPage($data = [], $field = true, $order = '', $listRows = 15, $simple = false, $config = [])
    {
        
        $model = self::$model[$this->name];
        
        return $model::where($data)->field($field)->order($order)->paginate($listRows, $simple, $config);
    }
    
    //获取所有的信息
    protected function getListAll($field = true, $order = '')
    {

        $model = self::$model[$this->name];
        
        return $model::field($field)->order($order)->select();
    }
}
