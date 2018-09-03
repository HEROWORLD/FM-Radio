# FM-Radio
### 根据微信公众号链接获取微信的音频链接，一个电台微信小程序api服务端 [小程序客户端](https://github.com/HEROWORLD/FM-WeChat-Applet)

### 本项目基于TP5框架开发，仅供学习参考
+ 如需使用本项目,需配置相关的小程序appid和app_secret,配置文件application/api/extra/wx_login_config.php
+ 导入数据库结构:项目根目录的radio.sql文件

### 开发目的：本人喜欢听FM电台，喜欢的一个主播经常在微信订阅号中发布音频，但是想回顾之前的历史消息，微信上操作比较麻烦，没有列表，没有收藏和评论，也没有音频的播放切换。于是，开发了一个电台FM小程序端，结合本项目提供的音频地址，实现播放切换功能。
### 核心功能:
#### 解析公众号消息的音频地址,通过抓包得到微信服务器音频的api，获取对应公众号文章的音频url，项目中封装的方法请参application/api/service/RadioService.php
  
### TODO::
+ 数据管理后台还未上传
+ 主题列表还未做缓存

## api文档参考（对应页面请参考小程序客户端）：

### 自定义异常参数及说明：
### 返回状态说明
| 状态码   | 含义   | 说明   | 
|:----:|:----|:----:|
| 200   | OK | 请求成功 | 
| 201   | CREATED | 创建成功 | 
| 202   | ACCEPTED | 更新成功 | 
| 400   | BAD REQUEST | 请求的地址不存在或者包含不支持的参数 | 
| 401   | UNAUTHORIZED | 未授权 | 
| 403   | FORBIDDEN | 权限不够，被禁止访问   | 
| 404   | NOT FOUND | 请求的资源不存在 | 
| 500   | INTERNAL SERVER ERROR   | 内部错误 | 

### 通用错误码
| 错误码   | 含义   | status code   | 
|:----:|:----|:----:|
| 10000   | 参数错误   | 400   | 
| 10001   | token无效或者token已过期   | 401   | 
| 10005   | 服务器缓存异常 | 401   | 
| 20001   | 请求的音频不存在 | 404   | 
| 20002   | 请求的主题不存在   | 404   | 
| 30000   | 微信服务器解析错误   | 500   | 

## 
### API列表及参数说明：
### 1.播放列表页
//获取最近更新
>GET    jixia-radio.cn/api/radio/orderByNewUpdate

返回格式：
```
[
  {
      "id": 2,
      "wxurl": "url...",//微信文章链接
      "status": 1,
      "theme_id": 0,
      "img_url": "url...",
      "play_number": 0,
      "release_date": "",
      "collention_number": 32,
      "comment_number": 0,
      "share_number": 0,
      "audio_title": "...",//音频标题
      "audio_api_url": "url..."//音频地址

  },
  {
    ...
  }  
]
```
//获取收藏排行
>GET    jixia-radio.cn/api/radio/orderByCollection

返回格式：
```
[
  {
      "id": 2,
      "wxurl": "url...",//微信文章链接
      "status": 1,
      "theme_id": 0,
      "img_url": "url...",
      "play_number": 0,
      "release_date": "",
      "collention_number": 32,
      "comment_number": 0,
      "share_number": 0,
      "audio_title": "...",//音频标题
      "audio_api_url": "url..."//音频地址

  },
  {
    ...
  },
  {
    ...
  }  
]
```
//获取评论排行
>GET    jixia-radio.cn/api/radio/orderByComment

返回格式参照收藏排行

//获取分享排行
>GET    jixia-radio.cn/api/radio/orderByShare

返回格式参照收藏排行


### 2.播放专题页
获取专题
>GET    jixia-radio.cn/api/theme/:id/:page
>id（必需）:
>1.100天碎碎念 
>2.音乐阳光房 
>3.城市新民谣
>说明：
>page:分页码，默认为1，可省略该值，默认一页数据为：8条

返回格式：
```
{
    "id": 1,
    "name": "100天碎碎念",
    "description": "无",
    "top_img_url": "1",
    "theme": [
                {
                  "id": 2,
                  "wxurl": "url...",//微信文章链接
                  "status": 1,
                  "theme_id": 0,
                  "img_url": "url...",
                  "play_number": 0,
                  "release_date": "",
                  "collention_number": 32,
                  "comment_number": 0,
                  "share_number": 0,
                  "audio_title": "...",//音频标题
                  "audio_api_url": "url..."//音频地址
              }
            ]
}
```
### 3.播放页
//获取指定的音频
>GET    jixia-radio/api/radio/:id

返回格式：
```
{
      "id": 2,
      "wxurl": "url...",//微信文章链接
      "status": 1,
      "theme_id": 0,
      "img_url": "url...",
      "play_number": 0,
      "release_date": "",
      "collention_number": 32,
      "comment_number": 0,
      "share_number": 0,
      "audio_title": "...",//音频标题
      "audio_api_url": "url..."//音频地址
}
```

//获取指定的音频
>GET    jixia-radio.cn/api/radio/default

返回格式：
```
{
      "id": 2,
      "wxurl": "url...",//微信文章链接
      "status": 1,
      "theme_id": 0,
      "img_url": "url...",
      "play_number": 0,
      "release_date": "",
      "collention_number": 32,
      "comment_number": 0,
      "share_number": 0,
      "audio_title": "...",//音频标题
      "audio_api_url": "url..."//音频地址
}
```
### 4.个人中心页面
//获取token，小程序初始化时触发
>POST    jixia-radio.cn/api/token/user
>@param  code:小程序wx.login方法提供的code码

返回格式：
```
{
      "token"=>"..."      
}
```

//提交数据之前触发，验证token令牌是否有效或者过期
>POST    jixia-radio.cn/api/token/verify
>@param  code:小程序wx.login方法提供的code码

返回格式：Boolean，若返回结果为false，token验证失败，则小程序客户端应再次调用jixia-radio.cn/api/token/user获取token

//获取用户收藏列表
>POST    jixia-radio.cn/api/user/collection
>@header  token

返回格式：
```
[
  {
      "id": 2,
      "wxurl": "url...",//微信文章链接
      "status": 1,
      "theme_id": 0,
      "img_url": "url...",
      "play_number": 0,
      "release_date": "",
      "collention_number": 32,
      "comment_number": 0,
      "share_number": 0,
      "audio_title": "...",//音频标题
      "audio_api_url": "url..."//音频地址

  },
  {
    ...
  }  
]
```

//更新播放量
>PUT    jixia-radio.cn/api/radio/update/playNumber
>@param  data:[6, 8, 9, 10, 4]  播放过的audio_id

返回格式：Boolean

//更新用户收藏中心
>PUT    jixia-radio.cn/api/user/updatecollection
>@header token
>@param  data:[{}]

返回格式：Boolean





