<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/19
 * Time: 11:20
 */

namespace app\lib\exception;


class ThemeMissException extends BaseException
{
    public $code = '404';
    public $msg = '请求的主题不存在';
    public $errorCode = 20002;
}