<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/14
 * Time: 11:12
 */
namespace App\Http\Logic;

use App\Http\base\Logic\BaseLogic;
use App\Http\Model\Question;

class QuestionLogic extends BaseLogic
{
    public static function getListByHome($condition)
    {
        $where = [];

        $question_list = Question::where($where)->get();

        return self::success($question_list);
    }
}