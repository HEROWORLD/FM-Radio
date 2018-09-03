<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/14
 * Time: 13:59
 */

namespace app\lib\exception;


class AudioMissException extends BaseException
{
    public $code = '404';
    public $msg = '请求的音频不存在';
    public $errorCode = 20001;
}