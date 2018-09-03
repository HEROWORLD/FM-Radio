<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];

use think\Route;


Route::get('api/radio/:id','api/radio/getRadio',[],['id'=>'\d+']);
Route::get('api/radio/default','api/radio/getDefaultAudio');
Route::get('api/radio/orderByNewUpdate','api/radio/getNewUpdatePlayList');
Route::get('api/radio/orderByCollection','api/radio/getCollectionPlayList');
Route::get('api/radio/orderByComment','api/radio/getCommentPlayList');
Route::get('api/radio/orderByShare','api/radio/getSharePlayList');

Route::get('api/theme/:id','api/Theme/getThemeList',[],['id'=>'\d+']);
Route::get('api/theme/:id/:page','api/Theme/getThemeList',[],['id'=>'\d+','page'=>'\d+']);
Route::get('api/theme/top_img','api/Theme/getThemeTopicImg');

Route::post('api/token/user','api/Token/getToken');
Route::post('api/token/verify','api/Token/verifyToken');

Route::post('api/user/collection','api/user/getUserCollention');

Route::put('api/radio/update/playNumber','api/upload/updatePlayNumber');

Route::put('api/user/updateCollection','api/upload/updateCollection');



