<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/10
 * Time: 10:26
 */
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

//用户行为表  (收藏、点赞)
class UserBehavior extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'interview_user_behavior';


    const TYPE_COLLECT =  1;   //类型 收藏
    const TYPE_LIKE = 2;       //类型 点赞
    //时间保存成时间戳
    public function getDateFormat()
    {
        return 'U';
    }
}