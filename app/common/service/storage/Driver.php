<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\service\storage;

use app\common\service\BaseInterface;

/**
 * 云存储服务驱动
 */
interface Driver extends BaseInterface
{
    
    /**
     * 获取驱动参数
     */
    public function getDriverParam();
    
    /**
     * 获取基本信息
     */
    public function driverInfo();
    
    /**
     * 配置信息
     */
    public function config();
    
    /**
     * 上传图片
     */
    public function uploadPicture($file_id);
    
    /**
     * 上传文件
     */
    public function uploadFile($file_id);
    
}
