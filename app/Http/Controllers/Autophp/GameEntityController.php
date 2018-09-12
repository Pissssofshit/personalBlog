<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\GameEntityModel;
use App\Library\Pager;
use App\Library\Utils;

class GameEntityController extends Controller {
	private $_tpl;
	private $_m_game_entity;
	public function __construct() {
		$this->_m_game_entity = new GameEntityModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/game_entity/list");
		return view("autophp.game_entity_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_game_entity->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.game_entity_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_game_entity->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","name":"\u6e38\u620f\u4e3b\u4f53\u540d\u79f0","enable":"\u72b6\u6001:1\u542f\u75282\u7981\u7528","create_time":"\u521b\u5efa\u65f6\u95f4\u6233","update_time":"\u66f4\u65b0\u65f6\u95f4\u6233","create_by":"\u521b\u5efa\u8005","update_by":"\u66f4\u65b0\u8005","discount":"\u4ee3\u5145\u6298\u6263","back_pay":"\u5145\u503c\u8fd4\u70b9","status":"\u4e0a\u67b6\u72b6\u6001"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "游戏". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_entity_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['name'] = $request->input('name');
			$input['enable'] = $request->input('enable');
			$input['create_time'] = strtotime($request->input('create_time'));
			$input['update_time'] = strtotime($request->input('update_time'));
			$input['create_by'] = $request->input('create_by');
			$input['update_by'] = $request->input('update_by');
			$input['discount'] = $request->input('discount');
			$input['back_pay'] = $request->input('back_pay');
			$input['status'] = $request->input('status');
			$ret = $this->_m_game_entity->insert($input);

			$tip_info = array("module"=>"game_entity", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.game_entity_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_game_entity->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.game_entity_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['name'] = $request->input('name');
			$set['enable'] = $request->input('enable');
			$set['create_time'] = strtotime($request->input('create_time'));
			$set['update_time'] = strtotime($request->input('update_time'));
			$set['create_by'] = $request->input('create_by');
			$set['update_by'] = $request->input('update_by');
			$set['discount'] = $request->input('discount');
			$set['back_pay'] = $request->input('back_pay');
			$set['status'] = $request->input('status');
			$ret = $this->_m_game_entity->update($id, $set);

			$tip_info = array("module"=>"game_entity", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_game_entity->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_entity_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_game_entity->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ? '': date('Y-m-d H:i', $detail['update_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.game_entity_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_game_entity->delete($id);

		return $ret;

		$tip_info = array("module"=>"game_entity", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.game_entity_delete",$assign);

	}

	
}