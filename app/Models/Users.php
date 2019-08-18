<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    public $timestamps = false;
    protected $table = 'users';


//    public static function getArticleList(){
//        return self::orderBy('time','desc');
//    }

    public static function getUsersList(){
        return self::orderBy('created_at','desc');
    }

    public static function getUser($id){
        return self::where('id','=',$id)->first();
    }

    public function isadmin() {
        if($this->is_admin==1){
            return true;
        }
        return false;
    }
}
