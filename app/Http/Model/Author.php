<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/2
 * Time: 17:59
 */
namespace App\Http\Model;



class Author extends HomeBaseModel
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public $timestamps = true;
    protected $table = 'home_author';

    protected $casts = [
        'id' => 'int'
    ];

    public function article()
    {
        return $this->hasMany('App\Http\Model\Article', 'author_id', 'id');
    }
}