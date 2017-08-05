<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

use think\Image;

/**
 * 文件处理逻辑
 */
class File extends LogicBase
{
    
    // 图片模型
    public static $pictureModel = null;
    
    // 文件模型
    public static $fileModel    = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$fileModel    = model($this->name);
        self::$pictureModel = model('Picture');
    }
    
    /**
     * 图片上传
     * small,medium,big
     */
    public function pictureUpload($name = 'file', $thumb_config = ['small' => 100, 'medium' => 500, 'big' => 1000])
    {
        
        $object = request()->file($name)->move(PATH_PICTURE);
        
        $save_name = $object->getSaveName();
        
        $save_path = PATH_PICTURE . $save_name;
        
        $picture_dir_name = substr($save_name, 0, strrpos($save_name, DS));
        
        $filename = $object->getFilename();
        
        $thumb_dir_path = PATH_PICTURE . $picture_dir_name . DS . 'thumb';
        
        !file_exists($thumb_dir_path) && @mkdir($thumb_dir_path, 0777, true);
        
        Image::open($save_path)->thumb($thumb_config['small']   , $thumb_config['small'])->save($thumb_dir_path  . DS . 'small_'  . $filename);
        Image::open($save_path)->thumb($thumb_config['medium']  , $thumb_config['medium'])->save($thumb_dir_path . DS . 'medium_' . $filename);
        Image::open($save_path)->thumb($thumb_config['big']     , $thumb_config['big'])->save($thumb_dir_path    . DS . 'big_'    . $filename);
        
        //todo 云存储
        
        $data = ['name' => $filename, 'path' => $picture_dir_name. SYS_DSS . $filename];
        
        //保存到数据库
        $result = self::$pictureModel->addInfo($data);
        
        if ($result) : $data['id'] = $result; return $data; endif;
        
        return  false;
    }
}
