<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\UserModel;
use App\Library\Pager;
use App\Library\Utils;

class UserController extends Controller {
	private $_tpl;
	private $_m_user;
	public function __construct() {
		$this->_m_user = new UserModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/user/list");
		return view("autophp.user_index");
	}

	public function index(Request $request) {
		$username = $request->input('username');
		$mobile = $request->input('mobile');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_user->getList($username, $mobile, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?username={$username}&mobile={$mobile}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['username'] = $username;
		$details['mobile'] = $mobile;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.user_list",$assign);
	}
	public function export(Request $request) {
		$username = $request->input('username');
		$mobile = $request->input('mobile');
		$data = $this->_m_user->getList($username, $mobile);
		$list = $data['list'];
		$columnnames = '{"id":"UID","username":"\u7528\u6237\u540d","mobile":"\u624b\u673a\u53f7","email":"\u90ae\u7bb1","password":"\u52a0\u5bc6\u5bc6\u7801","reg_time":"\u6ce8\u518c\u65f6\u95f4\u6233","mobile_bind_time":"\u624b\u673a\u7ed1\u5b9a\u65f6\u95f4\u6233","email_bind_time":"\u90ae\u7bb1\u7ed1\u5b9a\u65f6\u95f4\u6233","source":"\u6765\u6e901:1\u81ea\u7136\u91cf2\u516c\u4f1a","ucode":"\u6765\u6e902:\u6e20\u9053\u6807\u8bc6","subucode":"\u6765\u6e903:\u5b50\u6e20\u9053\u6269\u5c55\u6807\u793a","ip":"\u6ce8\u518cip","ua":"\u6ce8\u518cua","os":"\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios","device_id":"\u6ce8\u518c\u8bbe\u5907id","imei":"\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa","nickname":"\u6635\u79f0","sex":"\u6027\u522b:1\u75372\u5973","head_icon":"\u5934\u50cf","idcard":"","realname":"","salt":"\u76d0\u503c"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "用户". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.user_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['username'] = $request->input('username');
			$input['mobile'] = $request->input('mobile');
			$input['email'] = $request->input('email');
			$input['password'] = $request->input('password');
			$input['reg_time'] = strtotime($request->input('reg_time'));
			$input['mobile_bind_time'] = strtotime($request->input('mobile_bind_time'));
			$input['email_bind_time'] = strtotime($request->input('email_bind_time'));
			$input['source'] = $request->input('source');
			$input['ucode'] = $request->input('ucode');
			$input['subucode'] = $request->input('subucode');
			$input['ip'] = $request->input('ip');
			$input['ua'] = $request->input('ua');
			$input['os'] = $request->input('os');
			$input['device_id'] = $request->input('device_id');
			$input['imei'] = $request->input('imei');
			$input['nickname'] = $request->input('nickname');
			$input['sex'] = $request->input('sex');
			$input['head_icon'] = $request->input('head_icon');
			$input['idcard'] = $request->input('idcard');
			$input['realname'] = $request->input('realname');
			$input['salt'] = $request->input('salt');
			$ret = $this->_m_user->insert($input);

			$tip_info = array("module"=>"user", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.user_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
			$detail['mobile_bind_time'] =  empty($detail['mobile_bind_time']) ?'': date('Y-m-d H:i', $detail['mobile_bind_time']);
			$detail['email_bind_time'] =  empty($detail['email_bind_time']) ?'': date('Y-m-d H:i', $detail['email_bind_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.user_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['username'] = $request->input('username');
			$set['mobile'] = $request->input('mobile');
			$set['email'] = $request->input('email');
			$set['password'] = $request->input('password');
			$set['reg_time'] = strtotime($request->input('reg_time'));
			$set['mobile_bind_time'] = strtotime($request->input('mobile_bind_time'));
			$set['email_bind_time'] = strtotime($request->input('email_bind_time'));
			$set['source'] = $request->input('source');
			$set['ucode'] = $request->input('ucode');
			$set['subucode'] = $request->input('subucode');
			$set['ip'] = $request->input('ip');
			$set['ua'] = $request->input('ua');
			$set['os'] = $request->input('os');
			$set['device_id'] = $request->input('device_id');
			$set['imei'] = $request->input('imei');
			$set['nickname'] = $request->input('nickname');
			$set['sex'] = $request->input('sex');
			$set['head_icon'] = $request->input('head_icon');
			$set['idcard'] = $request->input('idcard');
			$set['realname'] = $request->input('realname');
			$set['salt'] = $request->input('salt');
			$ret = $this->_m_user->update($id, $set);

			$tip_info = array("module"=>"user", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ?'': date('Y-m-d H:i', $detail['reg_time']);
			$detail['mobile_bind_time'] =  empty($detail['mobile_bind_time']) ?'': date('Y-m-d H:i', $detail['mobile_bind_time']);
			$detail['email_bind_time'] =  empty($detail['email_bind_time']) ?'': date('Y-m-d H:i', $detail['email_bind_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_user->detail($id);
		$detail['reg_time'] =  empty($detail['reg_time']) ? '': date('Y-m-d H:i', $detail['reg_time']);
			$detail['mobile_bind_time'] =  empty($detail['mobile_bind_time']) ? '': date('Y-m-d H:i', $detail['mobile_bind_time']);
			$detail['email_bind_time'] =  empty($detail['email_bind_time']) ? '': date('Y-m-d H:i', $detail['email_bind_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.user_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_user->delete($id);

		return $ret;

		$tip_info = array("module"=>"user", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.user_delete",$assign);

	}

	
}