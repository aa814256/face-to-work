<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/4
 * Time: 10:03
 */
//用户页
namespace App\Http\Controllers\Home;


use App\Http\base\controller\BaseController;

use App\Http\Logic\UserLogic;

class UserController extends BaseController
{
    public function index()
    {
        echo 1;die;
    }

    /**
     * 用户注册
     * @return array|string
     */
    public function register()
    {
        $data = [
            'username' => request('username', ''),
            'password' => request('password', ''),
            'password_confirmation' => request('password_confirmation', ''),
            'nickname' => request('nickname', '')
        ];
        $result = UserLogic::addUser($data);
        if ($result->code != 0) {
            return $this->response($result->code, $result->message);
        }

        return $this->response(0, '成功');
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

        if ($result->code != 0) {
            return $this->response($result->code, $result->message);
        }

        return $this->response(0, '', ['data' => $result->data]);
    }

    /**
     * 获取作者信息
     * @return array
     */
   public function getInfo()
   {

       $user_id = request('id');  //用户主键ID

       $result = UserLogic::getById($user_id);

       if ($result->code != 0) {
           return $this->response($result->code, $result->message);
       }

       return $this->response(0, '', ['data' => $result->data]);
   }

}