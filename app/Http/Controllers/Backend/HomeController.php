<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
//	public function index() {
//		echo "zzh";
//	}
	public function home(){
	    $categories=[];
	    return view('posts.index');
//	    return view('welcome');
    }
}
