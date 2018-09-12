<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\CfgSubsistSignModel;
use App\Library\Pager;
use App\Library\Utils;

class CfgSubsistSignController extends Controller {
	private $_tpl;
	private $_m_cfg_subsist_sign;
	public function __construct() {
		$this->_m_cfg_subsist_sign = new CfgSubsistSignModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/cfg_subsist_sign/list");
		return view("autophp.cfg_subsist_sign_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_cfg_subsist_sign->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.cfg_subsist_sign_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_cfg_subsist_sign->getList();
		$list = $data['list'];
		$columnnames = '{"subsist_day":"\u7b2cn\u65e5\u7559\u5b58","subsist_num":"\u5bf9\u5e94\u6807\u8bb0"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "留存标记". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_subsist_sign_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['subsist_num'] = $request->input('subsist_num');
			$ret = $this->_m_cfg_subsist_sign->insert($input);

			$tip_info = array("module"=>"cfg_subsist_sign", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.cfg_subsist_sign_add",$assign);
	}

	public function edit($subsist_day) {
		$detail = $this->_m_cfg_subsist_sign->detail($subsist_day);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.cfg_subsist_sign_edit",$assign);
	}

	public function update(Request $request) {
		$subsist_day =  $request->input("subsist_day");
		if (!empty($_POST)) {
			$set = array();
			$set['subsist_num'] = $request->input('subsist_num');
			$ret = $this->_m_cfg_subsist_sign->update($subsist_day, $set);

			$tip_info = array("module"=>"cfg_subsist_sign", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_cfg_subsist_sign->detail($subsist_day);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_subsist_sign_edit",$assign);
	}

	public function show($subsist_day) {

		$detail = $this->_m_cfg_subsist_sign->detail($subsist_day);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_subsist_sign_detail",$assign);
	}

	public function destroy($subsist_day) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_cfg_subsist_sign->delete($subsist_day);

		return $ret;

		$tip_info = array("module"=>"cfg_subsist_sign", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.cfg_subsist_sign_delete",$assign);

	}

	
}