<?php

namespace App\Http\Middleware;

use App\Http\Models\Autophp\PowerUserModel;
use APP\Library\Auth\AuthSdk;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authsdk = AuthSdk::getInstance();


		if (!$authsdk->isLogin()) {
            return $authsdk->requireLogin();
        }
        $truename = AuthSdk::getInstance()->getChsName();
        $user_id = AuthSdk::getInstance()->getUserId() + 0;
        $power_user_name = AuthSdk::getInstance()->getUserName();
        $power_user_model = new PowerUserModel();
		$login_user = $power_user_model->detail($user_id);

		
        if(empty($login_user)){
            $user['power_user_id'] = $user_id;
            $user['power_user_name'] = $power_user_name;
            $user['truename'] = $truename;
            $user['password'] = '******';
            $user['power_role_id'] = 1;
            $user['created_time'] = time();
            $power_user_model->insert($user);
		}
		
        View::share('user', [
            'chsName' => $truename,
            'userId' => $user_id
		]);

		$tree = Config('const.menu');
		if (empty($tree)) {
			throw new \Exception("menu isn't configured!");
		}

        View::share("bar_tree",$tree);
        //$project['common']['cdn'] = "http://imagecache.joyport.com/ui";
        $requestpath = Request::path();
        $requestpath = trim($requestpath,"/");
        $requestpaths = explode("/",$requestpath);
        $requestpath = isset($requestpaths[0])&& isset($requestpaths[1])?$requestpaths[0]."/".$requestpaths[1]:"";
        //View::share("project",$project);
        View::share('request_path',$requestpath);
      /*  $res = User::getUserList($user_id);
        if (empty($res) || !isset($res[0])) {
            echo 'No Access!';
            exit;
        }*/
        return $next($request);
    }
}
