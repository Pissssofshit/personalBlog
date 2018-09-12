<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\UserVirtualPointModel;
use App\Library\Pager;
use App\Library\Utils;

class UserVirtualPointController extends Controller {
	private $_tpl;
	private $_m_user_virtual_point;
	public function __construct() {
		$this->_m_user_virtual_point = new UserVirtualPointModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/user_virtual_point/list");
		return view("autophp.user_virtual_point_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_user_virtual_point->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.user_virtual_point_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_user_virtual_point->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"\u7528\u6237id","game_id":"\u6e38\u620fid","type":"\u7c7b\u578b","point":"\u4f59\u989d"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "限定币". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_virtual_point_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['game_id'] = $request->input('game_id');
			$input['type'] = $request->input('type');
			$input['point'] = $request->input('point');
			$ret = $this->_m_user_virtual_point->insert($input);

			$tip_info = array("module"=>"user_virtual_point", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.user_virtual_point_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_user_virtual_point->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.user_virtual_point_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['game_id'] = $request->input('game_id');
			$set['type'] = $request->input('type');
			$set['point'] = $request->input('point');
			$ret = $this->_m_user_virtual_point->update($id, $set);

			$tip_info = array("module"=>"user_virtual_point", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_user_virtual_point->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_virtual_point_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_user_virtual_point->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.user_virtual_point_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_user_virtual_point->delete($id);

		return $ret;

		$tip_info = array("module"=>"user_virtual_point", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.user_virtual_point_delete",$assign);

	}

	
}