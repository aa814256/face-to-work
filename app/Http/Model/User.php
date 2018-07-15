<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/4
 * Time: 9:52
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $fillable = ['username', 'password', 'nickname'];  //允许赋值的字段
    protected $hidden = ['password', 'create_time', 'update_time'];

    protected $table = 'interview_user';

    //时间保存成时间戳
    public function getDateFormat()
    {
        return 'U';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =  bcrypt($value);
    }

    public function userBehavior()
    {
        return $this->hasMany('App\Http\Model\UserBehavior', 'user_id', 'id');
    }

}
