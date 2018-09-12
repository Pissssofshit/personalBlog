<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemAccountModel;
use App\Library\Pager;
use App\Library\Utils;

class RemAccountController extends Controller {
	private $_tpl;
	private $_m_rem_account;
	public function __construct() {
		$this->_m_rem_account = new RemAccountModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_account/list");
		return view("autophp.rem_account_index");
	}

	public function index(Request $request) {
		$account_name = $request->input('account_name');
		$company_id = $request->input('company_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_account->getList($account_name, $company_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?account_name={$account_name}&company_id={$company_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['account_name'] = $account_name;
		$details['company_id'] = $company_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_account_list",$assign);
	}
	public function export(Request $request) {
		$account_name = $request->input('account_name');
		$company_id = $request->input('company_id');
		$data = $this->_m_rem_account->getList($account_name, $company_id);
		$list = $data['list'];
		$columnnames = '{"account_id":"\u8d26\u53f7ID","account_name":"\u8d26\u53f7\u540d\u79f0","account_url":"\u8d26\u53f7\u57df\u540d","company_id":"\u516c\u53f8id"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "账号列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_account_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['account_name'] = $request->input('account_name');
			$input['account_url'] = $request->input('account_url');
			$input['company_id'] = $request->input('company_id');
			$ret = $this->_m_rem_account->insert($input);

			$tip_info = array("module"=>"rem_account", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_account_add",$assign);
	}

	public function edit($account_id) {
		$detail = $this->_m_rem_account->detail($account_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_account_edit",$assign);
	}

	public function update(Request $request) {
		$account_id =  $request->input("account_id");
		if (!empty($_POST)) {
			$set = array();
			$set['account_name'] = $request->input('account_name');
			$set['account_url'] = $request->input('account_url');
			$set['company_id'] = $request->input('company_id');
			$ret = $this->_m_rem_account->update($account_id, $set);

			$tip_info = array("module"=>"rem_account", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_account->detail($account_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_account_edit",$assign);
	}

	public function show($account_id) {

		$detail = $this->_m_rem_account->detail($account_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_account_detail",$assign);
	}

	public function destroy($account_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_account->delete($account_id);

		return $ret;

		$tip_info = array("module"=>"rem_account", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_account_delete",$assign);

	}

	
}