<?php

namespace app\common\logic;

/**
* 系统通用配置逻辑
*/
class Config extends LogicBase
{

    /**
     * 获取配置列表
     */
    public function getConfigList($data = array(), $field = true, $order = '', $listRows = 15, $simple = false, $config = array())
    {
        
        return $this->getListPage($data, $field, $order, $listRows, $simple, $config);
    }
    
    /**
     * 获取配置管理所需数据
     */
    public function getConfigListData($data = array())
    {
        
        $group_id = 0;
        $name = '';
        
        $map  = array('status' => 1);
        
        if (isset($data['group'])) {
            
            $group_id = $map['group'] = $data['group'];
        }
        
        
        if (isset($data['name'])) {
            
            $map['name']    =   array('like', '%'.(string)$data['name'].'%');
            
            $name = $data['name'];
        }
        
        $list = $this->getConfigList($map, true, 'sort,id');
        
        $config_group_list = parse_config(3, config('config_group_list'));
        
        return compact('group_id', 'name', 'list', 'config_group_list');
    }
 
}