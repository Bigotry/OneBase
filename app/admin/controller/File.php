<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 文件控制器
 */
class File extends AdminBase
{
    
    // 文件逻辑
    private static $fileLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        !isset(self::$fileLogic) && self::$fileLogic = load_model('File');
    }
    
    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        
        $result = self::$fileLogic->pictureUpload();
        
        return json($result);
    }
  
}
