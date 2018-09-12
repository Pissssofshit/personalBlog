<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\PowerRoleModel;
use App\Library\Pager;
use App\Library\Utils;

class PowerRoleController extends Controller {
	private $_tpl;
	private $_m_power_role;
	public function __construct() {
		$this->_m_power_role = new PowerRoleModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/power_role/list");
		return view("autophp.power_role_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_power_role->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.power_role_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_power_role->getList();
		$list = $data['list'];
		$columnnames = '{"power_role_id":"ID\u7f16\u53f7","power_role_name":"\u89d2\u8272\u540d\u79f0","content":"\u89d2\u8272\u6743\u9650\u5185\u5bb9","created_time":"\u521b\u5efa\u65f6\u95f4"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "角色管理". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.power_role_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['power_role_name'] = $request->input('power_role_name');
			$input['content'] = json_encode($request->input('content'));
			$input['created_time'] = time();
			$ret = $this->_m_power_role->insert($input);

			$tip_info = array("module"=>"power_role", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 			global $CONFIG_ADMIN;
			$power_list = $CONFIG_ADMIN['power_tree'];
			unset($power_list['no_valide']);
			$assign['power_list'] = $power_list;
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.power_role_add",$assign);
	}

	public function edit($power_role_id) {
		$detail = $this->_m_power_role->detail($power_role_id);
		$detail['content'] = json_decode($detail['content'], true);
		$assign["detail"] = $detail;
		

				global $CONFIG_ADMIN;
		$power_list = $CONFIG_ADMIN['power_tree'];
		unset($power_list['no_valide']);
		$assign["csrf_token"] = csrf_token();
		$assign["power_list"] = $power_list;
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.power_role_edit",$assign);
	}

	public function update(Request $request) {
		$power_role_id =  $request->input("power_role_id");
		if (!empty($_POST)) {
			$set = array();
			$set['power_role_name'] = $request->input('power_role_name');
			$set['content'] = json_encode($request->input('content'));
			$ret = $this->_m_power_role->update($power_role_id, $set);

			$tip_info = array("module"=>"power_role", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_power_role->detail($power_role_id);
		$detail['content'] = json_decode($detail['content'], true);
		$assign["detail"] = $detail;
		

				global $CONFIG_ADMIN;
		$power_list = $CONFIG_ADMIN['power_tree'];
		unset($power_list['no_valide']);
		$assign["csrf_token"] =csrf_token();
		$assign["power_list"] =$power_list;
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.power_role_edit",$assign);
	}

	public function show($power_role_id) {

		$detail = $this->_m_power_role->detail($power_role_id);
		$detail['content'] = json_decode($detail['content'], true);
			$detail['created_time'] =  empty($detail['created_time']) ? '': date('Y-m-d H:i', $detail['created_time']); 
		
        $assign["detail"] = $detail;
					global $CONFIG_ADMIN;
			$power_list = $CONFIG_ADMIN['power_tree'];
			unset($power_list['no_valide']);
			$assign["power_list"] = $power_list;
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.power_role_detail",$assign);
	}

	public function destroy($power_role_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_power_role->delete($power_role_id);

		return $ret;

		$tip_info = array("module"=>"power_role", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.power_role_delete",$assign);

	}

	
}