<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/15
 * Time: 16:00
 */

namespace app\api\controller;

use app\api\model\Theme as ThemeModel;
use app\api\validate\ThemeMustBePostiveInt;
use app\lib\exception\ThemeMissException;
use think\Request;

class Theme extends BaseController
{

    //todo::记录缓存


    public function getThemeList($id,$page=1)
    {
        //将page注入get请求进行验证
        Request::instance()->get(['page' => $page]);
        (new ThemeMustBePostiveInt())->goCheck();
        $result = ThemeModel::getThemeById($id,$page);
        if(!$result){
            throw new ThemeMissException();
        }else{
            $result = $result->toArray();
        }

        //重新拼合关联的theme数据
        $themeIDs = $result['theme'];
        $themeLists = parent::getPlayList($themeIDs);
        $result['theme'] = $themeLists;

        return $result;
    }

    public function getThemeTopicImg()
    {
        $result = ThemeModel::getThemeTopicImgUrl();
        if (!$result){
            throw new ThemeMissException([
                'msg' => '请求主题图片失败'
            ]);
        }
        return $result;
    }
}