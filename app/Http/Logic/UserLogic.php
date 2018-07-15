<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/5
 * Time: 16:21
 */
namespace App\Http\Logic;

use App\Http\base\Logic\BaseLogic;
use App\Http\Model\User;
use App\Http\Model\UserBehavior;

class UserLogic extends BaseLogic
{

    /**
     * @param $data
     * @return mixed
     */
    public static function addUser($data)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];

        $message = [
            'username.required' => '用户名必填',
            'password.required' => '密码不能为空',
            'password_confirmation.required' => '请重新输入确认密码'
        ];

        $validator = \Validator::make($data, $rules, $message);
        if ($validator->fails()){

            return self::error($validator->errors()->first());
        }

        $user = new User($data);
        if (!$user->save()) {
            return self::error('保存失败');
        }
        return self::success();
    }


    /**
     * 用户登陆验证
     * @param $data
     * @return array|mixed
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

            return self::error('无该用户');
        }

        //验证密码
        if(!\Hash::check($data['password'],$user['password']))
        {
            return self::error('密码不匹配');

        }

        return self::success($user);
    }

    /**
     * 获取用户信息
     * @param $id
     * @return array|mixed
     */
    public static function getById($id)
    {
        if (empty($id)) {
            return self::error('无ID');
        }

        //隐藏用户密码及创建/更新时间
        $user = User::where('id', $id)->select(['id','nickname'])->first();
        if (empty($user)) {
            return self::error('用户信息不存在');
        }

        //用户点赞收藏总数 type分组   之后匹配
        $user_behavior = UserBehavior::where('user_id', $id)
            ->groupBy('type')
            ->selectRaw('count(*) as count, type')
            ->pluck('count', 'type')
            ->toArray();

        $user['collect_count'] = isset($user_behavior[UserBehavior::TYPE_COLLECT]) ? $user_behavior[UserBehavior::TYPE_COLLECT] : 0;
        $user['like_count'] = isset($user_behavior[UserBehavior::TYPE_LIKE]) ? $user_behavior[UserBehavior::TYPE_LIKE]: 0;


        return self::success($user);
    }

}