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
		/*
		$tree = '{"842704b4844245724ed67fbaff53f5dd":{"sub":[{"url":"\/autophp\/h5_cp_game","name":"CP\u6e38\u620f","privilege":true},{"url":"\/autophp\/h5_gm_pt_relation","name":"\u5e73\u53f0\u6e38\u620f\u914d\u7f6e","privilege":true},{"url":"\/autophp\/h5_yun_platform","name":"\u5e73\u53f0","privilege":true}],"name":"\u5bf9\u63a5\u914d\u7f6e","privilege":true},"1fd02a90c38333badc226309fea6fecb":{"sub":[{"url":"\/autophp\/h5_yun_active","name":"\u7528\u6237\u6fc0\u6d3b","privilege":true},{"url":"\/autophp\/h5_yun_login_log","name":"\u7528\u6237\u767b\u9646","privilege":true},{"url":"\/autophp\/h5_yun_order","name":"\u5145\u503c\u8ba2\u5355","privilege":true},{"url":"\/autophp\/h5_yun_user","name":"\u6ce8\u518c\u7528\u6237","privilege":true}],"name":"\u7528\u6237","privilege":true},"23bbdd59d0b1d94621fc98e7f533ad9f":{"sub":[{"url":"\/autophp\/power_user","name":"\u7528\u6237\u7ba1\u7406","privilege":true},{"url":"\/autophp\/power_role","name":"\u89d2\u8272\u7ba1\u7406","privilege":true}],"name":"\u6743\u9650\u7ba1\u7406","privilege":true}}';
		$tree = json_decode($tree,true);
        View::share("bar_tree",$tree);
        $project['common']['cdn'] = "http://imagecache.joyport.com/ui";
        $requestpath = Request::path();
        $requestpath = trim($requestpath,"/");
        $requestpaths = explode("/",$requestpath);
        $requestpath = isset($requestpaths[0])&& isset($requestpaths[1])?$requestpaths[0]."/".$requestpaths[1]:"";
        View::share("project",$project);
		View::share('request_path',$requestpath);
		 */
	}
}
