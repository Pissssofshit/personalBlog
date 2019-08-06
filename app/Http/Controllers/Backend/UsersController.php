<?php
namespace App\Http\Controllers\Backend;

use App\Article;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
//	public function index() {
//		echo "zzh";
//	}
	public function index(Request $request,$id){
//	    $categories=[];
        $user = Users::getUser($id);
	    return view('users.show',compact('user'));
//	    return view('welcome');
    }

//    public function show(Request $request,$id)
//    {
////        $post->visit($request);
//        $post = Article::getArticle($id);
//        return view('posts.show', compact('post'));
//    }
}
