<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\SysPlanMaterialModel;
use App\Library\Pager;
use App\Library\Utils;

class SysPlanMaterialController extends Controller {
	private $_tpl;
	private $_m_sys_plan_material;
	public function __construct() {
		$this->_m_sys_plan_material = new SysPlanMaterialModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/sys_plan_material/list");
		return view("autophp.sys_plan_material_index");
	}

	public function index(Request $request) {
		$plan_id = $request->input('plan_id');
		$material_id = $request->input('material_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_sys_plan_material->getList($plan_id, $material_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?plan_id={$plan_id}&material_id={$material_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['plan_id'] = $plan_id;
		$details['material_id'] = $material_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.sys_plan_material_list",$assign);
	}
	public function export(Request $request) {
		$plan_id = $request->input('plan_id');
		$material_id = $request->input('material_id');
		$data = $this->_m_sys_plan_material->getList($plan_id, $material_id);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","plan_id":"\u8ba1\u5212id","material_id":"\u7d20\u6750id","weight":"\u6743\u91cd"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "计划素材关联". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_plan_material_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['plan_id'] = $request->input('plan_id');
			$input['material_id'] = $request->input('material_id');
			$input['weight'] = $request->input('weight');
			$ret = $this->_m_sys_plan_material->insert($input);

			$tip_info = array("module"=>"sys_plan_material", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.sys_plan_material_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_sys_plan_material->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.sys_plan_material_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['plan_id'] = $request->input('plan_id');
			$set['material_id'] = $request->input('material_id');
			$set['weight'] = $request->input('weight');
			$ret = $this->_m_sys_plan_material->update($id, $set);

			$tip_info = array("module"=>"sys_plan_material", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_sys_plan_material->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_plan_material_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_sys_plan_material->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.sys_plan_material_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_sys_plan_material->delete($id);

		return $ret;

		$tip_info = array("module"=>"sys_plan_material", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.sys_plan_material_delete",$assign);

	}

	
}