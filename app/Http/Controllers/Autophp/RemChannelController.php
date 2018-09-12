<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemChannelModel;
use App\Library\Pager;
use App\Library\Utils;

class RemChannelController extends Controller {
	private $_tpl;
	private $_m_rem_channel;
	public function __construct() {
		$this->_m_rem_channel = new RemChannelModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_channel/list");
		return view("autophp.rem_channel_index");
	}

	public function index(Request $request) {
		$channel_name = $request->input('channel_name');
		$category_id = $request->input('category_id');
		$state = $request->input('state');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_channel->getList($channel_name, $category_id, $state, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?channel_name={$channel_name}&category_id={$category_id}&state={$state}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['channel_name'] = $channel_name;
		$details['category_id'] = $category_id;
		$details['state'] = $state;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_channel_list",$assign);
	}
	public function export(Request $request) {
		$channel_name = $request->input('channel_name');
		$category_id = $request->input('category_id');
		$state = $request->input('state');
		$data = $this->_m_rem_channel->getList($channel_name, $category_id, $state);
		$list = $data['list'];
		$columnnames = '{"channel_id":"\u6e20\u9053ID","channel_name":"\u6e20\u9053\u540d","category_id":"\u7c7b\u578b","state":"\u662f\u5426\u542f\u7528","callback_url":"\u56de\u8c03\u5730\u5740"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "渠道列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['channel_name'] = $request->input('channel_name');
			$input['category_id'] = $request->input('category_id');
			$input['state'] = $request->input('state');
			$input['callback_url'] = $request->input('callback_url');
			$ret = $this->_m_rem_channel->insert($input);

			$tip_info = array("module"=>"rem_channel", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_channel_add",$assign);
	}

	public function edit($channel_id) {
		$detail = $this->_m_rem_channel->detail($channel_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_channel_edit",$assign);
	}

	public function update(Request $request) {
		$channel_id =  $request->input("channel_id");
		if (!empty($_POST)) {
			$set = array();
			$set['channel_name'] = $request->input('channel_name');
			$set['category_id'] = $request->input('category_id');
			$set['state'] = $request->input('state');
			$set['callback_url'] = $request->input('callback_url');
			$ret = $this->_m_rem_channel->update($channel_id, $set);

			$tip_info = array("module"=>"rem_channel", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_channel->detail($channel_id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_edit",$assign);
	}

	public function show($channel_id) {

		$detail = $this->_m_rem_channel->detail($channel_id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_detail",$assign);
	}

	public function destroy($channel_id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_channel->delete($channel_id);

		return $ret;

		$tip_info = array("module"=>"rem_channel", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_channel_delete",$assign);

	}

	
}