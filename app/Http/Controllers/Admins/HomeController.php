<?php

namespace App\Http\Controllers\Admins;

use App\Article;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comments;
use App\Models\Post;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 所有文章统计
        $total = [
            'posts'    => Article::count(),
            'comments' => Comments::count(),
//            'visits'   => Visit::count(),
//            'follows'  => DB::table('follows')->count(),
        ];

        // 本年文章统计
        $year = Carbon::now()->year;
        $year = [
//            'posts'    => Post::whereYear('created_at', $year)->count(),
//            'comments' => Comment::whereYear('created_at', $year)->count(),
//            'visits'   => Visit::whereYear('created_at', $year)->count(),
//            'follows'  => DB::table('follows')->whereYear('created_at', $year)->count(),
        ];

        // 当月文章统计
        $month = Carbon::now()->month;
        $month = [
//            'posts'    => Post::whereMonth('created_at', $month)->count(),
//            'comments' => Comment::whereMonth('created_at', $month)->count(),
//            'visits'   => Visit::whereMonth('created_at', $month)->count(),
//            'follows'  => DB::table('follows')->whereMonth('created_at', $month)->count(),
        ];

        // 当天文章统计
        $day   = Carbon::now()->toDateString();
        $today = [
//            'posts'    => Post::whereDate('created_at', $day)->count(),
//            'comments' => Comment::whereDate('created_at', $day)->count(),
//            'visits'   => Visit::whereDate('created_at', $day)->count(),
//            'follows'  => DB::table('follows')->whereDate('created_at', $day)->count(),
        ];

        $list = [
            'total' => ['name' => '全部', 'value' => $total],
            'year'  => ['name' => '本年', 'value' => $year],
            'month' => ['name' => '全月', 'value' => $month],
            'today' => ['name' => '今日', 'value' => $today],
        ];

        return view('admins.index', compact('list'));
    }

    public function deleteComment(Request $request,$id){
        Comments::destroy($id);

        return redirect('/admin/commentmanager');
    }


    public function updateComment(Request $request,$id){
        $param = $request->input();
        $data['content'] = $param['content'];
        Comments::where('id',$id)->update($data);

        return redirect('/admin/commentmanager');
    }

    public function commentManager(){
        $comments = Comments::getAllCommentsList()->paginate(10);
        $tmp = $comments->items();
        return view('admins.comments.index',compact('comments'));
    }

    public function commentEditIndex(Request $request,$id){
        $comment = Comments::getComment($id);
        return view('admins.comments.edit',compact('comment'));
    }

    public function createArticle(Request $request){
        return view('admins.posts.create_edit');
    }
    public function updateArticle(Request $request,$id){

    }
    public function saveArticle(Request $request){
        $param = $request->input();
//        var_dump($param);
        $data = [];
        $data['title'] = $param['title'];
        $data['content'] = $param['body'];
        $data['jianjie'] = $param['jianjie'];
        $data['authorId'] = Auth::id();
        $data['time'] = date('Y-m-d H:i',time());
        \App\Models\Article::insertData($data);
    }
}
