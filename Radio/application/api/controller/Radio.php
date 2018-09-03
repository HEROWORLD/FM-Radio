<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 1:17
 */

namespace app\api\controller;

//Loader::import('cos-php-sdk-v5.vendor.autoload',VENDOR_PATH,'.php');
use app\api\model\Radio as RadioModel;
use think\Request;

class Radio extends BaseController
{

    public function getRadio($id)
    {
        return parent::getRadio($id);
    }

    //播放器默认加载音频,默认最近更新的音频
    public function getDefaultAudio()
    {
        $id = RadioModel::getAudioByUpdate()->id;
        Request::instance()->get(['id' => $id]);
        $result = parent::getRadio($id);
        return $result;
    }

    //按收藏数量从高到低排序，降序
    public function getCollectionPlayList()
    {
        $collection_number_lists = RadioModel::getRadioByCollention()->toArray();
        $results = parent::getPlayList($collection_number_lists);
        return $results;

    }

    //按评论数量从高到低排序，降序
    public function getCommentPlayList()
    {
        $comment_number_lists = RadioModel::getRadioByComment()->toArray();
        $results = parent::getPlayList($comment_number_lists);

        return $results;
    }

    //按分享数量从高到低排序，降序
    public function getSharePlayList()
    {
        $share_number_lists = RadioModel::getRadioByShareNumber()->toArray();
        $results = parent::getPlayList($share_number_lists);
        return $results;
    }

    //按更新时间从高到低排序，降序
    public function getNewUpdatePlayList()
    {
        $newUpdateList = RadioModel::getRadioByNewUpdate()->toArray();
        $results = parent::getPlayList($newUpdateList);
        return $results;
    }


}