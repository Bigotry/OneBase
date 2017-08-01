<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\Model;
use think\Db;
use think\Cache;

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
        
        set_cache_version($this->name);
        
        return empty($data[$pk]) ? $this->allowField(true)->save($data, $where, $sequence) : $this->updateInfo($where, $data);
    }
    
    /**
     * 新增数据
     */
    final protected function addInfo($data = [], $is_return_pk = true)
    {
        
        $data['create_time'] = NOW_TIME;
        
        set_cache_version($this->name);
        
        return $this->insert($data, false, $is_return_pk);
    }
    
    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {
        
        $data[DATA_UPDATE_TIME] = NOW_TIME;
        
        set_cache_version($this->name);
        
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
        
        set_cache_version($this->name);
        
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
        
        set_cache_version($this->name);
        
        return $is_true ? $this->where($where)->delete() : $this->setFieldValue($where, DATA_COMMON_STATUS, DATA_DELETE);
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
        
        !isset($where[DATA_COMMON_STATUS]) && $where[DATA_COMMON_STATUS] = ['neq', DATA_DELETE];
        
        $paginate['simple'] = empty($paginate['simple']) ? false   : $paginate['simple'];
        
        $paginate['config'] = empty($paginate['config']) ? []      : $paginate['config'];
        
        $join['condition']  = empty($join['condition'])  ? null    : $join['condition'];
        
        $join['type']       = empty($join['type'])       ? 'INNER' : $join['type'];
        
        $group['having']    = empty($group['having'])    ? ''      : $group['having'];
        
        self::$ob_query = $this->where($where)->order($order);
        
        !empty($join['join'])     && self::$ob_query = self::$ob_query->join($join['join'], $join['condition'], $join['type']);
        
        self::$ob_query = self::$ob_query->field($field);
        
        !empty($group['group'])   && self::$ob_query = self::$ob_query->group($group['group'], $group['having']);
    
        !empty($limit)            && self::$ob_query = self::$ob_query->limit($limit);
        
        $cache_tag = get_cache_tag($this->name, $join);
        
        $cache_key = get_cache_key($this->name, $where, $field, $order, $paginate, $join, $group, $limit, $data);
        
        if (Cache::has($cache_key)) {
            
            $result_data = unserialize(Cache::get($cache_key));
            
            !empty($result_data) && set_cache_statistics_number(CACHE_EXE_HIT_KEY);
            
        } else {
            
            $result_data = !empty($paginate['rows']) ? self::$ob_query->paginate($paginate['rows'], $paginate['simple'], $paginate['config']) : self::$ob_query->select($data);
            
            Cache::tag($cache_tag)->set($cache_key, serialize($result_data));
        }
        
        !empty($result_data) && set_cache_statistics_number(CACHE_EXE_NUMBER_KEY);
        
        return $result_data;
    }
    
}
