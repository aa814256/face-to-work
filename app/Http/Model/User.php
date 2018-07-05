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


    protected $fillable = ['username', 'password'];

    protected $table = 'interview_user';

    //时间保存成时间戳
    public function getDateFormat() {
        return 'U';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =  bcrypt($value);
    }


}
