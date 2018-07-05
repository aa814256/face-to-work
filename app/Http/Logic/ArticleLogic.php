<?php
/**
 * Created by PhpStorm.
 * User: jiangbowen
 * Date: 2018/7/2
 * Time: 15:34
 */
namespace App\Http\Logic;

use App\Http\Model\Author;
use Illuminate\Database\Query\Builder;


class ArticleLogic
{
     public static function getList($id)
     {
         $where = [];
         if (!empty($id)) {
             $where['id'] = $id;
         }
         $article = Author::where('type', 3)

             ->with(['article' => function($query) {
             /** @var $query  Builder */
                 $query->select('id', 'author_id', 'type');
             }])
             ->orderby('id', 'desc')
             ->where($where)
             ->paginate(10);


         return $article;
     }
}