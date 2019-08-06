<?php
namespace App\Http\Controllers\Backend;

use App\Article;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
//	public function index() {
//		echo "zzh";
//	}
	public function home(){
	    $categories=[];
	    return view('posts.index');
//	    return view('welcome');
    }

    public function show(Request $request,$id)
    {
//        $post->visit($request);
        $post = Article::getArticle($id);
        $post->comments = [];
        return view('posts.show', compact('post'));
    }
    public function postComment(Request $request,$id)
    {

//        $post->visit($request);
        $param = $request->input();
//        var_dump($param);

        $user_id = Auth::id();
        $content = $param['content'];
        $articleId = $id;
        $data["commenterId"] = $user_id;
        $data["articleId"] = $articleId;
        $data['content'] = $content;
        $data['time'] = time();
        Comments::insertData($data);
//        echo 1;
//        die;
        $commentsList = Comments::getCommentsList($articleId)->paginate(10);
        $commentsList = $commentsList->items();
        //todo
        foreach ($commentsList as &$item){
            $item->time = Date('Y-m-d h:i:s',$item->time);
        }
        unset($item);
        $post = Article::getArticle($id);
        $post->comments = $commentsList;
        return view('posts.show',compact('post'));
    }
}
