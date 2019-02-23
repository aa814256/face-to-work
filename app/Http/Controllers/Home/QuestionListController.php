<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/14
 * Time: 10:37
 */
//题的列表-用户展示
namespace App\Http\Controllers\Home;

use App\Http\base\controller\BaseController;
use App\Http\Logic\QuestionLogic;

class QuestionListController extends BaseController
{
    public function index()
    {
        return view();
    }

    public function query()
    {
        $condition = [
         ];

        $a = '2208';
        $result = QuestionLogic::getListByHome($condition);
        if ($result->code != 0) {
            return $this->response($result->code, $result->message);
        }

        return $this->response(0, '', ['data' => $result->data]);
    }
}