<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 15:40
 */

namespace app\lib\exception;


class WxChatException extends BaseException
{
    public $code = 400;
    public $msg = "微信服务器接口调用失败";
    public $errorCode = 999;
}