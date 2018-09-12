<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\GameModel;
use App\Library\Pager;
use App\Library\Utils;

class GameController extends Controller {
	private $_tpl;
	private $_m_game;
	public function __construct() {
		$this->_m_game = new GameModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/game/list");
		return view("autophp.game_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_game->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.game_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_game->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","entity_id":"\u4e3b\u4f53id","name":"\u6e38\u620f\u540d\u79f0","name_en":"\u62fc\u97f3\u7b80\u5199","icon":"\u56fe\u6807","desc":"\u63cf\u8ff0","category":"\u7c7b\u578b","rank":"\u5206\u7ea7:ABC3\u7c7b","os":"\u7cfb\u7edf\u7c7b\u522b:\u9ed8\u8ba4\u4e3a1android","common_sign_key":"\u666e\u901a\u7b7e\u540dkey","confirm_sign_key":"\u786e\u8ba4\u63a5\u53e3\u7b7e\u540dkey","pay_sign_key":"\u51b2\u503c\u7b7e\u540dkey","pay_callback":"\u51b2\u503c\u56de\u8c03url","coin_unit":"\u6e38\u620f\u5e01\u540d\u79f0:\u5982\u94bb\u77f3","coin_rate":"\u5151\u6362\u7387:1\u5143\u4eba\u6c11\u5e01\u5151\u6362\u591a\u5c11\u6e38\u620f\u5e01","ucode":"\u539f\u59cbucode:\u5bf9\u5e94\u6e20\u9053\u6807\u8bb0\u4e3a0","version":"\u7248\u672c","package_url":"\u5305\u5730\u5740","create_time":"\u521b\u5efa\u65f6\u95f4\u6233","update_time":"\u66f4\u65b0\u65f6\u95f4\u6233","create_by":"\u521b\u5efa\u8005","update_by":"\u66f4\u65b0\u8005"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "游戏渠道包". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['entity_id'] = $request->input('entity_id');
			$input['name'] = $request->input('name');
			$input['name_en'] = $request->input('name_en');
			$input['icon'] = $request->input('icon');
			$input['desc'] = $request->input('desc');
			$input['category'] = $request->input('category');
			$input['rank'] = $request->input('rank');
			$input['os'] = $request->input('os');
			$input['common_sign_key'] = $request->input('common_sign_key');
			$input['confirm_sign_key'] = $request->input('confirm_sign_key');
			$input['pay_sign_key'] = $request->input('pay_sign_key');
			$input['pay_callback'] = $request->input('pay_callback');
			$input['coin_unit'] = $request->input('coin_unit');
			$input['coin_rate'] = $request->input('coin_rate');
			$input['ucode'] = $request->input('ucode');
			$input['version'] = $request->input('version');
			$input['package_url'] = $request->input('package_url');
			$input['create_time'] = strtotime($request->input('create_time'));
			$input['update_time'] = strtotime($request->input('update_time'));
			$input['create_by'] = $request->input('create_by');
			$input['update_by'] = $request->input('update_by');
			$ret = $this->_m_game->insert($input);

			$tip_info = array("module"=>"game", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.game_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_game->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.game_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['entity_id'] = $request->input('entity_id');
			$set['name'] = $request->input('name');
			$set['name_en'] = $request->input('name_en');
			$set['icon'] = $request->input('icon');
			$set['desc'] = $request->input('desc');
			$set['category'] = $request->input('category');
			$set['rank'] = $request->input('rank');
			$set['os'] = $request->input('os');
			$set['common_sign_key'] = $request->input('common_sign_key');
			$set['confirm_sign_key'] = $request->input('confirm_sign_key');
			$set['pay_sign_key'] = $request->input('pay_sign_key');
			$set['pay_callback'] = $request->input('pay_callback');
			$set['coin_unit'] = $request->input('coin_unit');
			$set['coin_rate'] = $request->input('coin_rate');
			$set['ucode'] = $request->input('ucode');
			$set['version'] = $request->input('version');
			$set['package_url'] = $request->input('package_url');
			$set['create_time'] = strtotime($request->input('create_time'));
			$set['update_time'] = strtotime($request->input('update_time'));
			$set['create_by'] = $request->input('create_by');
			$set['update_by'] = $request->input('update_by');
			$ret = $this->_m_game->update($id, $set);

			$tip_info = array("module"=>"game", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_game->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.game_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_game->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ? '': date('Y-m-d H:i', $detail['update_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.game_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_game->delete($id);

		return $ret;

		$tip_info = array("module"=>"game", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.game_delete",$assign);

	}

	
}