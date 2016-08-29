<?php

namespace app\common\logic;

/**
* 配置模型
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
    
//    
//    
//    public function lists()
//    {
//        $map    = array('status' => 1);
//
//        $data   = $this->db()->where($map)->field('type,name,value')->select();
//
//        $config = array();
//
//        if ($data && is_array($data)) {
//            foreach ($data as $value) {
//                $config[$value['name']] = $this->parse($value['type'], $value['value']);
//            }
//        }
//
//        return $config;
//    }
//
//    /**
//     * 根据配置类型解析配置
//     * @param  integer $type  配置类型
//     * @param  string  $value 配置值
//     */
//    private function parse($type, $value)
//    {
//        switch ($type) {
//            
//            case 'textarea': //解析数组
//            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
//                
//            if (strpos($value,':')) {
//                
//                $value  = array();
//                foreach ($array as $val) {
//                    
//                    $list = explode(':', $val);
//                    
//                    if (isset($list[2])) {
//                        $value[$list[0]] = $list[1].','.$list[2];
//                    } else {
//                        $value[$list[0]] = $list[1];
//                    }
//                }
//            } else {
//                $value = $array;
//            }
//            break;
//        }
//            
//        return $value;
//    }
}