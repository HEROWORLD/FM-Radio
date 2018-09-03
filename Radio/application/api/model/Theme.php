<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/15
 * Time: 15:39
 */

namespace app\api\model;


use think\Model;

class Theme extends Model
{
    protected $hidden = ["update_time","create_time"];

    //关联主题表
    public function theme()
    {
        return $this->hasMany('Radio','theme_id','id');
    }

    public static function getThemeById($id,$page=1)
    {
        return self::with([
            'theme'=>function($query) use ($page){
                $query->order('release_date','desc')->page("$page,8");
        }])->find($id);
    }

    public static function getThemeTopicImgUrl()
    {
        return self::field('top_img_url')->select();
    }
}