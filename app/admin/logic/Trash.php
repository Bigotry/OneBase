<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 回收站逻辑
 */
class Trash extends AdminBase
{
    
    /**
     * 获取回收站列表
     */
    public function getTrashList()
    {
        
        $list = [];
        
        $trash_config = parse_config_array('trash_config');
        
        foreach ($trash_config as $k => $v) {
            
            $temp = [];
            [$v];
            $temp['name']           = $k;
            $temp['model_path']     = $this->$k->class;
            $temp['number']         = $this->$k->stat([DATA_STATUS_NAME => DATA_DELETE]);
            
            $list[] = $temp;
        }
        
        return $list;
    }
    
    /**
     * 获取回收站数据列表
     */
    public function getTrashDataList($model_name = '')
    {
        
        $trash_config = parse_config_array('trash_config');
        
        $dynamic_field = $trash_config[$model_name];
        
        $field = 'id,' . TIME_CT_NAME . ','.TIME_UT_NAME.',' . $dynamic_field;
        
        $list = $this->$model_name->getList([DATA_STATUS_NAME => DATA_DELETE], $field, 'id desc');
        
        return compact('list', 'dynamic_field', 'model_name');
    }
    
    /**
     * 彻底删除数据
     */
    public function trashDataDel($model_name = '', $id = 0)
    {
        
        $where = empty($id) ? ['id' => ['neq', DATA_DISABLE]] : ['id' => $id];
        
        $result = $this->$model_name->deleteInfo($where, true);
        
        $result && action_log('删除', '删除回收站数据，model_name：' . $model_name .'，id' . $id);
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, '删除失败'];
    }
    
    /**
     * 恢复数据
     */
    public function restoreData($model_name = '', $id = 0)
    {
        
        $where = empty($id) ? ['id' => ['neq', DATA_DISABLE]] : ['id' => $id];
        
        $result = $this->$model_name->setFieldValue($where, DATA_STATUS_NAME, DATA_NORMAL);
        
        $result && action_log('恢复', '恢复回收站数据，model_name：' . $model_name .'，id' . $id);
        
        return $result ? [RESULT_SUCCESS, '数据恢复成功'] : [RESULT_ERROR, '恢复失败'];
    }
 
}
