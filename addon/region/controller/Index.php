<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\region\controller;

use app\common\controller\AddonBase;
use addon\region\logic\Index as LogicIndex;

/**
 * 区域选择控制器
 */
class Index extends AddonBase
{

    // 区域选择逻辑
    private static $regionIndexLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$regionIndexLogic = get_sington_object('regionIndexLogic', LogicIndex::class);
    }
    
    /**
     * 获取选项信息
     */
    public function getOptions()
    {
        
        $where['upid']      = input('upid', DATA_DISABLE);
        $where['level']     = input('level', DATA_NORMAL);
        
        $select_id = input('select_id', DATA_DISABLE);
        
        $list = self::$regionIndexLogic->getList($where);
        
        switch ($where['level'])
        {
            case 1: $default_option_text = "---请选择省份---"; break;
            case 2: $default_option_text = "---请选择城市---"; break;
            case 3: $default_option_text = "---请选择区县---"; break;
            default: die('region select exceptions');
        }
        
        exit(self::$regionIndexLogic->combineOptions($select_id, $list, $default_option_text));
    }
    
}
