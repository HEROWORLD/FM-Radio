<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 12:54
 */

namespace app\api\model;



use think\Model;

class Collection extends Model
{
    public $table = 'collection';

    public static function getCollectionByUid($uid)
    {
        return self::field('audio_id')->order('create_time desc')->where('user_id','=',$uid)->limit(7)->select();
    }


}