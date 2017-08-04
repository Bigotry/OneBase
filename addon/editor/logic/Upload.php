<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace addon\editor\logic;

/**
 * 编辑器插件上传逻辑
 */
class Upload
{
    
    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        
        $object = request()->file('imgFile')->move(PATH_UPLOAD . 'editor');
        
        $result  = ['error' => DATA_DISABLE, 'url' => ''];
        
        if ($object) {
            
            $save_name = $object->getSaveName();
            
            $picture_dir_name = substr($save_name, 0, strrpos($save_name, DS));
            
            $filename = $object->getFilename();
            
            $result['url'] = "/upload/editor/" . $picture_dir_name . SYS_DSS . $filename;
        } else {
            
            $result['error'] = DATA_NORMAL;
            $result['message'] = $object->getError();
        }
        
        return $result;
    }
}
