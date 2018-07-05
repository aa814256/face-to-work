<?php

namespace App\Http\Model;



class Article extends HomeBaseModel
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public $timestamps = true;
    protected $table = 'home_article';
}