<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\PayLogModel;
use App\Library\Pager;
use App\Library\Utils;

class PayLogController extends Controller {
	private $_tpl;
	private $_m_pay_log;
	public function __construct() {
		$this->_m_pay_log = new PayLogModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/pay_log/list");
		return view("autophp.pay_log_index");
	}

	public function index(Request $request) {
		$order_id = $request->input('order_id');
		$uid = $request->input('uid');
		$partner_id = $request->input('partner_id');
		$game_id = $request->input('game_id');
		$server_id = $request->input('server_id');
		$site_id = $request->input('site_id');
		$reg_time['start'] = $request->input('reg_time_start');
		$reg_time['end'] = $request->input('reg_time_end');
		$pay_time['start'] = $request->input('pay_time_start');
		$pay_time['end'] = $request->input('pay_time_end');
		$pay_money = $request->input('pay_money');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_pay_log->getList($order_id, $uid, $partner_id, $game_id, $server_id, $site_id, $reg_time, $pay_time, $pay_money, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?order_id={$order_id}&uid={$uid}&partner_id={$partner_id}&game_id={$game_id}&server_id={$server_id}&site_id={$site_id}&reg_time_start={$reg_time['start']}&reg_time_end={$reg_time['end']}&pay_time_start={$pay_time['start']}&pay_time_end={$pay_time['end']}&pay_money={$pay_money}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['order_id'] = $order_id;
		$details['uid'] = $uid;
		$details['partner_id'] = $partner_id;
		$details['game_id'] = $game_id;
		$details['server_id'] = $server_id;
		$details['site_id'] = $site_id;
		$details['reg_time_start'] = $reg_time['start'];
		$details['reg_time_end'] = $reg_time['end'];
		$details['pay_time_start'] = $pay_time['start'];
		$details['pay_time_end'] = $pay_time['end'];
		$details['pay_money'] = $pay_money;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.pay_log_list",$assign);
	}
	public function export(Request $request) {
		$order_id = $request->input('order_id');
		$uid = $request->input('uid');
		$partner_id = $request->input('partner_id');
		$game_id = $request->input('game_id');
		$server_id = $request->input('server_id');
		$site_id = $request->input('site_id');
		$reg_time['start'] = $request->input('reg_time_start');
		$reg_time['end'] = $request->input('reg_time_end');
		$pay_time['start'] = $request->input('pay_time_start');
		$pay_time['end'] = $request->input('pay_time_end');
		$pay_money = $request->input('pay_money');
		$data = $this->_m_pay_log->getList($order_id, $uid, $partner_id, $game_id, $server_id, $site_id, $reg_time, $pay_time, $pay_money);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","order_id":"\u8ba2\u5355\u53f7","uid":"\u5e73\u53f0ID","partner_id":"\u5e73\u53f0ID","game_id":"\u6e38\u620fid","server_id":"\u670did","site_id":"\u7ad9\u70b9id","reg_time":"\u6ce8\u518c\u65f6\u95f4","pay_time":"\u5145\u503c\u65f6\u95f4","pay_money":"\u7c7b\u578b","is_1st_pay":"\u9996\u5145"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "充值订单表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.pay_log_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['order_id'] = $request->input('order_id');
			$input['uid'] = $request->input('uid');
			$input['partner_id'] = $request->input('partner_id');
			$input['game_id'] = $request->input('game_id');
			$input['server_id'] = $request->input('server_id');
			$input['site_id'] = $request->input('site_id');
			$input['reg_time'] = strtotime($request->input('reg_time'));
			$input['pay_time'] = strtotime($request->input('pay_time'));
			$input['pay_money'] = $request->input('pay_money');
			$input['is_1st_pay'] = $request->input('is_1st_pay');
			$ret = $this->_m_pay_log->insert($input);

			$tip_info = array("module"=>"pay_log", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.pay_log_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_pay_log->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
			$detail['pay_time'] =  empty($detail['pay_time']) ?'': date('Y-m-d H:i', $detail['pay_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.pay_log_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['order_id'] = $request->input('order_id');
			$set['uid'] = $request->input('uid');
			$set['partner_id'] = $request->input('partner_id');
			$set['game_id'] = $request->input('game_id');
			$set['server_id'] = $request->input('server_id');
			$set['site_id'] = $request->input('site_id');
			$set['reg_time'] = strtotime($request->input('reg_time'));
			$set['pay_time'] = strtotime($request->input('pay_time'));
			$set['pay_money'] = $request->input('pay_money');
			$set['is_1st_pay'] = $request->input('is_1st_pay');
			$ret = $this->_m_pay_log->update($id, $set);

			$tip_info = array("module"=>"pay_log", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_pay_log->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
			$detail['pay_time'] =  empty($detail['pay_time']) ?'': date('Y-m-d H:i', $detail['pay_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.pay_log_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_pay_log->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ? '': date('Y-m-d H:i', $detail['reg_time']);
			$detail['pay_time'] =  empty($detail['pay_time']) ? '': date('Y-m-d H:i', $detail['pay_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.pay_log_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_pay_log->delete($id);

		return $ret;

		$tip_info = array("module"=>"pay_log", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.pay_log_delete",$assign);

	}

	
}