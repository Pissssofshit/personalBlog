<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemSiteModel;
use App\Library\Pager;
use App\Library\Utils;

class RemSiteController extends Controller {
	private $_tpl;
	private $_m_rem_site;
	public function __construct() {
		$this->_m_rem_site = new RemSiteModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_site/list");
		return view("autophp.rem_site_index");
	}

	public function index(Request $request) {
		$channel_id = $request->input('channel_id');
		$site_name = $request->input('site_name');
		$state = $request->input('state');
		$category_id = $request->input('category_id');
		$pay_way_id = $request->input('pay_way_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_site->getList($channel_id, $site_name, $state, $category_id, $pay_way_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?channel_id={$channel_id}&site_name={$site_name}&state={$state}&category_id={$category_id}&pay_way_id={$pay_way_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['channel_id'] = $channel_id;
		$details['site_name'] = $site_name;
		$details['state'] = $state;
		$details['category_id'] = $category_id;
		$details['pay_way_id'] = $pay_way_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_site_list",$assign);
	}
	public function export(Request $request) {
		$channel_id = $request->input('channel_id');
		$site_name = $request->input('site_name');
		$state = $request->input('state');
		$category_id = $request->input('category_id');
		$pay_way_id = $request->input('pay_way_id');
		$data = $this->_m_rem_site->getList($channel_id, $site_name, $state, $category_id, $pay_way_id);
		$list = $data['list'];
		$columnnames = '{"site_id":"\u7ad9\u70b9ID","channel_id":"\u6e20\u9053ID","site_name":"\u7ad9\u70b9\u540d","state":"\u662f\u5426\u542f\u7528","category_id":"\u7c7b\u578b","pay_way_id":"\u7ed3\u7b97\u65b9\u5f0f","describe":"\u5177\u4f53\u63cf\u8ff0"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "站点列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_site_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['channel_id'] = $request->input('channel_id');
			$input['site_name'] = $request->input('site_name');
			$input['state'] = $request->input('state');
			$input['category_id'] = $request->input('category_id');
			$input['pay_way_id'] = $request->input('pay_way_id');
			$input['describe'] = $request->input('describe');
			$ret = $this->_m_rem_site->insert($input);

			$tip_info = array("module"=>"rem_site", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_site_add",$assign);
	}

	public function edit($site_id) {
		$detail = $this->_m_rem_site->detail($site_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_site_edit",$assign);
	}

	public function update(Request $request) {
		$site_id =  $request->input("site_id");
		if (!empty($_POST)) {
			$set = array();
			$set['channel_id'] = $request->input('channel_id');
			$set['site_name'] = $request->input('site_name');
			$set['state'] = $request->input('state');
			$set['category_id'] = $request->input('category_id');
			$set['pay_way_id'] = $request->input('pay_way_id');
			$set['describe'] = $request->input('describe');
			$ret = $this->_m_rem_site->update($site_id, $set);

			$tip_info = array("module"=>"rem_site", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_site->detail($site_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_site_edit",$assign);
	}

	public function show($site_id) {

		$detail = $this->_m_rem_site->detail($site_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_site_detail",$assign);
	}

	public function destroy($site_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_site->delete($site_id);

		return $ret;

		$tip_info = array("module"=>"rem_site", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_site_delete",$assign);

	}

	
}