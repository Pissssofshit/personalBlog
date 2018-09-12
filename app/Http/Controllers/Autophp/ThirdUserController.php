<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\ThirdUserModel;
use App\Library\Pager;
use App\Library\Utils;

class ThirdUserController extends Controller {
	private $_tpl;
	private $_m_third_user;
	public function __construct() {
		$this->_m_third_user = new ThirdUserModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/third_user/list");
		return view("autophp.third_user_index");
	}

	public function index(Request $request) {
		$user_id = $request->input('user_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_third_user->getList($user_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?user_id={$user_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['user_id'] = $user_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.third_user_list",$assign);
	}
	public function export(Request $request) {
		$user_id = $request->input('user_id');
		$data = $this->_m_third_user->getList($user_id);
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"UID:user\u8868\u7528\u6237id","app_type":"\u5f00\u653e\u5e73\u53f0\u6807\u793a:\u5982weixin","openid":"\u5f00\u653e\u5e73\u53f0\u7528\u6237\u6807\u793a","access_token":"\u5f00\u653e\u5e73\u53f0\u8bbf\u95ee\u4ee4\u724c","token_expire_time":"\u4ee4\u724c\u5b9e\u6548\u65f6\u95f4","refresh_token":"\u5237\u65b0\u4ee4\u724c","user_info":"\u5f00\u653e\u5e73\u53f0\u8fd4\u56de\u7684\u7528\u6237\u4fe1\u606f"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "第三方用户". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.third_user_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['app_type'] = $request->input('app_type');
			$input['openid'] = $request->input('openid');
			$input['access_token'] = $request->input('access_token');
			$input['token_expire_time'] = strtotime($request->input('token_expire_time'));
			$input['refresh_token'] = $request->input('refresh_token');
			$input['user_info'] = $request->input('user_info');
			$ret = $this->_m_third_user->insert($input);

			$tip_info = array("module"=>"third_user", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.third_user_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_third_user->detail($id);
		$detail['token_expire_time'] =  empty($detail['token_expire_time']) ?'': date('Y-m-d H:i', $detail['token_expire_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.third_user_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['app_type'] = $request->input('app_type');
			$set['openid'] = $request->input('openid');
			$set['access_token'] = $request->input('access_token');
			$set['token_expire_time'] = strtotime($request->input('token_expire_time'));
			$set['refresh_token'] = $request->input('refresh_token');
			$set['user_info'] = $request->input('user_info');
			$ret = $this->_m_third_user->update($id, $set);

			$tip_info = array("module"=>"third_user", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_third_user->detail($id);
		$detail['token_expire_time'] =  empty($detail['token_expire_time']) ?'': date('Y-m-d H:i', $detail['token_expire_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.third_user_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_third_user->detail($id);
		$detail['token_expire_time'] =  empty($detail['token_expire_time']) ? '': date('Y-m-d H:i', $detail['token_expire_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.third_user_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_third_user->delete($id);

		return $ret;

		$tip_info = array("module"=>"third_user", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.third_user_delete",$assign);

	}

	
}