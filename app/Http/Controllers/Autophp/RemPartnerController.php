<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemPartnerModel;
use App\Library\Pager;
use App\Library\Utils;

class RemPartnerController extends Controller {
	private $_tpl;
	private $_m_rem_partner;
	public function __construct() {
		$this->_m_rem_partner = new RemPartnerModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_partner/list");
		return view("autophp.rem_partner_index");
	}

	public function index(Request $request) {
		$partner_name = $request->input('partner_name');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_partner->getList($partner_name, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?partner_name={$partner_name}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['partner_name'] = $partner_name;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_partner_list",$assign);
	}
	public function export(Request $request) {
		$partner_name = $request->input('partner_name');
		$data = $this->_m_rem_partner->getList($partner_name);
		$list = $data['list'];
		$columnnames = '{"partner_id":"\u5e73\u53f0id","partner_name":"\u5e73\u53f0\u540d","check_url":"\u8d26\u53f7\u6ce8\u518c\u68c0\u67e5\u94fe\u63a5","reg_url":"\u8d26\u53f7\u6ce8\u518c\u94fe\u63a5","login_url":"\u8d26\u53f7\u767b\u5f55\u94fe\u63a5","search_url":"\u8d26\u53f7\u67e5\u8be2\u94fe\u63a5","server_url":"\u83b7\u53d6\u670d\u52a1\u5668\u5217\u8868\u94fe\u63a5","cdn_url":"\u7d20\u6750\u94fe\u63a5"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "平台列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_partner_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['partner_name'] = $request->input('partner_name');
			$input['check_url'] = $request->input('check_url');
			$input['reg_url'] = $request->input('reg_url');
			$input['login_url'] = $request->input('login_url');
			$input['search_url'] = $request->input('search_url');
			$input['server_url'] = $request->input('server_url');
			$input['cdn_url'] = $request->input('cdn_url');
			$ret = $this->_m_rem_partner->insert($input);

			$tip_info = array("module"=>"rem_partner", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_partner_add",$assign);
	}

	public function edit($partner_id) {
		$detail = $this->_m_rem_partner->detail($partner_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_partner_edit",$assign);
	}

	public function update(Request $request) {
		$partner_id =  $request->input("partner_id");
		if (!empty($_POST)) {
			$set = array();
			$set['partner_name'] = $request->input('partner_name');
			$set['check_url'] = $request->input('check_url');
			$set['reg_url'] = $request->input('reg_url');
			$set['login_url'] = $request->input('login_url');
			$set['search_url'] = $request->input('search_url');
			$set['server_url'] = $request->input('server_url');
			$set['cdn_url'] = $request->input('cdn_url');
			$ret = $this->_m_rem_partner->update($partner_id, $set);

			$tip_info = array("module"=>"rem_partner", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_partner->detail($partner_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_partner_edit",$assign);
	}

	public function show($partner_id) {

		$detail = $this->_m_rem_partner->detail($partner_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_partner_detail",$assign);
	}

	public function destroy($partner_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_partner->delete($partner_id);

		return $ret;

		$tip_info = array("module"=>"rem_partner", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_partner_delete",$assign);

	}

	
}