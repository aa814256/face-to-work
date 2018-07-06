<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/6
 * Time: 10:29
 */
namespace App\Http\base\logic;

class Result implements \ArrayAccess
{
    public $code;
    public $message;
    public $data;

    public function offsetSet($name, $value)
    {

    }

    public function offsetExists($name)
    {
        return $this->__isset($name);
    }

    public function offsetUnset($name)
    {

    }

    public function offsetGet($name)
    {
        return $this->__get($name);
    }

    public function __construct($code = 0, $message = '', $data = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * 返回错误信息
     * @param string $message
     * @param int $code
     * @param array $data
     * @return static
     */
    public static function error($message = '', $code = 1, $data = [])
    {
        return new static($code, $message, $data);
    }

    /**
     * 返回成功数据
     * @param array $data
     * @return Result
     */
    public static function success($data = [])
    {
        return new static(0, 'success', $data);
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }


}
