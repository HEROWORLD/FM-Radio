
本项目基于TP5框架开发，仅供学习参考

1.如需使用本项目,需配置相关的小程序appid和app_secret,配置文件application/api/extra/wx_login_config.php
2.导入数据库结构:项目根目录的radio.sql文件

开发目的：本人喜欢听FM电台，喜欢的一个主播经常在微信订阅号中发布音频，但是想回顾之前的历史消息，微信上操作比较麻烦，没有列表，也没有音频的播放切换。于是，开发了一个电台FM小程序端，结合本项目提供的音频地址，实现播放切换功能。

核心功能:
解析公众号消息的音频地址,通过抓包得到微信服务器音频的api：https://res.wx.qq.com/voice/getvoice?mediaid=???
其中mediaid参数值,为公众号文章HTML源码中的 <mpvoice>标签 voice_encode_fileid="???"的属性值
对应项目中封装的方法请参考application/api/service/RadioService.php
 
api文档参考:https://shimo.im/docs/K5p50BheJtsnvEic/

微信小程序客户端请参考另一个仓库

TODO::
1.数据管理后台还未上传
2.主题列表还未做缓存



## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2017 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)
