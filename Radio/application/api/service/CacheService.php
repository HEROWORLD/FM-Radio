<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/14
 * Time: 4:22
 */

namespace app\api\service;


use think\Cache;

class CacheService
{
    public static function setCache($tag,$name,$value,$time)
    {
        return Cache::tag($tag)->set($name,$value,$time);
    }

    public static function getCache($tag,$name)
    {
        return Cache::tag($tag)->get($name);
    }
}