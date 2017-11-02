<?php

namespace addon\editor\controller;

use app\common\controller\AddonBase;
use addon\editor\logic\Upload as LogicUpload;

/**
 * 编辑器插件上传控制器
 * @author     Bigotry <3162875@qq.com>
 * @version    1.0
 */
class Upload extends AddonBase
{

    /**
     * 图片上传
     * @return json
     */
    public function pictureUpload()
    {
        
        $UploadLogic = new LogicUpload();
        
        $result = $UploadLogic->pictureUpload();
        
        exit(json_encode($result));
    }
}
