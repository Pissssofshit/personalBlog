<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\GameUserModel;
use App\Library\Pager;
use App\Library\Utils;

class GameUserController extends Controller {
	private $_tpl;
	private $_m_game_user;
	public function __construct() {
		$this->_m_game_user = new GameUserModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/game_user/list");
		return view("autophp.game_user_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_game_user->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.game_user_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_game_user->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","game_id":"\u6e38\u620fid","user_id":"\u5e73\u53f0\u7528\u6237id","name":"\u6e38\u620f\u7528\u6237\u540d","ucode":"\u6e20\u9053\u6807\u793a","subucode":"\u5b50\u6e20\u9053\u6807\u793a","ip":"\u6ce8\u518cip","ua":"\u6ce8\u518cua","os":"\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios","device_id":"\u6ce8\u518c\u8bbe\u5907id","imei":"\u7279\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa","version":"\u7248\u672c","reg_time":"\u6ce8\u518c\u65f6\u95f4\u6233"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "用户游戏表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.game_user_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['game_id'] = $request->input('game_id');
			$input['user_id'] = $request->input('user_id');
			$input['name'] = $request->input('name');
			$input['ucode'] = $request->input('ucode');
			$input['subucode'] = $request->input('subucode');
			$input['ip'] = $request->input('ip');
			$input['ua'] = $request->input('ua');
			$input['os'] = $request->input('os');
			$input['device_id'] = $request->input('device_id');
			$input['imei'] = $request->input('imei');
			$input['version'] = $request->input('version');
			$input['reg_time'] = strtotime($request->input('reg_time'));
			$ret = $this->_m_game_user->insert($input);

			$tip_info = array("module"=>"game_user", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.game_user_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_game_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.game_user_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['game_id'] = $request->input('game_id');
			$set['user_id'] = $request->input('user_id');
			$set['name'] = $request->input('name');
			$set['ucode'] = $request->input('ucode');
			$set['subucode'] = $request->input('subucode');
			$set['ip'] = $request->input('ip');
			$set['ua'] = $request->input('ua');
			$set['os'] = $request->input('os');
			$set['device_id'] = $request->input('device_id');
			$set['imei'] = $request->input('imei');
			$set['version'] = $request->input('version');
			$set['reg_time'] = strtotime($request->input('reg_time'));
			$ret = $this->_m_game_user->update($id, $set);

			$tip_info = array("module"=>"game_user", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_game_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_user_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_game_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ? '': date('Y-m-d H:i', $detail['reg_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.game_user_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_game_user->delete($id);

		return $ret;

		$tip_info = array("module"=>"game_user", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.game_user_delete",$assign);

	}

	
}