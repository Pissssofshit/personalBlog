<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\SysChannelChanneltypeModel;
use App\Library\Pager;
use App\Library\Utils;

class SysChannelChanneltypeController extends Controller {
	private $_tpl;
	private $_m_sys_channel_channeltype;
	public function __construct() {
		$this->_m_sys_channel_channeltype = new SysChannelChanneltypeModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/sys_channel_channeltype/list");
		return view("autophp.sys_channel_channeltype_index");
	}

	public function index(Request $request) {
		$channel_id = $request->input('channel_id');
		$channel_type_id = $request->input('channel_type_id');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_sys_channel_channeltype->getList($channel_id, $channel_type_id, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?channel_id={$channel_id}&channel_type_id={$channel_type_id}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['channel_id'] = $channel_id;
		$details['channel_type_id'] = $channel_type_id;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.sys_channel_channeltype_list",$assign);
	}
	public function export(Request $request) {
		$channel_id = $request->input('channel_id');
		$channel_type_id = $request->input('channel_type_id');
		$data = $this->_m_sys_channel_channeltype->getList($channel_id, $channel_type_id);
		$list = $data['list'];
		$columnnames = '{"id":"\u6ca1\u7528\u7684\u4e3b\u952e","channel_id":"\u6e20\u9053id","channel_type_id":"\u7c7b\u578bid"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "渠道类型关联". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_channel_channeltype_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['channel_id'] = $request->input('channel_id');
			$input['channel_type_id'] = $request->input('channel_type_id');
			$ret = $this->_m_sys_channel_channeltype->insert($input);

			$tip_info = array("module"=>"sys_channel_channeltype", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.sys_channel_channeltype_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_sys_channel_channeltype->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.sys_channel_channeltype_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['channel_id'] = $request->input('channel_id');
			$set['channel_type_id'] = $request->input('channel_type_id');
			$ret = $this->_m_sys_channel_channeltype->update($id, $set);

			$tip_info = array("module"=>"sys_channel_channeltype", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_sys_channel_channeltype->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.sys_channel_channeltype_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_sys_channel_channeltype->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.sys_channel_channeltype_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_sys_channel_channeltype->delete($id);

		return $ret;

		$tip_info = array("module"=>"sys_channel_channeltype", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.sys_channel_channeltype_delete",$assign);

	}

	
}