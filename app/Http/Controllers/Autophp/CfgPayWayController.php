<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\CfgPayWayModel;
use App\Library\Pager;
use App\Library\Utils;

class CfgPayWayController extends Controller {
	private $_tpl;
	private $_m_cfg_pay_way;
	public function __construct() {
		$this->_m_cfg_pay_way = new CfgPayWayModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/cfg_pay_way/list");
		return view("autophp.cfg_pay_way_index");
	}

	public function index(Request $request) {
		$name = $request->input('name');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_cfg_pay_way->getList($name, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?name={$name}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['name'] = $name;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.cfg_pay_way_list",$assign);
	}
	public function export(Request $request) {
		$name = $request->input('name');
		$data = $this->_m_cfg_pay_way->getList($name);
		$list = $data['list'];
		$columnnames = '{"id":"\u7ed3\u7b97\u65b9\u5f0fID","name":"\u7ed3\u7b97\u65b9\u5f0f"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "结算方式定义". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_pay_way_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['name'] = $request->input('name');
			$ret = $this->_m_cfg_pay_way->insert($input);

			$tip_info = array("module"=>"cfg_pay_way", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.cfg_pay_way_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_cfg_pay_way->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.cfg_pay_way_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['name'] = $request->input('name');
			$ret = $this->_m_cfg_pay_way->update($id, $set);

			$tip_info = array("module"=>"cfg_pay_way", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_cfg_pay_way->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_pay_way_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_cfg_pay_way->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_pay_way_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_cfg_pay_way->delete($id);

		return $ret;

		$tip_info = array("module"=>"cfg_pay_way", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.cfg_pay_way_delete",$assign);

	}

	
}