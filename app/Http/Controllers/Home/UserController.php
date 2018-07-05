<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/4
 * Time: 10:03
 */
//用户页
namespace App\Http\Controllers\Home;


use App\Http\Logic\UserLogic;
use App\Http\Model\User;

class UserController extends BaseController
{
    public function index()
    {
        echo 1;die;
//        return view();
    }

    /**
     * 用户注册
     * @return array|string
     */
    public function register()
    {

        $rules = [
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];

        $data = [
            'username' => request('username'),
            'password' => request('password'),
            'password_confirmation' => request('password_confirmation')
        ];

        $message = [
        'username.required' => '用户名必填',
        'password.required' => '密码不能为空',
        'password_confirmation.required' => '请重新输入确认密码'
        ];


        $validator = \Validator::make($data, $rules, $message);
        if ($validator->fails()){
            return ['msg' => $validator->errors()->first()];
        }

        $user = new User($data);
        $user->save();
        return  '成功';
    }

    /**
     * 验证用户登陆
     * @return array
     */
    public function login()
    {
        $data = [
            'username' => request('username'),
            'password' => request('password'),
        ];

        $result = UserLogic::userLogin($data);
        return $result;
    }

   public function getInfo()
   {
       $user_id = request('id');  //用户主键ID
        echo 1;
   }


   public function test()
   {
       echo 'test';
   }
}