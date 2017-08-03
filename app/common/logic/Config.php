<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

/**
 * 配置逻辑
 */
class Config extends LogicBase
{
    
    // 配置模型
    public static $configModel = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$configModel = model($this->name);
    }
    
    /**
     * 获取配置列表
     */
    public function getConfigList($where = [], $field = true, $order = '', $is_paginate = true)
    {
        
        $paginate_data = $is_paginate ? ['rows' => DB_LIST_ROWS] : false;
        
        return self::$configModel->getList($where, $field, $order, $paginate_data);
    }
    
    /**
     * 获取配置信息
     */
    public function getConfigInfo($where = [], $field = true)
    {
        
        return self::$configModel->getInfo($where, $field);
    }
    
    /**
     * 系统设置
     */
    public function settingSave($data = [])
    {
        
        foreach ($data as $name => $value) {
            
            $where = array('name' => $name);
            
            self::$configModel->setInfo(array('value' => $value), $where);
        }
        
        return [RESULT_SUCCESS, '设置保存成功'];
    }
    
    /**
     * 配置添加
     */
    public function configAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError()];
        }
        
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        
        return self::$configModel->setInfo($data) ? [RESULT_SUCCESS, '配置添加成功', $url] : [RESULT_ERROR, self::$configModel->getError()];
    }
    
    /**
     * 配置编辑
     */
    public function configEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $validate->getError()];
        }
        
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        
        return self::$configModel->setInfo($data) ? [RESULT_SUCCESS, '配置编辑成功', $url] : [RESULT_ERROR, self::$configModel->getError()];
    }
    
    /**
     * 配置删除
     */
    public function configDel($where = [])
    {
        
        return self::$configModel->deleteInfo($where) ? [RESULT_SUCCESS, '菜单删除成功'] : [RESULT_ERROR, self::$configModel->getError()];
    }
}
