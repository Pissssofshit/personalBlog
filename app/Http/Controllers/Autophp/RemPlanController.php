<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemPlanModel;
use App\Library\Pager;
use App\Library\Utils;

class RemPlanController extends Controller {
	private $_tpl;
	private $_m_rem_plan;
	public function __construct() {
		$this->_m_rem_plan = new RemPlanModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_plan/list");
		return view("autophp.rem_plan_index");
	}

	public function index(Request $request) {
		$plan_name = $request->input('plan_name');
		$account_id = $request->input('account_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$category_id = $request->input('category_id');
		$mode_id = $request->input('mode_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_plan->getList($plan_name, $account_id, $game_id, $site_id, $category_id, $mode_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?plan_name={$plan_name}&account_id={$account_id}&game_id={$game_id}&site_id={$site_id}&category_id={$category_id}&mode_id={$mode_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['plan_name'] = $plan_name;
		$details['account_id'] = $account_id;
		$details['game_id'] = $game_id;
		$details['site_id'] = $site_id;
		$details['category_id'] = $category_id;
		$details['mode_id'] = $mode_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_plan_list",$assign);
	}
	public function export(Request $request) {
		$plan_name = $request->input('plan_name');
		$account_id = $request->input('account_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$category_id = $request->input('category_id');
		$mode_id = $request->input('mode_id');
		$data = $this->_m_rem_plan->getList($plan_name, $account_id, $game_id, $site_id, $category_id, $mode_id);
		$list = $data['list'];
		$columnnames = '{"plan_id":"\u8ba1\u5212ID","plan_name":"\u8ba1\u5212\u540d","account_id":"\u8d26\u53f7id","game_id":"\u6e38\u620fid","site_id":"\u7ad9\u70b9id","state":"\u72b6\u6001","is_1st":"\u662f\u5426\u542f\u7528\u8fc7","category_id":"\u7c7b\u578b","mode_id":"\u63a8\u5e7f\u65b9\u5f0f","created_time":"\u521b\u5efa\u65f6\u95f4","updated_time":"\u66f4\u65b0\u65f6\u95f4"}';
        
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
		return view("autophp.rem_plan_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['plan_name'] = $request->input('plan_name');
			$input['account_id'] = $request->input('account_id');
			$input['game_id'] = $request->input('game_id');
			$input['site_id'] = $request->input('site_id');
			$input['state'] = $request->input('state');
			$input['is_1st'] = $request->input('is_1st');
			$input['category_id'] = $request->input('category_id');
			$input['mode_id'] = $request->input('mode_id');
			$input['created_time'] = time();
			$ret = $this->_m_rem_plan->insert($input);

			$tip_info = array("module"=>"rem_plan", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_plan_add",$assign);
	}

	public function edit($plan_id) {
		$detail = $this->_m_rem_plan->detail($plan_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_plan_edit",$assign);
	}

	public function update(Request $request) {
		$plan_id =  $request->input("plan_id");
		if (!empty($_POST)) {
			$set = array();
			$set['plan_name'] = $request->input('plan_name');
			$set['account_id'] = $request->input('account_id');
			$set['game_id'] = $request->input('game_id');
			$set['site_id'] = $request->input('site_id');
			$set['state'] = $request->input('state');
			$set['is_1st'] = $request->input('is_1st');
			$set['category_id'] = $request->input('category_id');
			$set['mode_id'] = $request->input('mode_id');
			$set['updated_time'] = time();
			$ret = $this->_m_rem_plan->update($plan_id, $set);

			$tip_info = array("module"=>"rem_plan", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_plan->detail($plan_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_plan_edit",$assign);
	}

	public function show($plan_id) {

		$detail = $this->_m_rem_plan->detail($plan_id);
		$detail['created_time'] =  empty($detail['created_time']) ? '': date('Y-m-d H:i', $detail['created_time']);
			$detail['updated_time'] =  empty($detail['updated_time']) ? '': date('Y-m-d H:i', $detail['updated_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_plan_detail",$assign);
	}

	public function destroy($plan_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_plan->delete($plan_id);

		return $ret;

		$tip_info = array("module"=>"rem_plan", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_plan_delete",$assign);

	}

	
}