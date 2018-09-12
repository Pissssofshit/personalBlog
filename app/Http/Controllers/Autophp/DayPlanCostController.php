<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\DayPlanCostModel;
use App\Library\Pager;
use App\Library\Utils;

class DayPlanCostController extends Controller {
	private $_tpl;
	private $_m_day_plan_cost;
	public function __construct() {
		$this->_m_day_plan_cost = new DayPlanCostModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/day_plan_cost/list");
		return view("autophp.day_plan_cost_index");
	}

	public function index(Request $request) {
		$plan_id = $request->input('plan_id');
		$account_id = $request->input('account_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_day_plan_cost->getList($plan_id, $account_id, $game_id, $site_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?plan_id={$plan_id}&account_id={$account_id}&game_id={$game_id}&site_id={$site_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['plan_id'] = $plan_id;
		$details['account_id'] = $account_id;
		$details['game_id'] = $game_id;
		$details['site_id'] = $site_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.day_plan_cost_list",$assign);
	}
	public function export(Request $request) {
		$plan_id = $request->input('plan_id');
		$account_id = $request->input('account_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$data = $this->_m_day_plan_cost->getList($plan_id, $account_id, $game_id, $site_id);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","day_time":"\u6210\u672c\u6240\u5c5e\u65f6\u95f4\u6233","day_date":"\u6210\u672c\u6240\u5c5e\u65e5\u671f","plan_id":"\u8ba1\u5212id","account_id":"\u8d26\u53f7id","game_id":"\u6e38\u620fid","site_id":"\u7ad9\u70b9id","cost":"\u6e38\u620f\u5e01\u6210\u672c","rmb_cost":"\u4eba\u6c11\u5e01\u6210\u672c","rate":"\u5e01\u5355\u4ef7","create_by":"\u63d0\u4ea4\u8005","pass_by":"\u901a\u8fc7\u8005","is_passed":"\u662f\u5426\u5df2\u7ecf\u901a\u8fc7","created_time":"\u521b\u5efa\u65f6\u95f4","pass_time":"\u901a\u8fc7\u65f6\u95f4"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "成本提交表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.day_plan_cost_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['day_time'] = strtotime($request->input('day_time'));
			$input['day_date'] = $request->input('day_date');
			$input['plan_id'] = $request->input('plan_id');
			$input['account_id'] = $request->input('account_id');
			$input['game_id'] = $request->input('game_id');
			$input['site_id'] = $request->input('site_id');
			$input['cost'] = $request->input('cost');
			$input['rmb_cost'] = $request->input('rmb_cost');
			$input['rate'] = $request->input('rate');
			$input['create_by'] = $request->input('create_by');
			$input['pass_by'] = $request->input('pass_by');
			$input['is_passed'] = $request->input('is_passed');
			$input['created_time'] = time();
			$input['pass_time'] = strtotime($request->input('pass_time'));
			$ret = $this->_m_day_plan_cost->insert($input);

			$tip_info = array("module"=>"day_plan_cost", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.day_plan_cost_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_day_plan_cost->detail($id);
		$detail['day_time'] =  empty($detail['day_time']) ?'': date('Y-m-d H:i', $detail['day_time']);
			$detail['pass_time'] =  empty($detail['pass_time']) ?'': date('Y-m-d H:i', $detail['pass_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.day_plan_cost_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['day_time'] = strtotime($request->input('day_time'));
			$set['day_date'] = $request->input('day_date');
			$set['plan_id'] = $request->input('plan_id');
			$set['account_id'] = $request->input('account_id');
			$set['game_id'] = $request->input('game_id');
			$set['site_id'] = $request->input('site_id');
			$set['cost'] = $request->input('cost');
			$set['rmb_cost'] = $request->input('rmb_cost');
			$set['rate'] = $request->input('rate');
			$set['create_by'] = $request->input('create_by');
			$set['pass_by'] = $request->input('pass_by');
			$set['is_passed'] = $request->input('is_passed');
			$set['pass_time'] = strtotime($request->input('pass_time'));
			$ret = $this->_m_day_plan_cost->update($id, $set);

			$tip_info = array("module"=>"day_plan_cost", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_day_plan_cost->detail($id);
		$detail['day_time'] =  empty($detail['day_time']) ?'': date('Y-m-d H:i', $detail['day_time']);
			$detail['pass_time'] =  empty($detail['pass_time']) ?'': date('Y-m-d H:i', $detail['pass_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.day_plan_cost_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_day_plan_cost->detail($id);
		$detail['day_time'] =  empty($detail['day_time']) ? '': date('Y-m-d H:i', $detail['day_time']);
			$detail['created_time'] =  empty($detail['created_time']) ? '': date('Y-m-d H:i', $detail['created_time']);
			$detail['pass_time'] =  empty($detail['pass_time']) ? '': date('Y-m-d H:i', $detail['pass_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.day_plan_cost_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_day_plan_cost->delete($id);

		return $ret;

		$tip_info = array("module"=>"day_plan_cost", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.day_plan_cost_delete",$assign);

	}

	
}