<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\CfgCategoryModel;
use App\Library\Pager;
use App\Library\Utils;

class CfgCategoryController extends Controller {
	private $_tpl;
	private $_m_cfg_category;
	public function __construct() {
		$this->_m_cfg_category = new CfgCategoryModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/cfg_category/list");
		return view("autophp.cfg_category_index");
	}

	public function index(Request $request) {
		$category_name = $request->input('category_name');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_cfg_category->getList($category_name, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?category_name={$category_name}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['category_name'] = $category_name;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.cfg_category_list",$assign);
	}
	public function export(Request $request) {
		$category_name = $request->input('category_name');
		$data = $this->_m_cfg_category->getList($category_name);
		$list = $data['list'];
		$columnnames = '{"category_id":"\u7c7b\u578bID","category_name":"\u7c7b\u578b\u540d"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "类型定义". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_category_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['category_name'] = $request->input('category_name');
			$ret = $this->_m_cfg_category->insert($input);

			$tip_info = array("module"=>"cfg_category", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.cfg_category_add",$assign);
	}

	public function edit($category_id) {
		$detail = $this->_m_cfg_category->detail($category_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.cfg_category_edit",$assign);
	}

	public function update(Request $request) {
		$category_id =  $request->input("category_id");
		if (!empty($_POST)) {
			$set = array();
			$set['category_name'] = $request->input('category_name');
			$ret = $this->_m_cfg_category->update($category_id, $set);

			$tip_info = array("module"=>"cfg_category", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_cfg_category->detail($category_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_category_edit",$assign);
	}

	public function show($category_id) {

		$detail = $this->_m_cfg_category->detail($category_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.cfg_category_detail",$assign);
	}

	public function destroy($category_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_cfg_category->delete($category_id);

		return $ret;

		$tip_info = array("module"=>"cfg_category", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.cfg_category_delete",$assign);

	}

	
}