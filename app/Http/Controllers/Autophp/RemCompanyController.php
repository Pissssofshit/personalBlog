<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemCompanyModel;
use App\Library\Pager;
use App\Library\Utils;

class RemCompanyController extends Controller {
	private $_tpl;
	private $_m_rem_company;
	public function __construct() {
		$this->_m_rem_company = new RemCompanyModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_company/list");
		return view("autophp.rem_company_index");
	}

	public function index(Request $request) {
		$type_alias = $request->input('type_alias');
		$channel_id = $request->input('channel_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_company->getList($type_alias, $channel_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?type_alias={$type_alias}&channel_id={$channel_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['type_alias'] = $type_alias;
		$details['channel_id'] = $channel_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_company_list",$assign);
	}
	public function export(Request $request) {
		$type_alias = $request->input('type_alias');
		$channel_id = $request->input('channel_id');
		$data = $this->_m_rem_company->getList($type_alias, $channel_id);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","type_alias":"\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d","channel_id":"\u6e20\u9053ID"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "公司列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_company_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['type_alias'] = $request->input('type_alias');
			$input['channel_id'] = $request->input('channel_id');
			$ret = $this->_m_rem_company->insert($input);

			$tip_info = array("module"=>"rem_company", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_company_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_rem_company->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_company_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['type_alias'] = $request->input('type_alias');
			$set['channel_id'] = $request->input('channel_id');
			$ret = $this->_m_rem_company->update($id, $set);

			$tip_info = array("module"=>"rem_company", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_company->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_company_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_rem_company->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_company_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_company->delete($id);

		return $ret;

		$tip_info = array("module"=>"rem_company", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_company_delete",$assign);

	}

	
}