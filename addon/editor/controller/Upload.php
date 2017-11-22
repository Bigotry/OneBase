<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\editor\controller;

use app\common\controller\AddonBase;
use addon\editor\logic\Upload as LogicUpload;
use think\exception\HttpResponseException;
use think\Response;

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
        
        $response = Response::create($result, 'json');
        
        throw new HttpResponseException($response);
    }
}
