<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/5
 * Time: 16:21
 */
namespace App\Http\Logic;

use App\Http\Model\User;

class UserLogic extends BaseLogic
{
    /**
     * 用户登陆验证
     * @param $data
     * @return array
     */
    public static function userLogin($data)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min:6',
        ];

        $message = [
            'username.required' => '用户名必填',
            'password.required' => '密码不能为空',
        ];

        $validator = \Validator::make($data, $rules, $message);
        if ($validator->fails()){
            return ['msg' => $validator->errors()->first()];
        }

        $user = User::where('username', $data['username'])->first();
        if (empty($user)) {
            return ['msg' => '没有该用户'];
        }

        if(!\Hash::check($data['password'],$user['password']))
        {
            return ['msg' => '密码不匹配'];
        }

        return ['msg' => '匹配成功'];
    }

    public static function getInfoById($id)
    {
        if (empty($id)) {
            return ['msg' => ' 无用户ID'];
        }

        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return ['msg' => '无该用户'];
        }

        return ['data' => $user];
    }

}