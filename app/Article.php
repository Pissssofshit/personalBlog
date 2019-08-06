<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $timestamps = false;
    protected $table = 'article';


    public static function getArticleList(){
        return self::orderBy('time','desc');
    }
    public static function getArticle($id){
        return self::where('id','=',$id)->first();
    }
}
