<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:25
 */

namespace app\api\controller;

use app\api\model\Collection as CollectionModel;
use app\api\service\Token as TokenService;
use think\Request;

class User extends BaseController
{
    public function getUserCollention()
    {
        $uid = TokenService::getCurrentUid();
        $results = CollectionModel::getCollectionByUid($uid)->toArray();

        $collectionList = [];
        foreach ($results as $key => $result){
            $id = $result['audio_id'];
            Request::instance()->get(['id'=>$id]);
            $result = parent::getRadio($id);
            array_push($collectionList,$result);
        }
        return $collectionList;
    }

    public function getUserCollectionAll()
    {
        //todo::获取该用户所有的收藏
    }


}