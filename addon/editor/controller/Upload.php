<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\editor\controller;

use app\common\controller\AddonBase;
use addon\editor\logic\Upload as LogicUpload;

/**
 * 编辑器插件上传控制器
 */
class Upload extends AddonBase
{

    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        
        $UploadLogic = new LogicUpload();
        
        $result = $UploadLogic->pictureUpload();
        
        return throw_response_exception($result);
    }
}
