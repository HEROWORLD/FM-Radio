<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 23:13
 */

namespace app\api\model;


use think\Model;

class Radio extends Model
{
    protected $hidden = ['create_time','update_time','delete_time'];

    public static function getRadioById($id)
    {
        return self::where('status','=',1)->find($id);
    }

    //最新一期音频
    public static function getAudioByUpdate()
    {
        return self::order('release_date desc')->find();
    }

    public static function getRadioByNewUpdate()
    {
        return self::where('status','=',1)->order('release_date desc')->limit(4)->select();
    }

    public static function getRadioByComment()
    {
        return self::where('status','=',1)->order('comment_number desc')->limit(4)->select();
    }

    public static function getRadioByCollention()
    {
        return self::where('status','=',1)->order('collection_number desc')->limit(4)->select();
    }

    public static function getRadioByShareNumber()
    {
        return self::where('status',"=",1)->order('share_number desc')->limit(4)->select();
    }

    public static function updatePlayNumber($id)
    {
        return self::where('id','=',$id)->setInc('play_number');
    }

}