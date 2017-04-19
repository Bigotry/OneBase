<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\Model;
use think\Db;

/**
 * 模型基类
 */
class ModelBase extends Model
{
    
    // 查询对象
    private static $ob_query = null;

    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {
        
        $status = [DATA_DELETE => '删除', DATA_DISABLE => '禁用', DATA_NORMAL => '启用'];
        
        return $status[$this->data['status']];
    }
    
    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [], $sequence = null)
    {
        
        $pk = $this->getPk();
        
        return empty($data[$pk]) ? $this->allowField(true)->save($data, $where, $sequence) : $this->updateInfo($where, $data);
    }
    
    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {
        
        $data[DATA_UPDATE_TIME] = NOW_TIME;
        
        return $this->allowField(true)->where($where)->update($data);
    }
    
    /**
     * 统计数据
     */
    final protected function stat($where = [], $stat_type = 'count', $field = 'id')
    {
        
        return $this->where($where)->$stat_type($field);
    }
    
    /**
     * 设置数据列表
     */
    final protected function setList($data_list = [], $replace = false)
    {
        
        return $this->saveAll($data_list, $replace);
    }
    
    /**
     * 设置某个字段值
     */
    final protected function setFieldValue($where = [], $field = '', $value = '')
    {
        
        return $this->updateInfo($where, [$field => $value]);
    }
    
    /**
     * 删除数据
     */
    final protected function deleteInfo($where = [], $is_true = false)
    {
        
        return $is_true ? $this->where($where)->delete() : $this->setFieldValue($where, DATA_STATUS, DATA_DELETE);
    }
    
    /**
     * 获取某个列的数组
     */
    final protected function getColumn($where = [], $field = '', $key = '')
    {
        
        return Db::name($this->name)->where($where)->column($field, $key);
    }
    
    /**
     * 获取某个字段的值
     */
    final protected function getValue($where = [], $field = '', $default = null, $force = false)
    {
        
        return Db::name($this->name)->where($where)->value($field, $default, $force);
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
        
        !isset($where[DATA_STATUS]) && $where[DATA_STATUS] = ['neq', DATA_DELETE];
        
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
