<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $timestamps = false;
    protected $table = 'article';



    public static function getAllCommentsList(){
        return self::leftJoin('article','article.id','comment.articleId')->leftJoin('users','users.id','commenterId')->orderBy('comment.id','desc');
    }
    public static function getCommentsList($articleId){
        return self::where('articleId','=',$articleId)->leftJoin('users','users.id','commenterId')->orderBy('comment.id','desc');
    }
    public static function getComment($commentId){
        return self::where('id','=',$commentId)->get();
    }



    public static function insertData($data){
        return self::insert($data);
    }
}
