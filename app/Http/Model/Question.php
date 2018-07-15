<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/14
 * Time: 11:12
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'interview_question';

    //时间保存成时间戳
    public function getDateFormat()
    {
        return 'U';
    }

}