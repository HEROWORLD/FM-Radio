<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 15:30
 */

namespace app\api\validate;


class TokenGet extends  BaseValidate
{
    protected $rule = [
        "code" => "require|isNotEmpty"
    ];

    protected $message = [
        "code" => "参数code为空，请检查参数是否正确"
    ];
}