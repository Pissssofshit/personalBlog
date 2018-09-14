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
		$tree = '{"5cadb523cb6909f92350f70f124adfb8":{"sub":[{"url":"\/autophp\/rem_account","name":"\u8d26\u53f7\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_game","name":"\u6e38\u620f\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_site","name":"\u7ad9\u70b9\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_plan","name":"\u7c7b\u578b\u5b9a\u4e49","privilege":true},{"url":"\/autophp\/rem_channel","name":"\u6e20\u9053\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_channel_type","name":"\u6e20\u9053\u7c7b\u578b\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_partner","name":"\u5e73\u53f0\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_company","name":"\u516c\u53f8\u5217\u8868","privilege":true},{"url":"\/autophp\/rem_plan_append","name":"\u7c7b\u578b\u5b9a\u4e49","privilege":true},{"url":"\/autophp\/rem_company","name":"\u516c\u53f8\u5217\u8868","privilege":true}],"name":"rem","privilege":true},"011134986548f3458aa3e7e2a7fceb8d":{"sub":[{"url":"\/autophp\/cfg_category","name":"\u7c7b\u578b\u5b9a\u4e49","privilege":true},{"url":"\/autophp\/cfg_mode","name":"\u63a8\u5e7f\u65b9\u5f0f\u5b9a\u4e49","privilege":true},{"url":"\/autophp\/cfg_pay_way","name":"\u7ed3\u7b97\u65b9\u5f0f\u5b9a\u4e49","privilege":true},{"url":"\/autophp\/cfg_subsist_sign","name":"\u7559\u5b58\u6807\u8bb0","privilege":true}],"name":"cfg","privilege":true},"36bcbb801f5052739af8220c6ea51434":{"sub":[{"url":"\/autophp\/sys_plan_material","name":"\u8ba1\u5212\u7d20\u6750\u5173\u8054","privilege":true},{"url":"\/autophp\/sys_account_site","name":"\u8d26\u53f7\u7ad9\u70b9\u5173\u8054","privilege":true},{"url":"\/autophp\/sys_channel_channeltype","name":"\u6e20\u9053\u7c7b\u578b\u5173\u8054","privilege":true}],"name":"sys","privilege":true},"8d777f385d3dfec8815d20f7496026dc":{"sub":[{"url":"\/autophp\/user","name":"\u7528\u6237\u8868","privilege":true},{"url":"\/autophp\/channel_callback","name":"\u9875\u6e38\u6e20\u9053\u56de\u8c03","privilege":true},{"url":"\/autophp\/pay_log","name":"\u5145\u503c\u8ba2\u5355\u8868","privilege":true},{"url":"\/autophp\/feedback","name":"\u624b\u6e38\u6e20\u9053\u56de\u8c03","privilege":true},{"url":"\/autophp\/day_plan_cost","name":"\u6210\u672c\u63d0\u4ea4\u8868","privilege":true}],"name":"data","privilege":true},"23bbdd59d0b1d94621fc98e7f533ad9f":{"sub":[{"url":"\/autophp\/power_user","name":"\u7528\u6237\u7ba1\u7406","privilege":true},{"url":"\/autophp\/power_role","name":"\u89d2\u8272\u7ba1\u7406","privilege":true}],"name":"\u6743\u9650\u7ba1\u7406","privilege":true}}';
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
