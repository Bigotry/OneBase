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
     * 执行速度
     */
    public function exeSpeed()
    {
        
        $cache_data = cache('cache_exe_speed_data');
        
        if (!empty($cache_data)) : return $cache_data; endif;
        
        // 取最近的1万条执行记录进行速度分析
        $list = model('ExeLog')->getList(['status' => DATA_NORMAL], 'id,exe_time', 'id desc', false, [], '', 10000);

        $data = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];

        foreach ($list as $v)
        {
            switch (true)
            {
                case $v['exe_time'] > 5     : $data[7]++; break;
                case $v['exe_time'] > 2     : $data[6]++; break;
                case $v['exe_time'] > 1     : $data[5]++; break;
                case $v['exe_time'] > 0.5   : $data[4]++; break;
                case $v['exe_time'] > 0.2   : $data[3]++; break;
                case $v['exe_time'] > 0.1   : $data[2]++; break;
                case $v['exe_time'] > 0.05  : $data[1]++; break;
                case $v['exe_time'] > 0     : $data[0]++; break;
            }
        }
        
        // 缓存一天
        cache('cache_exe_speed_data', $data, 86400);
        
        return $data;
    }
    
    /**
     * 访客浏览器与操作系统统计
     */
    public function performerFacility()
    {
        
        $cache_data = cache('cache_performer_facility_data');
        
        if (!empty($cache_data)) : return $cache_data; endif;
        
        $log = model('ExeLog');
        
        $browser_list = $log->getList(['status' => DATA_NORMAL], 'browser as name,count(id) as value', '', false, [], 'browser');
        
        $browser_name_data = array_extract($browser_list, 'name');
        
        $system_list = $log->getList(['status' => DATA_NORMAL], 'exe_os as name,count(id) as value', '', false, [], 'exe_os');
        
        $system_name_data = array_extract($system_list, 'name');
        
        $data = compact('browser_list', 'browser_name_data', 'system_list', 'system_name_data');
        
        // 缓存一天
        cache('cache_performer_facility_data', $data, 86400);
        
        return $data;
    }
    
    /**
     * 后台会员权限等级树结构
     */
    public function getMemberTree()
    {
        
        $cache_data = cache('cache_member_tree_data');
        
        if (!empty($cache_data)) : return $cache_data; endif;
        
        $member = model('member');
        
        $list = $member->getList(['status' => DATA_NORMAL, 'is_inside' => DATA_NORMAL], 'id,username,status,leader_id,is_inside', '', false);
        
        $list_tree = list_to_tree($list, 'id', 'leader_id', 'children', DATA_DISABLE, ['username' => 'name', 'leader_id' => 'value']);
        
        $data = $this->compositionMemberTreeData($list_tree);
        
        // 缓存一天
        cache('cache_member_tree_data', $data[0], 86400);
        
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
