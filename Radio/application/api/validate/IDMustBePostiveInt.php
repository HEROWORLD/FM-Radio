<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 23:08
 */

namespace app\api\validate;


class IDMustBePostiveInt extends BaseValidate
{

    protected $rule = [
       'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' =>'ID必须为正整数'
    ];
}