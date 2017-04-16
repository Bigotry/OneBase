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
            
            $model = load_model($k);
            
            $temp = [];
            
            $temp['name']   = $k;
            $temp['model_path']  = $model->class;
            $temp['number'] = $model->stat([DATA_STATUS => DATA_DELETE]);
            
            $list[] = $temp;
        }
        
        return $list;
    }
    
    /**
     * 获取回收站数据列表
     */
    public function getTrashDataList($model_name = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        $model = load_model($model_name);
        
        $trash_config = parse_config_array('trash_config');
        
        $dynamic_field = $trash_config[$model_name];
        
        $field = 'id,' . DATA_CREATE_TIME . ','.DATA_UPDATE_TIME.',' . $dynamic_field;
        
        $list = $model->getList([DATA_STATUS => DATA_DELETE], $field, 'id', $paginate_data);
        
        return compact('list', 'dynamic_field', 'model_name');
    }
    
    /**
     * 彻底删除数据
     */
    public function trashDataDel($model_name = '', $id = 0)
    {
        
        $model = load_model($model_name);
        
        return $model->deleteInfo(['id' => $id], true) ? [RESULT_SUCCESS, '删除成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
    
    /**
     * 恢复数据
     */
    public function restoreData($model_name = '', $id = 0)
    {
        
        $model = load_model($model_name);
        
        return $model->setFieldValue(['id' => $id], DATA_STATUS, DATA_NORMAL) ? [RESULT_SUCCESS, '数据恢复成功', null] : [RESULT_ERROR, $model->getError(), null];
    }
 
}
