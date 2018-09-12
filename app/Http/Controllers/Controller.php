<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
		$tree = '{"7d94de1cdba7512a76fd42d71f537bfd":{"sub":[{"url":"\/autophp\/user","name":"\u7528\u6237","privilege":true},{"url":"\/autophp\/third_user","name":"\u7b2c\u4e09\u65b9\u7528\u6237","privilege":true},{"url":"\/autophp\/game_user","name":"\u7528\u6237\u6e38\u620f\u8868","privilege":true},{"url":"\/autophp\/user_login_log","name":"\u7528\u6237\u767b\u9646","privilege":true}],"name":"\u7528\u6237\u7ba1\u7406","privilege":true},"3e4ef4dd3c1c1a790ffc601fa9c40876":{"sub":[{"url":"\/autophp\/game_entity","name":"\u6e38\u620f","privilege":true},{"url":"\/autophp\/game","name":"\u6e38\u620f\u6e20\u9053\u5305","privilege":true},{"url":"\/autophp\/game_config_switch","name":"\u6e38\u620f\u5f00\u5173","privilege":true}],"name":"\u6e38\u620f\u7ba1\u7406","privilege":true},"a335eed50b930fd1f6a03a50edf33672":{"sub":[{"url":"\/autophp\/order","name":"\u8ba2\u5355","privilege":true},{"url":"\/autophp\/user_point","name":"\u5e73\u53f0\u5e01","privilege":true},{"url":"\/autophp\/user_point_log","name":"\u5e73\u53f0\u5e01\u65e5\u5fd7","privilege":true},{"url":"\/autophp\/order_log","name":"\u8ba2\u5355\u53d8\u66f4\u65e5\u5fd7","privilege":true},{"url":"\/autophp\/user_virtual_point","name":"\u9650\u5b9a\u5e01","privilege":true},{"url":"\/autophp\/user_virtual_point_log","name":"\u9650\u5b9a\u5e01\u53d8\u66f4\u65e5\u5fd7","privilege":true}],"name":"\u5145\u503c\u7ba1\u7406","privilege":true},"23bbdd59d0b1d94621fc98e7f533ad9f":{"sub":[{"url":"\/autophp\/power_user","name":"\u7528\u6237\u7ba1\u7406","privilege":true},{"url":"\/autophp\/power_role","name":"\u89d2\u8272\u7ba1\u7406","privilege":true}],"name":"\u6743\u9650\u7ba1\u7406","privilege":true}}';
		$tree = json_decode($tree,true);
        View::share("bar_tree",$tree);
        $project['common']['cdn'] = "http://imagecache.joyport.com/ui";
        $requestpath = Request::path();
        $requestpath = trim($requestpath,"/");
        $requestpaths = explode("/",$requestpath);
        $requestpath = isset($requestpaths[0])&& isset($requestpaths[1])?$requestpaths[0]."/".$requestpaths[1]:"";
        View::share("project",$project);
        View::share('request_path',$requestpath);
	}
}
