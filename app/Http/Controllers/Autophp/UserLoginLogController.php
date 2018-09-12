<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\UserLoginLogModel;
use App\Library\Pager;
use App\Library\Utils;

class UserLoginLogController extends Controller {
	private $_tpl;
	private $_m_user_login_log;
	public function __construct() {
		$this->_m_user_login_log = new UserLoginLogModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/user_login_log/list");
		return view("autophp.user_login_log_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_user_login_log->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.user_login_log_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_user_login_log->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"\u7528\u6237id","username":"\u7528\u6237\u540d","mobile":"\u624b\u673a\u53f7","email":"\u90ae\u7bb1","login_time":"\u767b\u9646\u65f6\u95f4\u6233","ucode":"\u6765\u6e90\u6e20\u9053\u6807\u793a","subucode":"\u5b50\u6e20\u9053\u6807\u793a","ip":"\u6ce8\u518cip","ua":"\u6ce8\u518cua","os":"\u64cd\u4f5c\u7cfb\u7edf:0pc;1android;2ios","device_id":"\u6ce8\u518c\u8bbe\u5907id","imei":"\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa","version":"\u7248\u672c"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "用户登陆". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_login_log_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['username'] = $request->input('username');
			$input['mobile'] = $request->input('mobile');
			$input['email'] = $request->input('email');
			$input['login_time'] = strtotime($request->input('login_time'));
			$input['ucode'] = $request->input('ucode');
			$input['subucode'] = $request->input('subucode');
			$input['ip'] = $request->input('ip');
			$input['ua'] = $request->input('ua');
			$input['os'] = $request->input('os');
			$input['device_id'] = $request->input('device_id');
			$input['imei'] = $request->input('imei');
			$input['version'] = $request->input('version');
			$ret = $this->_m_user_login_log->insert($input);

			$tip_info = array("module"=>"user_login_log", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.user_login_log_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_user_login_log->detail($id);
		$detail['login_time'] =  empty($detail['login_time']) ?'': date('Y-m-d H:i', $detail['login_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.user_login_log_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['username'] = $request->input('username');
			$set['mobile'] = $request->input('mobile');
			$set['email'] = $request->input('email');
			$set['login_time'] = strtotime($request->input('login_time'));
			$set['ucode'] = $request->input('ucode');
			$set['subucode'] = $request->input('subucode');
			$set['ip'] = $request->input('ip');
			$set['ua'] = $request->input('ua');
			$set['os'] = $request->input('os');
			$set['device_id'] = $request->input('device_id');
			$set['imei'] = $request->input('imei');
			$set['version'] = $request->input('version');
			$ret = $this->_m_user_login_log->update($id, $set);

			$tip_info = array("module"=>"user_login_log", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_user_login_log->detail($id);
		$detail['login_time'] =  empty($detail['login_time']) ?'': date('Y-m-d H:i', $detail['login_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_login_log_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_user_login_log->detail($id);
		$detail['login_time'] =  empty($detail['login_time']) ? '': date('Y-m-d H:i', $detail['login_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.user_login_log_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_user_login_log->delete($id);

		return $ret;

		$tip_info = array("module"=>"user_login_log", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.user_login_log_delete",$assign);

	}

	
}