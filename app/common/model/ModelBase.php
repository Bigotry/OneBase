<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\common\model;

use think\Model;
use think\Db;

/**
 * 模型基类
 */
class ModelBase extends Model
{

    /**
     * 连接查询
     */
    protected $join = [];

    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {
        
        $status = [DATA_DELETE => '删除', DATA_DISABLE => "<span class='badge bg-red'>禁用</span>", DATA_NORMAL => "<span class='badge bg-green'>启用</span>"];
        
        return $status[$this->data[DATA_STATUS_NAME]];
    }
    
    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [])
    {
        
        $this->updateCache($this);
        
        $pk = $this->getPk();
        
        if (empty($data[$pk])) {
            
            $this->allowField(true)->save($data, $where);
            
            return $this->getQuery()->getLastInsID();
            
        } else {
            
            is_object($data) && $data = $data->toArray();
            
            !empty($data[TIME_CT_NAME]) && is_string($data[TIME_CT_NAME]) && $data[TIME_CT_NAME] = strtotime($data[TIME_CT_NAME]);
            
            $default_where[$pk] = $data[$pk];
            
            return $this->updateInfo(array_merge($default_where, $where), $data);
        }
    }
    
    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {
        
        $data[TIME_UT_NAME] = TIME_NOW;
        
        $this->updateCache($this);
        
        return $this->allowField(true)->save($data, $where);
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
        
        $this->updateCache($this);
        
        return $return_data;
    }
    
    /**
     * 设置某个字段值
     */
    final protected function setFieldValue($where = [], $field = '', $value = '')
    {
        
        $this->updateCache($this);
        
        return $this->updateInfo($where, [$field => $value]);
    }
    
    /**
     * 删除数据
     */
    final protected function deleteInfo($where = [], $is_true = false)
    {
        
        $this->updateCache($this);
        
        if ($is_true) {
            
            $return_data = $this->where($where)->delete();
            
        } else {
            
            $return_data = $this->setFieldValue($where, DATA_STATUS_NAME, DATA_DELETE);
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
    final protected function getInfo($where = [], $field = true)
    {
        
        $query = !empty($this->join) ? $this->join($this->join) : $this;
        
        $ob_auto_cache_key = $this->getCacheKey($this, $query, $where, $field);
        
        $cache_data = cache($ob_auto_cache_key);
        
        if (!empty($cache_data)) {

            return $cache_data;
        }
        
        $info = $query->where($where)->field($field)->find();
        
        $this->setCache($this, $info, $ob_auto_cache_key);
        
        $this->join = [];
        
        return $info;
    }
    
    /**
     * 获取列表数据
     * 若不需要分页 $paginate 设置为 false
     */
    final protected function getList($where = [], $field = true, $order = '', $paginate = 0)
    {
        
        list($query, $where_temp) = $this->getListQuery($this, $where);
        
        $ob_auto_cache_key = $this->getCacheKey($this, $query, $where_temp, $field, $order, $paginate);
        
        $cache_data = cache($ob_auto_cache_key);
        
        if (!empty($cache_data)) {

            return $cache_data;
        }

        $query_temp = $query->where($where_temp)->order($order)->field($field);
        
        !empty($this->limit) && $query_temp->limit($this->limit);
        !empty($this->group) && $query_temp->group($this->group);
        
        if (false === $paginate) {
       
            $list = $query_temp->select();
            
        } else {
        
            $list_rows = empty($paginate) ? DB_LIST_ROWS : $paginate;

            $list = $query_temp->paginate(input('list_rows', $list_rows), false, ['query' => request()->param()]);
        }
        
        $this->join = []; $this->limit = []; $this->group = [];

        $this->setCache($this, $list, $ob_auto_cache_key);
        
        return $list;
    }
    
    /**
     * 获取列表查询query对象
     */
    final protected function getListQuery($obj = null, $where = [])
    {
        
        empty($obj->join) && !isset($where[DATA_STATUS_NAME]) && $where[DATA_STATUS_NAME] = ['neq', DATA_DELETE];

        if (empty($obj->join)) {
            
            !isset($where[DATA_STATUS_NAME]) && $where[DATA_STATUS_NAME] = ['neq', DATA_DELETE];
            
            $query = $obj;
            
        } else {
            
            $query = $obj->join($obj->join);
        }
        
        return [$query, $where];
    }
    
    /**
     * 原生查询
     */
    final protected function query($sql = '')
    {
        
        return Db::query($sql);
    }
    
    /**
     * 原生执行
     */
    final protected function execute($sql = '')
    {
        
        return Db::execute($sql);
    }
    
    /**
     * 更新缓存
     */
    final protected function updateCache($obj = null)
    {
        
        config('is_auto_cache') && !isset($obj->is_update_cache_version) && update_cache_version($obj);
    }
    
    /**
     * 写入缓存
     */
    final protected function setCache($obj = null, $data = [], $ob_auto_cache_key = '')
    {
        
        if (config('is_auto_cache') && !isset($obj->no_auto_cache)) {
            
            !empty($data) && cache($ob_auto_cache_key, $data);
        }
    }
    
    /**
     * 获取缓存
     */
    final protected function getCacheKey($obj = null, $query = null, $where = [], $field = true, $order = null, $paginate = null)
    {
        
        if (!config('is_auto_cache') && isset($obj->no_auto_cache)) {
            
            return [];
        }
        
        $ob_auto_cache      = cache('ob_auto_cache');
        
        $where['field']     = $field;
        
        isset($order)       && $where['order'] = $order;
        isset($paginate)    && $where['paginate'] = $paginate;
        
        $table_name = $query->getTable();
        
        $temp_str = $table_name . json_encode($obj) . json_encode($where) . json_encode($ob_auto_cache[$query->getTable()]);
        
        isset($order) && $temp_str .= json_encode(request()->param());
        
        return md5($temp_str);
    }
    
    /**
     * 重写获取器 兼容 模型|逻辑|验证|服务 层实例获取
     */
    public function __get($name)
    {
        
        $layer = $this->getLayerPrefix($name);
        
        if (false === $layer) {
            
            return parent::__get($name);
        }
        
        $model = sr($name, $layer);
        
        return LAYER_VALIDATE_NAME == $layer ? validate($model) : model($model, $layer);
    }
    
    /**
     * 获取层前缀
     */
    public function getLayerPrefix($name)
    {
        
        $layer = false;
        
        $layer_array = [LAYER_MODEL_NAME, LAYER_LOGIC_NAME, LAYER_VALIDATE_NAME, LAYER_SERVICE_NAME];
        
        foreach ($layer_array as $v)
        {
            if (str_prefix($name, $v)) {
                
                $layer = $v;
                
                break;
            }
        }
        
        return $layer;
    }
}
