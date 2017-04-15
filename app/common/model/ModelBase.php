<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\Model;

/**
 * 模型基类
 */
class ModelBase extends Model
{
    
    // 查询对象
    private static $ob_query = null;

    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [], $sequence = null)
    {
        
        $pk = $this->getPk();
        
        return empty($data[$pk]) ? $this->allowField(true)->save($data, $where, $sequence) : $this->allowField(true)->update($data, $where);
    }
    
    /**
     * 设置数据列表
     */
    final protected function setList($data_list = [], $replace = false)
    {
        
        return $this->saveAll($data_list, $replace);
    }
    
    /**
     * 删除数据
     */
    final protected function deleteInfo($where = [])
    {
        
        return $this->where($where)->delete();
    }
    
    /**
     * 获取数据
     */
    final protected function getInfo($where = [], $field = true)
    {
        
        return $this->where($where)->field($field)->find();
    }
    
    /**
     * 获取数据列表
     */
    final protected function getList($where = [], $field = true, $order = '', $paginate = array('rows' => null, 'simple' => false, 'config' => []), $join = array('join' => null, 'condition' => null, 'type' => 'INNER'), $group = array('group' => '', 'having' => ''), $limit = null, $data = null)
    {
        
        $paginate['simple'] = empty($paginate['simple']) ? false   : $paginate['simple'];
        
        $paginate['config'] = empty($paginate['config']) ? []      : $paginate['config'];
        
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
