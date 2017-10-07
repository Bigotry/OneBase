<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 权限组逻辑
 */
class AuthGroup extends AdminBase
{
    
    // 权限组模型
    public static $authGroupModel    = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$authGroupModel = model($this->name);
    }
    
    /**
     * 获取权限分组列表
     */
    public function getAuthGroupList($where = [], $field = true, $order = '', $paginate = false)
    {
        
        return self::$authGroupModel->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 权限组添加
     */
    public function groupAdd($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('add')->check($data);
        
        if (!$validate_result) : return [RESULT_ERROR, $validate->getError()]; endif;
        
        $url = url('groupList');
        
        $data['member_id'] = MEMBER_ID;
        
        $result = self::$authGroupModel->setInfo($data);
        
        $result && action_log('新增', '新增权限组，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '权限组添加成功', $url] : [RESULT_ERROR, self::$authGroupModel->getError()];
    }
    
    /**
     * 权限组编辑
     */
    public function groupEdit($data = [])
    {
        
        $validate = validate($this->name);
        
        $validate_result = $validate->scene('edit')->check($data);
        
        if (!$validate_result) : return [RESULT_ERROR, $validate->getError()]; endif;
        
        $url = url('groupList');
        
        $result = self::$authGroupModel->setInfo($data);
        
        $result && action_log('编辑', '编辑权限组，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '权限组编辑成功', $url] : [RESULT_ERROR, self::$authGroupModel->getError()];
    }
    
    /**
     * 权限组删除
     */
    public function groupDel($where = [])
    {
        
        $result = self::$authGroupModel->deleteInfo($where);
        
        $result && action_log('删除', '删除权限组，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '权限组删除成功'] : [RESULT_ERROR, self::$authGroupModel->getError()];
    }
    
    /**
     * 获取权限组信息
     */
    public function getGroupInfo($where = [], $field = true)
    {
        
        return self::$authGroupModel->getInfo($where, $field);
    }

    /**
     * 设置用户组权限节点
     */
    public function setGroupRules($data = [])
    {
        
        $data['rules'] = !empty($data['rules']) ? implode(',', array_unique($data['rules'])) : '';
        
        $url = url('groupList');
        
        $result = self::$authGroupModel->setInfo($data);
        
        $result && action_log('授权', '设置权限组权限，id：' . $data['id']);
        
        return $result ? [RESULT_SUCCESS, '权限设置成功', $url] : [RESULT_ERROR, self::$authGroupModel->getError()];
    }
    
    /**
     * 选择权限组
     */
    public function selectAuthGroupList($group_list = [], $member_group_list = [])
    {
        
        $member_group_ids = array_extract($member_group_list, 'group_id');
        
        foreach ($group_list as &$info) {
            
            in_array($info['id'], $member_group_ids) ? $info['tag'] = 'active' :  $info['tag'] = '';
        }
            
        return $group_list;
    }
    
}
