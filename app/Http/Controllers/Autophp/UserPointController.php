<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\UserPointModel;
use App\Library\Pager;
use App\Library\Utils;

class UserPointController extends Controller {
	private $_tpl;
	private $_m_user_point;
	public function __construct() {
		$this->_m_user_point = new UserPointModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/user_point/list");
		return view("autophp.user_point_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_user_point->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.user_point_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_user_point->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"user\u8868\u7528\u6237id","point":"\u5e73\u53f0\u5e01","point_free":"\u8d60\u9001\u7684\u5e73\u53f0\u5e01\u6570\u91cf","update_time":"\u66f4\u65b0\u65f6\u95f4\u6233","last_pay_game_id":"\u6700\u8fd1\u5145\u503c\u6e38\u620f","last_pay_server_id":"\u6700\u8fd1\u5145\u503c\u6e38\u620f\u670d\u52a1\u5668","last_pay_channel_id":"\u6700\u8fd1\u4ed8\u8d39\u6e20\u9053id","last_pay_money":"\u6700\u8fd1\u5145\u503c\u91d1\u989d"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "平台币". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_point_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['point'] = $request->input('point');
			$input['point_free'] = $request->input('point_free');
			$input['update_time'] = strtotime($request->input('update_time'));
			$input['last_pay_game_id'] = $request->input('last_pay_game_id');
			$input['last_pay_server_id'] = $request->input('last_pay_server_id');
			$input['last_pay_channel_id'] = $request->input('last_pay_channel_id');
			$input['last_pay_money'] = $request->input('last_pay_money');
			$ret = $this->_m_user_point->insert($input);

			$tip_info = array("module"=>"user_point", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.user_point_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_user_point->detail($id);
		$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.user_point_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['point'] = $request->input('point');
			$set['point_free'] = $request->input('point_free');
			$set['update_time'] = strtotime($request->input('update_time'));
			$set['last_pay_game_id'] = $request->input('last_pay_game_id');
			$set['last_pay_server_id'] = $request->input('last_pay_server_id');
			$set['last_pay_channel_id'] = $request->input('last_pay_channel_id');
			$set['last_pay_money'] = $request->input('last_pay_money');
			$ret = $this->_m_user_point->update($id, $set);

			$tip_info = array("module"=>"user_point", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_user_point->detail($id);
		$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_point_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_user_point->detail($id);
		$detail['update_time'] =  empty($detail['update_time']) ? '': date('Y-m-d H:i', $detail['update_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.user_point_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_user_point->delete($id);

		return $ret;

		$tip_info = array("module"=>"user_point", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.user_point_delete",$assign);

	}

	
}