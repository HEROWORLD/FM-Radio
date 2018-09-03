<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/14
 * Time: 15:02
 */

namespace app\lib\exception;


class WxApiException extends BaseException
{
    public $code = 500;
    public $msg = '微信服务器地址解析错误，请联系管理员';
    public $errorCode = 30000;
}