<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/28
 * Time: 1:32
 */

namespace app\api\controller;

use app\api\model\Collection as CollectionModel;
use app\api\service\Token as TokenService;
use think\Db;
use think\Exception;
use think\Request;
use app\api\model\Radio as RadioModel;

class Upload
{
    //更新播放量
    public function updatePlayNumber()
    {
        //取用户上传的已经播放的音频id
        $param = Request::instance()->put('data/a');

        if (!$param) {
            //不做处理
        } else {
            if (is_array($param)) {
                //去重
                $data = array_unique($param);
                foreach ($data as $audio_id){
                    RadioModel::updatePlayNumber($audio_id);
                }
            }else{
                return false;
            }
        }
        return true;
    }

    //更新用户收藏列表
    public function updateCollection()
    {
        //先取原用户的收藏id
        $uid = TokenService::getCurrentUid();
        $user_collection = CollectionModel::getCollectionByUid($uid)->toArray();
        $results = [];
        foreach ($user_collection as $result){
            $id = $result['audio_id'];
            array_push($results,$id);
        }


        //在取用户上传的收藏id
        $app_collection = Request::instance()->put('data/a');
        $uploadData = [];
        foreach ($app_collection  as $collection){
            $id = $collection['id'];
            array_push($uploadData,$id);
        }

        //对比数组差异
        $insert_id = array_diff($uploadData,$results);
        $delete_id = array_diff($results,$uploadData);

        //更新数据库
        if (!$insert_id){
            //为空不做处理
        }else{
            Db::startTrans();
            try{
                foreach ($insert_id as $audio_id){
                    $insert_data = ['user_id'=>$uid,'audio_id'=>$audio_id,'create_time'=>time()];

                    Db::table("collection")->insert($insert_data);
                    Db::table("radio")->where('id','=',$audio_id)->setInc('collection_number');
                    Db::commit();
                }
            }catch (\Exception $e){
                Db::rollback();
                return false;
            }
        }

        if (!$delete_id){
            //为空不做处理
        }else{
            Db::startTrans();
            try{
                foreach ($delete_id as $audio_id){
                    Db::table("collection")->where('audio_id','=',$audio_id)->where('user_id','=',$uid)->delete();
                    Db::table("radio")->where('id','=',$audio_id)->setDec('collection_number');
                    Db::commit();
                }
            }catch (\Exception $e){
                Db::rollback();
                return false;

            }
        }

        return true;
    }
}