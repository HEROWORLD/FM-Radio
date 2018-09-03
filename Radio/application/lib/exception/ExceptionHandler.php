<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/14
 * Time: 4:48
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            if (config("app_debug")) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = "服务器内部错误，不想告诉你原因";
                $this->errorCode = 999;
                $this->recordErrorlog($e);
            }
        }

        $errorUrl = Request::instance()->url();

        $result = [
            'msg' => $this->msg,
            'errorCode' => $this->errorCode,
            'errorUrl' => $errorUrl
        ];

        return json($result, $this->code);
    }

    private function recordErrorlog(Exception $e)
    {
        Log::init([
            // 日志记录方式，内置 file socket 支持扩展
            'type'  => 'file',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ["error"],
        ]);
        log::record($e->getMessage(),"error");
    }
}