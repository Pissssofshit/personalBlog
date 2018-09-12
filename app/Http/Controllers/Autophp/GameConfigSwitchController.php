<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\GameConfigSwitchModel;
use App\Library\Pager;
use App\Library\Utils;

class GameConfigSwitchController extends Controller {
	private $_tpl;
	private $_m_game_config_switch;
	public function __construct() {
		$this->_m_game_config_switch = new GameConfigSwitchModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/game_config_switch/list");
		return view("autophp.game_config_switch_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_game_config_switch->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.game_config_switch_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_game_config_switch->getList();
		$list = $data['list'];
		$columnnames = '{"game_id":"\u6e38\u620fid","ad_stat_switch":"\u5e7f\u544a\u7edf\u8ba1app\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed","ad_stat_key":"\u5e7f\u544a\u7edf\u8ba1\u53c2\u6570","weixin_switch":"\u5fae\u4fe1\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed","weixin_app_id":"app id","weixin_app_key":"app key","weixin_app_secret":"app secret","show_platform_switch":"\u5e73\u53f0\u95ea\u5c4f\u5f00\u5173:\u6e38\u620f\u542f\u52a8\u52a8\u753b\u662f\u5426\u64ad\u653e\u5e73\u53f0logo","bind_mobile_when_pay_switch":"\u5145\u503c\u90a6\u5b9a\u624b\u673a\u63d0\u793a","one_key_registe_switch":"\u4e00\u952e\u6ce8\u518c\u5f00\u5173","create_time":"\u521b\u5efa\u65f6\u95f4\u6233","update_time":"\u66f4\u65b0\u65f6\u95f4\u6233","create_by":"\u521b\u5efa\u8005","update_by":"\u66f4\u65b0\u8005"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "游戏开关". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.game_config_switch_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['game_id'] = $request->input('game_id');
			$input['ad_stat_switch'] = $request->input('ad_stat_switch');
			$input['ad_stat_key'] = $request->input('ad_stat_key');
			$input['weixin_switch'] = $request->input('weixin_switch');
			$input['weixin_app_id'] = $request->input('weixin_app_id');
			$input['weixin_app_key'] = $request->input('weixin_app_key');
			$input['weixin_app_secret'] = $request->input('weixin_app_secret');
			$input['show_platform_switch'] = $request->input('show_platform_switch');
			$input['bind_mobile_when_pay_switch'] = $request->input('bind_mobile_when_pay_switch');
			$input['one_key_registe_switch'] = $request->input('one_key_registe_switch');
			$input['create_time'] = strtotime($request->input('create_time'));
			$input['update_time'] = strtotime($request->input('update_time'));
			$input['create_by'] = $request->input('create_by');
			$input['update_by'] = $request->input('update_by');
			$ret = $this->_m_game_config_switch->insert($input);

			$tip_info = array("module"=>"game_config_switch", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.game_config_switch_add",$assign);
	}

	public function edit($game_id) {
		$detail = $this->_m_game_config_switch->detail($game_id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.game_config_switch_edit",$assign);
	}

	public function update(Request $request) {
		$game_id =  $request->input("game_id");
		if (!empty($_POST)) {
			$set = array();
			$set['game_id'] = $request->input('game_id');
			$set['ad_stat_switch'] = $request->input('ad_stat_switch');
			$set['ad_stat_key'] = $request->input('ad_stat_key');
			$set['weixin_switch'] = $request->input('weixin_switch');
			$set['weixin_app_id'] = $request->input('weixin_app_id');
			$set['weixin_app_key'] = $request->input('weixin_app_key');
			$set['weixin_app_secret'] = $request->input('weixin_app_secret');
			$set['show_platform_switch'] = $request->input('show_platform_switch');
			$set['bind_mobile_when_pay_switch'] = $request->input('bind_mobile_when_pay_switch');
			$set['one_key_registe_switch'] = $request->input('one_key_registe_switch');
			$set['create_time'] = strtotime($request->input('create_time'));
			$set['update_time'] = strtotime($request->input('update_time'));
			$set['create_by'] = $request->input('create_by');
			$set['update_by'] = $request->input('update_by');
			$ret = $this->_m_game_config_switch->update($game_id, $set);

			$tip_info = array("module"=>"game_config_switch", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_game_config_switch->detail($game_id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_config_switch_edit",$assign);
	}

	public function show($game_id) {

		$detail = $this->_m_game_config_switch->detail($game_id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ? '': date('Y-m-d H:i', $detail['update_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.game_config_switch_detail",$assign);
	}

	public function destroy($game_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_game_config_switch->delete($game_id);

		return $ret;

		$tip_info = array("module"=>"game_config_switch", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.game_config_switch_delete",$assign);

	}

	
}