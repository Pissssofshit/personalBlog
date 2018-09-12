<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\RemChannelTypeModel;
use App\Library\Pager;
use App\Library\Utils;

class RemChannelTypeController extends Controller {
	private $_tpl;
	private $_m_rem_channel_type;
	public function __construct() {
		$this->_m_rem_channel_type = new RemChannelTypeModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/rem_channel_type/list");
		return view("autophp.rem_channel_type_index");
	}

	public function index(Request $request) {
		$name = $request->input('name');
		$state = $request->input('state');
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_rem_channel_type->getList($name, $state, $page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?name={$name}&state={$state}";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        $details['name'] = $name;
		$details['state'] = $state;
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.rem_channel_type_list",$assign);
	}
	public function export(Request $request) {
		$name = $request->input('name');
		$state = $request->input('state');
		$data = $this->_m_rem_channel_type->getList($name, $state);
		$list = $data['list'];
		$columnnames = '{"id":"id","name":"\u7c7b\u578b\u540d","state":"\u662f\u5426\u542f\u7528","describe":"\u5177\u4f53\u63cf\u8ff0"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "渠道类型列表". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_type_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['name'] = $request->input('name');
			$input['state'] = $request->input('state');
			$input['describe'] = $request->input('describe');
			$ret = $this->_m_rem_channel_type->insert($input);

			$tip_info = array("module"=>"rem_channel_type", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.rem_channel_type_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_rem_channel_type->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.rem_channel_type_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['name'] = $request->input('name');
			$set['state'] = $request->input('state');
			$set['describe'] = $request->input('describe');
			$ret = $this->_m_rem_channel_type->update($id, $set);

			$tip_info = array("module"=>"rem_channel_type", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_rem_channel_type->detail($id);
		
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_type_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_rem_channel_type->detail($id);
		 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.rem_channel_type_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_rem_channel_type->delete($id);

		return $ret;

		$tip_info = array("module"=>"rem_channel_type", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.rem_channel_type_delete",$assign);

	}

	
}