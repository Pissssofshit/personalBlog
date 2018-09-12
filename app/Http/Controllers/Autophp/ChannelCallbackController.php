<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\ChannelCallbackModel;
use App\Library\Pager;
use App\Library\Utils;

class ChannelCallbackController extends Controller {
	private $_tpl;
	private $_m_channel_callback;
	public function __construct() {
		$this->_m_channel_callback = new ChannelCallbackModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/channel_callback/list");
		return view("autophp.channel_callback_index");
	}

	public function index(Request $request) {
		$uid = $request->input('uid');
		$passport = $request->input('passport');
		$partner_id = $request->input('partner_id');
		$game_id = $request->input('game_id');
		$server_id = $request->input('server_id');
		$site_id = $request->input('site_id');
		$insert_time['start'] = $request->input('insert_time_start');
		$insert_time['end'] = $request->input('insert_time_end');
		$notice_time['start'] = $request->input('notice_time_start');
		$notice_time['end'] = $request->input('notice_time_end');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_channel_callback->getList($uid, $passport, $partner_id, $game_id, $server_id, $site_id, $insert_time, $notice_time, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?uid={$uid}&passport={$passport}&partner_id={$partner_id}&game_id={$game_id}&server_id={$server_id}&site_id={$site_id}&insert_time_start={$insert_time['start']}&insert_time_end={$insert_time['end']}&notice_time_start={$notice_time['start']}&notice_time_end={$notice_time['end']}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['uid'] = $uid;
		$details['passport'] = $passport;
		$details['partner_id'] = $partner_id;
		$details['game_id'] = $game_id;
		$details['server_id'] = $server_id;
		$details['site_id'] = $site_id;
		$details['insert_time_start'] = $insert_time['start'];
		$details['insert_time_end'] = $insert_time['end'];
		$details['notice_time_start'] = $notice_time['start'];
		$details['notice_time_end'] = $notice_time['end'];
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.channel_callback_list",$assign);
	}
	public function export(Request $request) {
		$uid = $request->input('uid');
		$passport = $request->input('passport');
		$partner_id = $request->input('partner_id');
		$game_id = $request->input('game_id');
		$server_id = $request->input('server_id');
		$site_id = $request->input('site_id');
		$insert_time['start'] = $request->input('insert_time_start');
		$insert_time['end'] = $request->input('insert_time_end');
		$notice_time['start'] = $request->input('notice_time_start');
		$notice_time['end'] = $request->input('notice_time_end');
		$data = $this->_m_channel_callback->getList($uid, $passport, $partner_id, $game_id, $server_id, $site_id, $insert_time, $notice_time);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","uid":"\u5e73\u53f0ID","passport":"\u5e73\u53f0\u8d26\u53f7\u540d","partner_id":"\u5e73\u53f0ID","game_id":"\u6e38\u620fid","server_id":"\u670did","site_id":"\u7ad9\u70b9id","res":"\u56de\u8c03\u53c2\u6570\u503c","info":"\u56de\u8c03\u8fd4\u56de\u503c","insert_time":"\u63d2\u5165\u65f6\u95f4","notice_time":"\u56de\u8c03\u65f6\u95f4"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "页游渠道回调". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.channel_callback_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['uid'] = $request->input('uid');
			$input['passport'] = $request->input('passport');
			$input['partner_id'] = $request->input('partner_id');
			$input['game_id'] = $request->input('game_id');
			$input['server_id'] = $request->input('server_id');
			$input['site_id'] = $request->input('site_id');
			$input['res'] = $request->input('res');
			$input['info'] = $request->input('info');
			$input['insert_time'] = strtotime($request->input('insert_time'));
			$input['notice_time'] = strtotime($request->input('notice_time'));
			$ret = $this->_m_channel_callback->insert($input);

			$tip_info = array("module"=>"channel_callback", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.channel_callback_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_channel_callback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ?'': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ?'': date('Y-m-d H:i', $detail['notice_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.channel_callback_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['uid'] = $request->input('uid');
			$set['passport'] = $request->input('passport');
			$set['partner_id'] = $request->input('partner_id');
			$set['game_id'] = $request->input('game_id');
			$set['server_id'] = $request->input('server_id');
			$set['site_id'] = $request->input('site_id');
			$set['res'] = $request->input('res');
			$set['info'] = $request->input('info');
			$set['insert_time'] = strtotime($request->input('insert_time'));
			$set['notice_time'] = strtotime($request->input('notice_time'));
			$ret = $this->_m_channel_callback->update($id, $set);

			$tip_info = array("module"=>"channel_callback", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_channel_callback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ?'': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ?'': date('Y-m-d H:i', $detail['notice_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.channel_callback_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_channel_callback->detail($id);
		$detail['insert_time'] =  empty($detail['insert_time']) ? '': date('Y-m-d H:i', $detail['insert_time']);
			$detail['notice_time'] =  empty($detail['notice_time']) ? '': date('Y-m-d H:i', $detail['notice_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.channel_callback_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_channel_callback->delete($id);

		return $ret;

		$tip_info = array("module"=>"channel_callback", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.channel_callback_delete",$assign);

	}

	
}