<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use think\Image;

/**
 * 文件处理逻辑
 */
class File extends AdminBase
{
    
    /**
     * 图片上传
     * small,medium,big
     */
    public function pictureUpload($name = 'file', $thumb_config = ['small' => 100, 'medium' => 500, 'big' => 1000])
    {
        
        $object = request()->file($name)->move(PICTURE_PATH);
        
        $save_name = $object->getSaveName();
        
        $save_path = PICTURE_PATH.$save_name;
        
        $picture_dir_name = substr($save_name, 0, strrpos($save_name, '\\'));
        
        $filename = $object->getFilename();
        
        $thumb_dir_path = PICTURE_PATH . $picture_dir_name . DS . 'thumb';
        
        !file_exists($thumb_dir_path) && @mkdir($thumb_dir_path, 0777, true);
        
        Image::open($save_path)->thumb($thumb_config['small'], $thumb_config['small'])->save($thumb_dir_path. DS . 'small_' . $filename);
        Image::open($save_path)->thumb($thumb_config['medium'], $thumb_config['medium'])->save($thumb_dir_path . DS . 'medium_' . $filename);
        Image::open($save_path)->thumb($thumb_config['big'], $thumb_config['big'])->save($thumb_dir_path . DS . 'big_' . $filename);
        
        //todo 云存储
        
        $data = ['name' => $filename, 'path' => $picture_dir_name. '/' . $filename];
        
        //保存到数据库
        $result = load_model('Picture')->addInfo($data);
        
        if ($result) {
            
            $data['id'] = $result;
            
            return $data;
        }
        
        return  false;
    }
}
