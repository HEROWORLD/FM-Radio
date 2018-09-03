<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/17
 * Time: 11:42
 */

namespace app\api\model;


use think\Model;

class User extends Model
{
    protected $hidden = ['openid','nickname','extend','update_time','create_time','delete_time'];


    public static function getUserIdByOpenId($openid)
    {
        return self::where('openid','=',$openid)->find();
    }

    public static function createNewUser($openid)
    {
        return self::create([
            'openid'=>$openid
        ]);
    }

    public function collection()
    {
        return self::belongsToMany('Radio','Collection','audio_id','user_id');
    }

}