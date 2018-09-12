<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\PowerUserModel;
use App\Library\Pager;
use App\Library\Utils;

class PowerUserController extends Controller {
	private $_tpl;
	private $_m_power_user;
	public function __construct() {
		$this->_m_power_user = new PowerUserModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/power_user/list");
		return view("autophp.power_user_index");
	}

	public function index(Request $request) {
		$power_user_name = $request->input('power_user_name');
		$power_role_id = $request->input('power_role_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_power_user->getList($power_user_name, $power_role_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?power_user_name={$power_user_name}&power_role_id={$power_role_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        		$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		$dict_list[0] = "请选择";
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;

        $details['power_user_name'] = $power_user_name;
		$details['power_role_id'] = $power_role_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.power_user_list",$assign);
	}
	public function export(Request $request) {
		$power_user_name = $request->input('power_user_name');
		$power_role_id = $request->input('power_role_id');
		$data = $this->_m_power_user->getList($power_user_name, $power_role_id);
		$list = $data['list'];
		$columnnames = '{"power_user_id":"ID\u7f16\u53f7","power_user_name":"\u7528\u6237\u5e10\u53f7","truename":"\u771f\u5b9e\u59d3\u540d","password":"\u5bc6\u7801","power_role_id":"\u89d2\u8272\u7c7b\u578b","created_time":"\u521b\u5efa\u65f6\u95f4"}';
        		$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		$dict_list[0] = "请选择";
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;

        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "用户管理". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
				$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;
 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.power_user_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['power_user_name'] = $request->input('power_user_name');
			$input['truename'] = $request->input('truename');
			$input['password'] = $request->input('password');
			$input['power_role_id'] = $request->input('power_role_id');
			$input['created_time'] = time();
			$ret = $this->_m_power_user->insert($input);

			$tip_info = array("module"=>"power_user", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

				$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;
 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.power_user_add",$assign);
	}

	public function edit($power_user_id) {
		$detail = $this->_m_power_user->detail($power_user_id);
		
		$assign["detail"] = $detail;
		
		$power_role_id = $detail['power_role_id'];
		$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;


		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.power_user_edit",$assign);
	}

	public function update(Request $request) {
		$power_user_id =  $request->input("power_user_id");
		if (!empty($_POST)) {
			$set = array();
			$set['power_user_name'] = $request->input('power_user_name');
			$set['truename'] = $request->input('truename');
			$set['password'] = $request->input('password');
			$set['power_role_id'] = $request->input('power_role_id');
			$ret = $this->_m_power_user->update($power_user_id, $set);

			$tip_info = array("module"=>"power_user", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_power_user->detail($power_user_id);
		
		$assign["detail"] = $detail;
		
		$power_role_id = $detail['power_role_id'];
		$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;


		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.power_user_edit",$assign);
	}

	public function show($power_user_id) {

		$detail = $this->_m_power_user->detail($power_user_id);
		$detail['created_time'] =  empty($detail['created_time']) ? '': date('Y-m-d H:i', $detail['created_time']); 
		
		$power_role_id = $detail['power_role_id'];
		$m_power_role = new \App\Http\Models\Autophp\PowerRoleModel();
		$dict_list = $m_power_role->dict();
		$dict_list[0] = "请选择";
		ksort($dict_list);
		@$dict_power_role = array($power_role_id, $dict_list);
		$assign["dict_power_role"]=$dict_power_role;

        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.power_user_detail",$assign);
	}

	public function destroy($power_user_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_power_user->delete($power_user_id);

		return $ret;

		$tip_info = array("module"=>"power_user", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.power_user_delete",$assign);

	}

	
}