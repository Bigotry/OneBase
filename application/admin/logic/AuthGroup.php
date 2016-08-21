<?php

namespace app\admin\logic;

/**
* 权限分组模型
*/
class AuthGroup extends AdminBase
{
    
    /**
     * 获取权限分组信息
     */
    public function getAuthGroupList($data = [], $field = true, $order = '', $listRows = 15, $simple = false, $config = [])
    {
        
        return $this->getListPage($data, $field, $order, $listRows, $simple, $config);
    }
    
    //获取分组信息
    public function getGroupInfo($data = array(), $field = true) {
        
        if (empty($data)) {
            
            return [];
        } else {
            
            return $this->getInfo($data, $field);
        }
    }
    
    
 
    public function getGroupFieldMulti($data = array(), $field = 'id', $key = '', $distinct = false)
    {
        
        return $this->getFieldMulti($data, $field, $key, $distinct);
    }
    
    
    public function getReturnNodes($tree = true)
    {
        
        return $this->returnNodes($tree);
    }
    
    
    /**
     * 编辑权限组
     */
    public function editGroup($data = [])
    {
        
        if (IS_POST) {
            
            $validate = validate('AuthGroup');
            $validate_result = $validate->check($data);
            
            if (!$validate_result) {
                
                return createJump('error', $validate->getError());
            }
            
            
            if ($data['id']) {
                
                $res = $this->setInfo($data, array('id' => $data['id']));
            } else {
                
                unset($data['id']);
                $res = $this->setInfo($data);
            }
            
            if ($res) {
                
                return createJump('success', '操作成功！', url('index'));
            } else {
                
                return createJump('error', '操作失败！');
            }
        }
        
    }
    
    
    
    /**
     * 后台节点配置的url作为规则存入auth_rule
     * 执行新节点的插入,已有节点的更新,无效规则的删除三项任务
     */
    public function updateRules()
    {
        

        //需要新增的节点必然位于$nodes
        $nodes = $this->returnNodes(false);
        
        $auth_rule_model = model('AuthRule', 'logic');
        
        $map  = array('module'=>'admin', 'type'=>array('in', array(AuthRule::RULE_URL, AuthRule::RULE_MAIN)));//status全部取出,以进行更新
        
        //需要更新和删除的节点必然位于$rules
        $rules = $auth_rule_model->getList($map, true, 'name');
            
        //构建insert数据
        $data = array();//保存需要插入和更新的新节点
        
        foreach ($nodes as $value) {
            
            $temp['name']   = $value['url'];
            $temp['title']  = $value['title'];
            $temp['module'] = 'admin';
            
            if ($value['pid'] > 0) {
                
                $temp['type'] = AuthRule::RULE_URL;
            }else{
                
                $temp['type'] = AuthRule::RULE_MAIN;
            }
            
            $temp['status']   = 1;
            
            $data[strtolower($temp['name'].$temp['module'].$temp['type'])] = $temp;//去除重复项
        }

        $update = array();//保存需要更新的节点
        $ids    = array();//保存需要删除的节点的id
        
        foreach ($rules as $index => $rule) {
            
            $key = strtolower($rule['name'].$rule['module'].$rule['type']);
            
            //如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
            if (isset($data[$key])) {
                
                //为需要更新的节点补充id值
                $data[$key]['id'] = $rule['id'];
                $update[] = $data[$key];
                
                unset($data[$key]);
                unset($rules[$index]);
                unset($rule['condition']);
                
                $diff[$rule['id']]=$rule;
            } elseif ($rule['status'] == 1) {
                
                $ids[] = $rule['id'];
            }
        }

        if (count($update)) {
            foreach ($update as $k => $row) {
                if ($row != $diff[$row['id']]) {
                    
                    $auth_rule_model->setInfo($row, array('id' => $row['id']));
                }
            }
        }
        
        if (count($ids)) {
            
            
            $update_map['id'] = array('in', $ids);
            
            $auth_rule_model->updateInfo(array('status' => -1), $update_map);
            //删除规则是否需要从每个用户组的访问授权表中移除该规则?
        }
        

        
        if (count($data)) {
            
            $auth_rule_model->setList(array_values($data));
        }
        
        if ($auth_rule_model->getError()) {
            
            trace('['.ACTION_NAME.']:'.$auth_rule_model->getError());
            
            return false;
        } else {
            
            return true;
        }
    }
    
    
}
