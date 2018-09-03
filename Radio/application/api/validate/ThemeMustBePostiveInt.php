<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/19
 * Time: 10:51
 */

namespace app\api\validate;


class ThemeMustBePostiveInt extends BaseValidate
{
    protected $rule =[
        'id' => 'require|isPositiveInteger',
        'page' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id' =>'ID必须为正整数',
        'page' =>'Page必须为正整数',
    ];

}