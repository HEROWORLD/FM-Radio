<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 15:22
 */

namespace app\api\controller;


use app\api\service\UserToken;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;
use think\Exception;
use app\api\service\Token as TokenService;

class Token
{
    public function getToken($code)
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        if (!$token){
            throw new Exception(['获取token出错，请联系管理员']);
        }

        return [
            'token'=>$token
        ];
    }

    public function verifyToken($token='')
    {
        if (!$token){
            throw new ParameterException([
               'token不允许为空'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }


}