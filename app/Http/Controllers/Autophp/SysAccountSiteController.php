<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\SysAccountSiteModel;
use App\Library\Pager;
use App\Library\Utils;

class SysAccountSiteController extends Controller {
	private $_tpl;
	private $_m_sys_account_site;
	public function __construct() {
		$this->_m_sys_account_site = new SysAccountSiteModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/sys_account_site/list");
		return view("autophp.sys_account_site_index");
	}

	public function index(Request $request) {
		$account_id = $request->input('account_id');
		$site_id = $request->input('site_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_sys_account_site->getList($account_id, $site_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?account_id={$account_id}&site_id={$site_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['account_id'] = $account_id;
		$details['site_id'] = $site_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.sys_account_site_list",$assign);
	}
	public function export(Request $request) {
		$account_id = $request->input('account_id');
		$site_id = $request->input('site_id');
		$data = $this->_m_sys_account_site->getList($account_id, $site_id);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","account_id":"\u8d26\u53f7id","site_id":"\u7ad9\u70b9id"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "账号站点关联". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_account_site_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['account_id'] = $request->input('account_id');
			$input['site_id'] = $request->input('site_id');
			$ret = $this->_m_sys_account_site->insert($input);

			$tip_info = array("module"=>"sys_account_site", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.sys_account_site_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_sys_account_site->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.sys_account_site_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['account_id'] = $request->input('account_id');
			$set['site_id'] = $request->input('site_id');
			$ret = $this->_m_sys_account_site->update($id, $set);

			$tip_info = array("module"=>"sys_account_site", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_sys_account_site->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_account_site_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_sys_account_site->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.sys_account_site_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_sys_account_site->delete($id);

		return $ret;

		$tip_info = array("module"=>"sys_account_site", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.sys_account_site_delete",$assign);

	}

	
}