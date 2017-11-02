<?php

namespace addon\editor\logic;

use app\common\logic\File as LogicFile;

/**
 * 编辑器插件上传逻辑
 * @author     Bigotry <3162875@qq.com>
 * @version    1.0
 */
class Upload
{

    /**
     * 图片上传
     * @return array
     */
    public function pictureUpload()
    {
        
        $fileLogic = get_sington_object('fileLogic', LogicFile::class);
        
        $result = $fileLogic->pictureUpload('imgFile');
        
        if (false === $result) : return [RESULT_ERROR => DATA_NORMAL, RESULT_MESSAGE => '文件上传失败']; endif;
        
        $url = get_picture_url($result['id']);
        
        return [RESULT_ERROR => DATA_DISABLE, RESULT_URL => $url];
    }
}
