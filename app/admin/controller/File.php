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
    
    
    /**
     * 图片上传
     */
    public function pictureUpload()
    {
        
        sf($_FILES);
    }
  
}
