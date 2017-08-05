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
     * 更新缓存版本号
     */
    public function updateCacheVersion()
    {
        
        set_cache_version($this->name);
    }
    
    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {
        
        $status = [DATA_DELETE => '删除', DATA_DISABLE => '禁用', DATA_NORMAL => '启用'];
        
        return $status[$this->data[DATA_COMMON_STATUS]];
    }
    
    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [], $sequence = null)
    {
        
        $pk = $this->getPk();
        
        $return_data = null;
        
        if (empty($data[$pk])) {
            
            $return_data = $this->allowField(true)->save($data, $where, $sequence);
            
            $return_data && $this->updateCacheVersion();
        } else {
            
            $return_data = $this->updateInfo($where, $data);
        }
        
        return $return_data;
    }
    
    /**
     * 新增数据
     */
    final protected function addInfo($data = [], $is_return_pk = true)
    {
        
        $data[TIME_CT_NAME] = TIME_NOW;
        
        $return_data = $this->insert($data, false, $is_return_pk);
        
        $return_data && $this->updateCacheVersion();
        
        return $return_data;
    }
    
    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {
        
        $data[TIME_UT_NAME] = TIME_NOW;
        
        $return_data = $this->allowField(true)->where($where)->update($data);
        
        $return_data && $this->updateCacheVersion();
        
        return $return_data;
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
        
        $return_data = $this->saveAll($data_list, $replace);
        
        $return_data && $this->updateCacheVersion();
        
        return $return_data;
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
        
        if ($is_true) {
            
            $return_data = $this->where($where)->delete();
            
            $return_data && $this->updateCacheVersion();
        } else {
            
            $return_data = $this->setFieldValue($where, DATA_COMMON_STATUS, DATA_DELETE);
        }
        
        return $return_data;
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
     * 获取单条数据
     */
    final protected function getInfo($where = [], $field = true, $join = null, $data = null)
    {
        
        $cache_tag = get_cache_tag($this->name, $join);
        
        $cache_key = get_cache_key($this->name, $where, $field, null, null, $join, null, null, $data);
        
        empty($join) ? self::$ob_query = $this->where($where)->field($field) : self::$ob_query = $this->join($join)->where($where)->field($field);
        
        return $this->getResultData($cache_key, $cache_tag, DATA_DISABLE, $data);
    }
    
    /**
     * 获取列表数据
     */
    final protected function getList($where = [], $field = true, $order = '', $paginate = 0, $join = [], $group = '', $limit = null, $data = null)
    {
        
        !isset($where[DATA_COMMON_STATUS]) && $where[DATA_COMMON_STATUS] = ['neq', DATA_DELETE];
        
        self::$ob_query = $this->where($where)->order($order);
        
        self::$ob_query = self::$ob_query->field($field);
        
        !empty($join)  && self::$ob_query = self::$ob_query->join($join);
        
        !empty($group) && self::$ob_query = self::$ob_query->group($group);
    
        !empty($limit) && self::$ob_query = self::$ob_query->limit($limit);
        
        $cache_tag = get_cache_tag($this->name, $join);
        
        if (DATA_DISABLE === $paginate) : $paginate = DB_LIST_ROWS; endif;
        
        $cache_key = get_cache_key($this->name, $where, $field, $order, $paginate, $join, $group, $limit, $data);
        
        return $this->getResultData($cache_key, $cache_tag, $paginate, $data);
    }
    
    /**
     * 获取结果数据
     */
    final protected function getResultData($cache_key = '', $cache_tag = '', $paginate = 0, $data = null)
    {
        
        $result_data = null;
        
        if (Cache::has($cache_key)) {

            $result_data = unserialize(Cache::get($cache_key));
            
            !empty($result_data) && set_cache_statistics_number(CACHE_EXE_HIT_KEY);
            
        } else {
            
            $backtrace = debug_backtrace(false, 2);

            array_shift($backtrace);

            $function = $backtrace[0]['function'];

            if($function == 'getList') {

                $result_data = false !== $paginate ? self::$ob_query->paginate($paginate) : self::$ob_query->select($data);

            } else {

                $result_data = self::$ob_query->find($data);
            }

            Cache::tag($cache_tag)->set($cache_key, serialize($result_data));
        }
        
        !empty($result_data) && set_cache_statistics_number(CACHE_EXE_NUMBER_KEY);
        
        self::$ob_query->removeOption();
        
        return $result_data;
    }
}
