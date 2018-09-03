<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 23:12
 */

namespace app\api\service;


class RadioService
{
    protected $str;
    protected $wx_article_title;
    protected $audio_api_prefix;
    protected $audio_api_key;

    function __construct($wxurl)
    {
        $this->str = file_get_contents($wxurl);
        $this->wx_article_title = config('wxUrlSetting.wx_article_title');
        $this->audio_api_prefix =config('wxUrlSetting.audio_api_prefix');
        $this->audio_api_key = config('wxUrlSetting.audio_api_Key');
    }

    public function getAudioUrl()
    {
        $key_word = self::getValue($this->str,$this->audio_api_key);
        $audio_api_url = $this->audio_api_prefix.$key_word;
        return $audio_api_url;
    }

    public function getArticleTitle()
    {
        $title = self::getValue($this->str,$this->wx_article_title);
        return $title;
    }


    /**
     * 取html某个属性对应的值
     * @param $str—>需要匹配的字符串
     * @param $key->html的属性
     * @return string->某个属性对应的值
     */
    public static function getValue($str, $key)
    {
        $pattern = "/[\s\S]*\s".$key."[\s*=\"\\s*']+([^\"\']*)[\"\'][\s\S]*/";
        $value=preg_replace($pattern,"$1",$str);
        return $value;
    }



}