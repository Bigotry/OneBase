<?php

namespace app\admin\controller;

class Config extends AdminBase
{
    
    public static $configLogic = null;
    
    //基类初始化
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$configLogic) && self::$configLogic = load_model('Config');
    }
    
    /**
     * 配置列表
     */
    public function configList()
    {
        
        $this->setTitle('配置列表');
        
        $where = empty($this->param['group']) ? [] : array('group' => $this->param['group']);
        
        $this->getConfigCommonData();
        
        $this->assign('list', self::$configLogic->getConfigList($where));
        
        $this->assign('group', $where ? $this->param['group'] : 0);
        
        return $this->fetch('config_list');
    }
    
    
    /**
     * 获取通用数据
     */
    public function getConfigCommonData()
    {
        
        $config_group_list = parse_config_attr(config('config_group_list'));
        
        $config_type_list  = parse_config_attr(config('config_type_list'));
        
        $this->assign('config_group_list', $config_group_list);
        
        $this->assign('config_type_list' , $config_type_list);
    }
    
    
    /**
     * 配置添加
     */
    public function configAdd()
    {
        
        $this->setTitle('配置添加');
        
        IS_POST && $this->jump(self::$configLogic->configAdd($this->param));
        
        $this->getConfigCommonData();
        
        !empty($this->param['group']) && $this->assign('info', array('group'=> $this->param['group']));
        
        return  $this->fetch('config_edit');
    }
    
    /**
     * 配置编辑
     */
    public function configEdit()
    {
        
        $this->setTitle('配置编辑');
        
        IS_POST && $this->jump(self::$configLogic->configEdit($this->param));
        
        $info = self::$configLogic->getConfigInfo(array('id' => $this->param['id']));
        
        $this->assign('info', $info);
        
        $this->getConfigCommonData();
        
        return $this->fetch('config_edit');
    }
    
    /**
     * 配置删除
     */
    public function configDel($id = 0)
    {
        
        $this->jump(self::$configLogic->configDel(array('id' => $id)));
    }
}
