<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\FeedbackModel;
use App\Library\Pager;
use App\Library\Utils;

class FeedbackController extends Controller {
	private $_tpl;
	private $_m_feedback;
	public function __construct() {
		$this->_m_feedback = new FeedbackModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/feedback/list");
		return view("autophp.feedback_index");
	}

	public function index(Request $request) {
		$type_alias = $request->input('type_alias');
		$partner_id = $request->input('partner_id');
		$plan_id = $request->input('plan_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$category_id = $request->input('category_id');
		$insert_time['start'] = $request->input('insert_time_start');
		$insert_time['end'] = $request->input('insert_time_end');
		$notice_time['start'] = $request->input('notice_time_start');
		$notice_time['end'] = $request->input('notice_time_end');
		$match_time['start'] = $request->input('match_time_start');
		$match_time['end'] = $request->input('match_time_end');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_feedback->getList($type_alias, $partner_id, $plan_id, $game_id, $site_id, $category_id, $insert_time, $notice_time, $match_time, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?type_alias={$type_alias}&partner_id={$partner_id}&plan_id={$plan_id}&game_id={$game_id}&site_id={$site_id}&category_id={$category_id}&insert_time_start={$insert_time['start']}&insert_time_end={$insert_time['end']}&notice_time_start={$notice_time['start']}&notice_time_end={$notice_time['end']}&match_time_start={$match_time['start']}&match_time_end={$match_time['end']}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['type_alias'] = $type_alias;
		$details['partner_id'] = $partner_id;
		$details['plan_id'] = $plan_id;
		$details['game_id'] = $game_id;
		$details['site_id'] = $site_id;
		$details['category_id'] = $category_id;
		$details['insert_time_start'] = $insert_time['start'];
		$details['insert_time_end'] = $insert_time['end'];
		$details['notice_time_start'] = $notice_time['start'];
		$details['notice_time_end'] = $notice_time['end'];
		$details['match_time_start'] = $match_time['start'];
		$details['match_time_end'] = $match_time['end'];
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.feedback_list",$assign);
	}
	public function export(Request $request) {
		$type_alias = $request->input('type_alias');
		$partner_id = $request->input('partner_id');
		$plan_id = $request->input('plan_id');
		$game_id = $request->input('game_id');
		$site_id = $request->input('site_id');
		$category_id = $request->input('category_id');
		$insert_time['start'] = $request->input('insert_time_start');
		$insert_time['end'] = $request->input('insert_time_end');
		$notice_time['start'] = $request->input('notice_time_start');
		$notice_time['end'] = $request->input('notice_time_end');
		$match_time['start'] = $request->input('match_time_start');
		$match_time['end'] = $request->input('match_time_end');
		$data = $this->_m_feedback->getList($type_alias, $partner_id, $plan_id, $game_id, $site_id, $category_id, $insert_time, $notice_time, $match_time);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","type_alias":"\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d","partner_id":"\u5e73\u53f0ID","plan_id":"\u8ba1\u5212id","game_id":"\u6e38\u620fid","site_id":"\u7ad9\u70b9id","click_id":"\u8bbe\u5907\u53f7","category_id":"\u8bbe\u5907\u7c7b\u578b","ip":"ip","callback_url":"\u56de\u8c03\u94fe\u63a5","insert_time":"\u63d2\u5165\u65f6\u95f4","notice_time":"\u56de\u8c03\u65f6\u95f4","match_time":"\u5339\u914d\u65f6\u95f4"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "手游渠道回调". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.feedback_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['type_alias'] = $request->input('type_alias');
			$input['partner_id'] = $request->input('partner_id');
			$input['plan_id'] = $request->input('plan_id');
			$input['game_id'] = $request->input('game_id');
			$input['site_id'] = $request->input('site_id');
			$input['click_id'] = $request->input('click_id');
			$input['category_id'] = $request->input('category_id');
			$input['ip'] = $request->input('ip');
			$input['callback_url'] = $request->input('callback_url');
			$input['insert_time'] = strtotime($request->input('insert_time'));
			$input['notice_time'] = strtotime($request->input('notice_time'));
			$input['match_time'] = strtotime($request->input('match_time'));
			$ret = $this->_m_feedback->insert($input);

			$tip_info = array("module"=>"feedback", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.feedback_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_feedback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ?'': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ?'': date('Y-m-d H:i', $detail['notice_time']);
			$detail['match_time'] =  empty($detail['match_time']) ?'': date('Y-m-d H:i', $detail['match_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.feedback_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['type_alias'] = $request->input('type_alias');
			$set['partner_id'] = $request->input('partner_id');
			$set['plan_id'] = $request->input('plan_id');
			$set['game_id'] = $request->input('game_id');
			$set['site_id'] = $request->input('site_id');
			$set['click_id'] = $request->input('click_id');
			$set['category_id'] = $request->input('category_id');
			$set['ip'] = $request->input('ip');
			$set['callback_url'] = $request->input('callback_url');
			$set['insert_time'] = strtotime($request->input('insert_time'));
			$set['notice_time'] = strtotime($request->input('notice_time'));
			$set['match_time'] = strtotime($request->input('match_time'));
			$ret = $this->_m_feedback->update($id, $set);

			$tip_info = array("module"=>"feedback", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_feedback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ?'': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ?'': date('Y-m-d H:i', $detail['notice_time']);
			$detail['match_time'] =  empty($detail['match_time']) ?'': date('Y-m-d H:i', $detail['match_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.feedback_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_feedback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ? '': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ? '': date('Y-m-d H:i', $detail['notice_time']);
			$detail['match_time'] =  empty($detail['match_time']) ? '': date('Y-m-d H:i', $detail['match_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.feedback_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_feedback->delete($id);

		return $ret;

		$tip_info = array("module"=>"feedback", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.feedback_delete",$assign);

	}

	
}