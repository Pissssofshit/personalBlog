<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\CfgModeModel;
use App\Library\Pager;
use App\Library\Utils;

class CfgModeController extends Controller {
	private $_tpl;
	private $_m_cfg_mode;
	public function __construct() {
		$this->_m_cfg_mode = new CfgModeModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/cfg_mode/list");
		return view("autophp.cfg_mode_index");
	}

	public function index(Request $request) {
		$mode_name = $request->input('mode_name');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_cfg_mode->getList($mode_name, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?mode_name={$mode_name}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['mode_name'] = $mode_name;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.cfg_mode_list",$assign);
	}
	public function export(Request $request) {
		$mode_name = $request->input('mode_name');
		$data = $this->_m_cfg_mode->getList($mode_name);
		$list = $data['list'];
		$columnnames = '{"mode_id":"\u63a8\u5e7f\u65b9\u5f0fID","mode_name":"\u63a8\u5e7f\u65b9\u5f0f"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "推广方式定义". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_mode_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['mode_name'] = $request->input('mode_name');
			$ret = $this->_m_cfg_mode->insert($input);

			$tip_info = array("module"=>"cfg_mode", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.cfg_mode_add",$assign);
	}

	public function edit($mode_id) {
		$detail = $this->_m_cfg_mode->detail($mode_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.cfg_mode_edit",$assign);
	}

	public function update(Request $request) {
		$mode_id =  $request->input("mode_id");
		if (!empty($_POST)) {
			$set = array();
			$set['mode_name'] = $request->input('mode_name');
			$ret = $this->_m_cfg_mode->update($mode_id, $set);

			$tip_info = array("module"=>"cfg_mode", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_cfg_mode->detail($mode_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_mode_edit",$assign);
	}

	public function show($mode_id) {

		$detail = $this->_m_cfg_mode->detail($mode_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_mode_detail",$assign);
	}

	public function destroy($mode_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_cfg_mode->delete($mode_id);

		return $ret;

		$tip_info = array("module"=>"cfg_mode", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.cfg_mode_delete",$assign);

	}

	
}