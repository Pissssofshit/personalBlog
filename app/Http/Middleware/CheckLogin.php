<?php

namespace App\Http\Middleware;

use App\Http\Models\Autophp\PowerUserModel;
use App\Http\Models\Autophp\PowerRoleModel;
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


		$user = []; //保存登陆用户信息，存入power_user表

		if (!$authsdk->isLogin()) {
			setcookie("login_time", time());
            return $authsdk->requireLogin();
		}

		$login_time = intval(@$_COOKIE['login_time']);
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
			$user['created_time'] = $login_time;
			$user['last_login_time'] = $login_time;
			$user['login_count'] = 1;
            $power_user_model->insert($user);
		}
		elseif ($login_time > $login_user->last_login_time) {
			$user['last_login_time'] = $login_time;
			$user['login_count'] = $login_user->login_count + 1; 

			$power_user_model->update($user_id, $user);
		}
		
        View::share('user', [
            'chsName' => $truename,
            'userId' => $user_id
		]);


		//后台左侧菜单栏start
		if ($request->path() == "autophp") {
			return $next($request);
		}

		global $envmark;	
		if ($envmark == "development" || $login_user->is_root) {
			$tree = Config("const.bar_tree");
		}
		else {
			$power_role_model = new PowerRoleModel();
			$login_role = $power_role_model->detail($login_user->power_role_id);

		   	if (!$this->check_auth($login_role,  $request->path())) {
				echo("<pre>");
				echo("1、如果您是正式用户，无权限, 请联系管理员授权\n");
				echo("2、如果您是开发者环境，请配置envmark.txt文件, 设置模式为development(配置.envdevelopment)，则登陆账号不做权限校验\n");
				echo("3、如果您是测试者环境，请配置envmark.txt文件, 先设置模式development(配置.envdevelopment),w 登陆后，配置管理员角色后，然后设置模式为test(配置.envtest)，在测试配置环境模式下进行测试\n");
				echo("</pre>");
				exit();
			}
			else {
				$tree = $this->get_tree($login_role);
			}
		}
		
		if (empty($tree)) {
			throw new \Exception("menu isn't configured!");
		}
        View::share("bar_tree",$tree);
		
		$requestpath = Request::path();
        $requestpath = trim($requestpath,"/");
        $requestpaths = explode("/",$requestpath);
        $requestpath = isset($requestpaths[0])&& isset($requestpaths[1])?$requestpaths[0]."/".$requestpaths[1]:"";
        View::share('request_path',$requestpath);
		//后台左侧菜单栏end
		
        return $next($request);
	}


	private function check_auth($admin, $uri_path){
		$power_tree = Config("const.power_tree");

		$power_admin = (array)json_decode($admin['content']);

		$path = explode("/", $uri_path);
		$namespace = $path[0];
		$controller = @$path[1];
		$action = @$path[2];


		foreach ($power_tree['no_valide'] as $value){
			if( $controller.'/*' == $value){
				return true;
			}
			$arr = explode('/', $value);		
			if($controller == $arr[0] && strstr($arr[1], $action)){
				return true;
			}				
		}			
		foreach ($power_admin as $value){
			foreach($value as $v){
				if( $controller.'/*' == $v){
					return true;
				}
				$arr = explode('/', $v);		
				if($controller == $arr[0] && strstr($arr[1], $action)){
					return true;
				}							
			}			
		}		
		return false;    
    }
    
	private function get_tree($admin){
		$power_tree = Config("const.power_tree");
		$bar_tree = Config("const.bar_tree");

		$power_admin = (array)json_decode($admin['content']);
		foreach ($bar_tree as $out_k=>$value){
    		if(isset($power_admin[$out_k])){
				continue;
			}
			$bar_tree[$out_k]['privilege'] = false;

    		foreach ($value['sub'] as $in_k=>$v){
				$url = str_replace('/autophp/','',$v['url']);	
				if(!$url){
					$bar_tree[$out_k]['sub'][$in_k]['privilege'] = false;
					continue;
				}	
				if(strpos($url,'/')){
					$controller = substr($url,0,strpos($url,'/'));
					$action = substr($url,strpos($url,'/')+1);
				}else{
					$controller = $url;
					$action = 'index';
				}
    			if(false == $this->check_auth($admin, $url)){
					$bar_tree[$out_k]['sub'][$in_k]['privilege'] = false;	
				}				
    		}
		}

    	return $bar_tree;
    }
}
