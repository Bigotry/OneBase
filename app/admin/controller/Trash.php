<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 回收站控制器
 */
class Trash extends AdminBase
{
    
    // 回收站逻辑
    private static $trashLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$trashLogic) && self::$trashLogic = load_model('Trash');
    }
    
    /**
     * 回收站列表
     */
    public function trashList()
    {
        
        $this->setTitle('回收站列表');
        
        $this->assign('list', self::$trashLogic->getTrashList());
        
        return $this->fetch('trash_list');
    }
    
    /**
     * 数据列表
     */
    public function trashDataList()
    {
        
        $this->setTitle('数据列表');
        
        $data = self::$trashLogic->getTrashDataList($this->param['name']);
        
        $this->assign('model_name', $data['model_name']);
        $this->assign('list', $data['list']);
        $this->assign('dynamic_field', $data['dynamic_field']);
        
        return $this->fetch('trash_data_list');
    }
    
    /**
     * 数据删除
     */
    public function trashDataDel($model_name = '', $id = 0)
    {
        
        $this->jump(self::$trashLogic->trashDataDel($model_name, $id));
    }
    
    /**
     * 数据恢复
     */
    public function restoreData($model_name = '', $id = 0)
    {
        
        $this->jump(self::$trashLogic->restoreData($model_name, $id));
    }
}
