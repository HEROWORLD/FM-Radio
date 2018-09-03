<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 10:34
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WxChatException;
use think\Cache;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    private $wx_code;
    private $app_id;
    private $app_secret;
    private $login_url;

    function __construct($code)
    {
        $this->wx_code = $code;
        $this->app_id = config('wx_login_config.app_id');
        $this->app_secret = config('wx_login_config.app_secret');
        $this->login_url = sprintf(config('wx_login_config.login_url'), $this->app_id, $this->app_secret, $code);
    }

    public function get()
    {
        $result = curl_get($this->login_url);
        $wxResult = json_decode($result,true);
        if (!$wxResult){
            throw new Exception("获取Session_key和openID时异常，微信内部错误");
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if ($loginFail){
                return $this->processLoginError($wxResult);
            }else{
                $token = $this->grantToken($wxResult);
                return $token;
            }
        }
    }

    private function grantToken($wxResult)
    {
//        获取openid
//        检查openid是否已经存在
//        如果存在返回uid，如果不存在，创建新用户，返回uid
//        准备缓存数据(含scope权限)，生成token，一并写入缓存
//        返回token至客户端
        $openid = $wxResult['openid'];
        $user = UserModel::getUserIdByOpenId($openid);
        if ($user){
            $userId = $user->id;
        }else{
            $new_user = UserModel::createNewUser($openid);
            $userId = $new_user->id;
        }
        $cacheValue = $this->prepareCacheValue($wxResult,$userId);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    private function prepareCacheValue($wxResult,$userId)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $userId;
        //scope=16代表APP用户的权限数值
        //scope=32代表CMS（管理员）的权限数值
        $cacheValue['scope'] = ScopeEnum::User;

        return $cacheValue;
    }


    //要生成缓存成功才返回token
    private function saveToCache($cacheValue){
        $token = self::generateToken();
        $value = json_encode($cacheValue);
        $token_expire_in = config('setting.token_expire_in');

        $result = Cache::set($token,$value,$token_expire_in);
        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => '10005'
            ]);
        }

        return $token;
    }

    private function processLoginError($wxResult)
    {
        throw new WxChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

}