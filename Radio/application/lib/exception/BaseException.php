<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/14
 * Time: 4:24
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //状态码 404 200
    public $code = 400;
    //具体错误信息
    public $msg = "参数错误";
    //自定义的错误码
    public $errorCode = 10000;

    public function __construct($param = [])
    {
        if (!is_array($param)) {
            return;
        }
        if (array_key_exists("code",$param)){
            $this->code = $param['code'];
        }
        if (array_key_exists("msg",$param)){
            $this->msg = $param['msg'];
        }
        if (array_key_exists('errorCode',$param)){
            $this->errorCode = $param['errorCode'];
        }
    }
}