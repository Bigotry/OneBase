<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

use app\common\model\ModelBase;

/**
 * 系统通用逻辑模型
 */
class LogicBase extends ModelBase
{
    
    // 绑定
    protected $bind = [];
    
    /**
     * 设置当前请求绑定的对象实例
     * @access public
     * @param string|array $name    绑定的对象标识
     * @param mixed  $obj           绑定的对象实例
     * @return mixed
     */
    public function bind($name, $obj = null)
    {
        
        $this->bind[$name] = $obj;
    }

    /**
     * 赋值
     */
    public function __set($name, $value)
    {
        
        $this->bind[$name] = $value;
    }

    /**
     * 读取
     */
    public function __get($name)
    {
        
        return isset($this->bind[$name]) ? $this->bind[$name] : model($name);
    }

    /**
     * 检测
     */
    public function __isset($name)
    {
        
        return isset($this->bind[$name]);
    }
}
