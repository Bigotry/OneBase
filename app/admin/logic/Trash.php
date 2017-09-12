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
            
            $model = model($k);
            
            $temp = [];
            [$v];
            $temp['name']   = $k;
            $temp['model_path']  = $model->class;
            $temp['number'] = $model->stat([DATA_STATUS_NAME => DATA_DELETE]);
            
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
        
        $list = model($model_name)->getList([DATA_STATUS_NAME => DATA_DELETE], $field, 'id desc');
        
        return compact('list', 'dynamic_field', 'model_name');
    }
    
    /**
     * 彻底删除数据
     */
    public function trashDataDel($model_name = '', $id = 0)
    {
        
        $model = model($model_name);
        
        return $model->deleteInfo(['id' => $id], true) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $model->getError()];
    }
    
    /**
     * 恢复数据
     */
    public function restoreData($model_name = '', $id = 0)
    {
        
        $model = model($model_name);
        
        return $model->setFieldValue(['id' => $id], DATA_STATUS_NAME, DATA_NORMAL) ? [RESULT_SUCCESS, '数据恢复成功'] : [RESULT_ERROR, $model->getError()];
    }
 
}
