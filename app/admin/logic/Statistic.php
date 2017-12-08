<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

/**
 * 统计分析逻辑
 */
class Statistic extends AdminBase
{
    
    /**
     * 后台会员权限等级树结构
     */
    public function getMemberTree()
    {
        
        $member = model('member');
        
        $list = $member->getList(['status' => DATA_NORMAL, 'is_inside' => DATA_NORMAL], 'id,username,status,leader_id,is_inside', '', false);
        
        $list_tree = list_to_tree($list, 'id', 'leader_id', 'children', DATA_DISABLE, ['username' => 'name', 'leader_id' => 'value']);
        
        $data = $this->compositionMemberTreeData($list_tree);
        
        return $data[0];
    }
    
    /**
     * 递归组装权限等级统计数据
     */
    public function compositionMemberTreeData($list_tree = [])
    {
        
        $data = [];
        
        $kk = 'children';
        
        foreach ($list_tree as $k => $v)
        {
            
            is_object($v) && $v = $v->toArray();
            
            $data[$k]['name']       =& $v['username'];
            $data[$k][$kk]          =& $v[$kk];
            
            !empty($v[$kk]) && $data[$k][$kk] = $this->compositionMemberTreeData($v[$kk]);
        }
        
        return $data;
    }
}
