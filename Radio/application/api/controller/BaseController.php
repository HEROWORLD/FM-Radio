<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/16
 * Time: 0:04
 */

namespace app\api\controller;
use app\api\model\Radio as RadioModel;
use app\api\service\CacheService;
use app\api\service\RadioService;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\AudioMissException;
use app\lib\exception\WxApiException;
use think\Controller;
use think\Request;


class BaseController extends Controller
{
    private $cache_name;
    private $cache_tag;

    public function getRadio($id)
    {
        (new IDMustBePostiveInt())->goCheck();

        $result = RadioModel::getRadioById($id)->toArray();
        if (!$result) {
            throw new AudioMissException();
        }

        $this->cache_tag = 'audio_id';
        $this->cache_name = (string)$result['id'];

        $cacheValue = CacheService::getCache($this->cache_tag, $this->cache_name);

        if (!$cacheValue) {
            $audio = new RadioService($result['wxurl']);
            $audio_title = $audio->getArticleTitle();
            $audio_api_url = $audio->getAudioUrl();
            if (empty($audio_api_url) || empty($audio_title)) {
                throw new WxApiException();
            }
            $result['audio_title'] = $audio_title;
            $result['audio_api_url'] = $audio_api_url;

            $result['release_date'] = date("m-d",$result['release_date']);

            $expire_in = config('setting.Audio_expire_time');
            //设置缓存
            CacheService::setCache($this->cache_tag, $this->cache_name, $result, $expire_in);
            return $result;
        } else {
            return $cacheValue;
        }

    }

    //封装播放列表
    protected function getPlayList($params = [])
    {
        $results = [];
        foreach ($params as $param) {
            $audioIDs = $param['id'];
            Request::instance()->get(['id' => $audioIDs]);
            $result = $this->getRadio($audioIDs);
            array_push($results, $result);
        }
        return $results;
    }

}