<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemPlanAppendModel;
use App\Library\Pager;
use App\Library\Utils;

class RemPlanAppendController extends Controller {
	private $_tpl;
	private $_m_rem_plan_append;
	public function __construct() {
		$this->_m_rem_plan_append = new RemPlanAppendModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_plan_append/list");
		return view("autophp.rem_plan_append_index");
	}

	public function index(Request $request) {
		$ios_game_id = $request->input('ios_game_id');
		$version = $request->input('version');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_plan_append->getList($ios_game_id, $version, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?ios_game_id={$ios_game_id}&version={$version}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['ios_game_id'] = $ios_game_id;
		$details['version'] = $version;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_plan_append_list",$assign);
	}
	public function export(Request $request) {
		$ios_game_id = $request->input('ios_game_id');
		$version = $request->input('version');
		$data = $this->_m_rem_plan_append->getList($ios_game_id, $version);
		$list = $data['list'];
		$columnnames = '{"plan_id":"\u8ba1\u5212ID","ios_game_id":"ios\u6e38\u620fid","re_yun_url":"\u70ed\u4e91url","package_url":"\u6e20\u9053\u5305\u5730\u5740","version":"\u7248\u672c\u53f7","status":"\u6253\u5305\u72b6\u6001","count_down":"\u5012\u8ba1\u65f6"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "类型定义". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_plan_append_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['ios_game_id'] = $request->input('ios_game_id');
			$input['re_yun_url'] = $request->input('re_yun_url');
			$input['package_url'] = $request->input('package_url');
			$input['version'] = $request->input('version');
			$input['status'] = $request->input('status');
			$input['count_down'] = $request->input('count_down');
			$ret = $this->_m_rem_plan_append->insert($input);

			$tip_info = array("module"=>"rem_plan_append", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_plan_append_add",$assign);
	}

	public function edit($plan_id) {
		$detail = $this->_m_rem_plan_append->detail($plan_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_plan_append_edit",$assign);
	}

	public function update(Request $request) {
		$plan_id =  $request->input("plan_id");
		if (!empty($_POST)) {
			$set = array();
			$set['ios_game_id'] = $request->input('ios_game_id');
			$set['re_yun_url'] = $request->input('re_yun_url');
			$set['package_url'] = $request->input('package_url');
			$set['version'] = $request->input('version');
			$set['status'] = $request->input('status');
			$set['count_down'] = $request->input('count_down');
			$ret = $this->_m_rem_plan_append->update($plan_id, $set);

			$tip_info = array("module"=>"rem_plan_append", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_plan_append->detail($plan_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_plan_append_edit",$assign);
	}

	public function show($plan_id) {

		$detail = $this->_m_rem_plan_append->detail($plan_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_plan_append_detail",$assign);
	}

	public function destroy($plan_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_plan_append->delete($plan_id);

		return $ret;

		$tip_info = array("module"=>"rem_plan_append", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_plan_append_delete",$assign);

	}

	
}