<?php

namespace App\Http\Middleware;

use App\Http\Models\Autophp\PowerUserModel;
use APP\Library\Auth\AuthSdk;
use Closure;
use Illuminate\Support\Facades\View;

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
            $user['password'] = '123456';
            $user['power_role_id'] = 1;
            $user['created_time'] = time();
            $power_user_model->insert($user);
		}
		
        View::share('user', [
            'chsName' => $truename,
            'userId' => $user_id
        ]);
      /*  $res = User::getUserList($user_id);
        if (empty($res) || !isset($res[0])) {
            echo 'No Access!';
            exit;
        }*/
        return $next($request);
    }
}
