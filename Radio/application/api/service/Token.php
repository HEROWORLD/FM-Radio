<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 10:31
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        //32字符组成一组随机字符串
        $str = getRandChar(32);
        //取当前时间戳
        $time = $_SERVER['REQUEST_TIME_FLOAT'];
        //加入盐
        $salt = config('setting.token_salt');

        $result = md5($str.$time.$salt);

        return $result;
    }

    //根据关键值获取token缓存中的参数
    public static function getCurrenTokenVar($key)
    {
        $token = Request::instance()->header('token');
        if (!$token){
            throw new TokenException([
               'msg' => '未携带token',
            ]);
        }
        $value = Cache::get($token);

        if (!$value){
            throw new TokenException();
        }else{
            if(!is_array($value)){
                $value = json_decode($value,true);
            }
            if (array_key_exists($key,$value)){
                return $value[$key];
            }else{
                throw new Exception(['尝试获取的token变量:' . $key . '不存在']);
            }
        }
    }

    //获取当前用户的uid
    public static function getCurrentUid()
    {
        return self::getCurrenTokenVar('uid');
    }

    public static function verifyToken($token)
    {
        if(!$token){
            throw new TokenException([
                'msg' => 'Token已过期或Token为空'
            ]);
        }
        $exist = Cache::get($token);
        if($exist){
            return true;
        }
        else{
            return false;
        }
    }
}