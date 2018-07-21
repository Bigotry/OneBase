<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\admin\controller;

/**
 * 微信控制器
 */
class Weixin extends AdminBase
{
    
    /**
     * 微信列表
     */
    public function wxList()
    {
        
        $this->assign('list', $this->logicWeixin->getWxList());
        
        return $this->fetch('wx_list');
    }
    
    /**
     * 微信添加
     */
    public function wxAdd()
    {
        
        IS_POST && $this->jump($this->logicWeixin->wxEdit($this->param));
        
        return $this->fetch('wx_edit');
    }
    
    /**
     * 微信编辑
     */
    public function wxEdit()
    {
        
        IS_POST && $this->jump($this->logicWeixin->wxEdit($this->param));
        
        $info = $this->logicWeixin->getWxInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('wx_edit');
    }
    
    /**
     * 微信删除
     */
    public function wxDel($id = 0)
    {
        
        $this->jump($this->logicWeixin->wxDel(['id' => $id]));
    }
}
