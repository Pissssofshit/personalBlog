<?php

namespace App\Http\Controllers\Admins;

use App\Article;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comments;
use App\Models\Post;
use App\Models\Users;
use App\Models\Visit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::getUsersList()->paginate(10);

        return view('admins.users.index', compact('users'));
    }
}
