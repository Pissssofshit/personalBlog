<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    public $timestamps = false;
    protected $table = 'comment';


    public static function getAllCommentsList(){
        return self::select('comment.id','comment.content','users.name','article.title')->leftJoin('article','article.id','comment.articleId')->leftJoin('users','users.id','commenterId')->orderBy('comment.id','desc');
    }
    public static function getCommentsList($articleId){
        return self::where('articleId','=',$articleId)->leftJoin('users','users.id','commenterId')->orderBy('comment.id','desc');
    }
    public static function getComment($commentId){
        return self::where('id','=',$commentId)->get()->first();
    }
//    public static function updateComment($data){
//        self::update($data);
//    }



    public static function insertData($data){
        return self::insert($data);
    }
}
