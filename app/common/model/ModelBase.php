<?php

namespace app\common\model;

use think\Model;

/**
* 基础模型
* 模型层负责提供数据服务
*/
class ModelBase extends Model
{
    
    private static $ob_query = null;

    //写入单条信息
    protected function setInfo($data = [], $where = [], $sequence = null)
    {
        
        $pk = $this->getPk();
        
        return empty($data[$pk]) ? $this->save($data, $where, $sequence) : $this->update($data, $where);
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
    protected function deleteInfo($where = [])
    {
        
        return $this->where($where)->delete();
    }
    
    //获取单条信息
    protected function getInfo($where = [], $field = true)
    {
        
        return $this->where($where)->field($field)->find();
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
    
    //通用列表数据查询方法
    protected function getList($where = [], $field = true, $order = '', $paginate = array('rows' => null, 'simple' => false, 'config' => []), $join = array('join' => null, 'condition' => null, 'type' => 'INNER'), $group = array('group' => '', 'having' => ''), $limit = null, $data = null)
    {
        
        $paginate['simple'] = empty($paginate['simple']) ? false   : $paginate['simple'];
        
        $paginate['config'] = empty($paginate['config']) ? []   : $paginate['config'];
        
        $join['condition']  = empty($join['condition'])  ? null    : $join['condition'];
        
        $join['type']       = empty($join['type'])       ? 'INNER' : $join['type'];
        
        $group['having']    = empty($group['having'])    ? ''      : $group['having'];
        
        self::$ob_query = $this->where($where)->field($field)->order($order);
        
        !empty($paginate['rows']) && self::$ob_query = self::$ob_query->paginate($paginate['rows'], $paginate['simple'], $paginate['config']);
        
        !empty($join['join'])     && self::$ob_query = self::$ob_query->join($join['join'], $join['condition'], $join['type']);
        
        !empty($group['group'])   && self::$ob_query = self::$ob_query->group($group['group'], $group['having']);
    
        !empty($limit)            && self::$ob_query = self::$ob_query->limit($limit);
        
        return !empty($paginate['rows']) ? self::$ob_query : self::$ob_query->select($data);
    }
    
}
