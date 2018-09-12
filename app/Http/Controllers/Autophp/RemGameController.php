<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemGameModel;
use App\Library\Pager;
use App\Library\Utils;

class RemGameController extends Controller {
	private $_tpl;
	private $_m_rem_game;
	public function __construct() {
		$this->_m_rem_game = new RemGameModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_game/list");
		return view("autophp.rem_game_index");
	}

	public function index(Request $request) {
		$partner_id = $request->input('partner_id');
		$game_name = $request->input('game_name');
		$state = $request->input('state');
		$category_id = $request->input('category_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_game->getList($partner_id, $game_name, $state, $category_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?partner_id={$partner_id}&game_name={$game_name}&state={$state}&category_id={$category_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['partner_id'] = $partner_id;
		$details['game_name'] = $game_name;
		$details['state'] = $state;
		$details['category_id'] = $category_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_game_list",$assign);
	}
	public function export(Request $request) {
		$partner_id = $request->input('partner_id');
		$game_name = $request->input('game_name');
		$state = $request->input('state');
		$category_id = $request->input('category_id');
		$data = $this->_m_rem_game->getList($partner_id, $game_name, $state, $category_id);
		$list = $data['list'];
		$columnnames = '{"game_id":"\u6e38\u620fID","partner_id":"\u5e73\u53f0ID","game_name":"\u6e38\u620f\u540d","state":"\u662f\u5426\u542f\u7528","category_id":"\u7c7b\u578b","game_url":"\u5b98\u7f51\u5730\u5740\/\u5305\u5730\u5740","new_server":"\u662f\u5426\u6700\u65b0\u670d"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "游戏列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_game_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['partner_id'] = $request->input('partner_id');
			$input['game_name'] = $request->input('game_name');
			$input['state'] = $request->input('state');
			$input['category_id'] = $request->input('category_id');
			$input['game_url'] = $request->input('game_url');
			$input['new_server'] = $request->input('new_server');
			$ret = $this->_m_rem_game->insert($input);

			$tip_info = array("module"=>"rem_game", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_game_add",$assign);
	}

	public function edit($game_id) {
		$detail = $this->_m_rem_game->detail($game_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_game_edit",$assign);
	}

	public function update(Request $request) {
		$game_id =  $request->input("game_id");
		if (!empty($_POST)) {
			$set = array();
			$set['partner_id'] = $request->input('partner_id');
			$set['game_name'] = $request->input('game_name');
			$set['state'] = $request->input('state');
			$set['category_id'] = $request->input('category_id');
			$set['game_url'] = $request->input('game_url');
			$set['new_server'] = $request->input('new_server');
			$ret = $this->_m_rem_game->update($game_id, $set);

			$tip_info = array("module"=>"rem_game", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_game->detail($game_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_game_edit",$assign);
	}

	public function show($game_id) {

		$detail = $this->_m_rem_game->detail($game_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_game_detail",$assign);
	}

	public function destroy($game_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_game->delete($game_id);

		return $ret;

		$tip_info = array("module"=>"rem_game", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_game_delete",$assign);

	}

	
}