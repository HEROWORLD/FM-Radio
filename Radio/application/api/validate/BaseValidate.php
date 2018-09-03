<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 23:03
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $param = Request::instance()->param();
        $result = $this->batch()->check($param);

        if (!$result){
            throw new ParameterException([
                'msg' => $this->error,
            ]);
        }else{
            return true;
        }
    }

    //    ID正整数检验
    protected function isPositiveInteger($value, $rule = "", $data = "", $field = "")
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //不能为空
    protected function isNotEmpty($value, $rule = "", $data = "", $field = "")
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
}