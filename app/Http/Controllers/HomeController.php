<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleBakup;
use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = null;
        $posts = Article::getArticleList()->paginate(10);
//        var_dump($posts);
        foreach ($posts as &$post){
            $post->comments = [];
//            var_dump($post->authorId);
//            die;
            $post->author = Users::getUser($post->authorId);
        }
        unset($post);

//        var_dump($posts);
//        die;
        return view('posts.index',compact('posts'));
    }

    public function show(Article $article, Request $request)
    {
//        $post->visit($request);

//        $post->body = $markdown->convertMarkdownToHtml($post->body);

        return view('posts.show', compact('article'));
    }
}
