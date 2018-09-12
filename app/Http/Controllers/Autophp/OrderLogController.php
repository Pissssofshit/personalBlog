<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\OrderLogModel;
use App\Library\Pager;
use App\Library\Utils;

class OrderLogController extends Controller {
	private $_tpl;
	private $_m_order_log;
	public function __construct() {
		$this->_m_order_log = new OrderLogModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/order_log/list");
		return view("autophp.order_log_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_order_log->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.order_log_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_order_log->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"\u5e73\u53f0\u7528\u6237id","order_id":"order\u8868id","action_name":"\u52a8\u4f5c\u540d\u79f0","action_param":"\u52a8\u4f5c\u53c2\u6570","action_res":"\u52a8\u4f5c\u7ed3\u679c","create_time":"\u65f6\u95f4\u6233"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "订单变更日志". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.order_log_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['order_id'] = $request->input('order_id');
			$input['action_name'] = $request->input('action_name');
			$input['action_param'] = $request->input('action_param');
			$input['action_res'] = $request->input('action_res');
			$input['create_time'] = strtotime($request->input('create_time'));
			$ret = $this->_m_order_log->insert($input);

			$tip_info = array("module"=>"order_log", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.order_log_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_order_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.order_log_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['order_id'] = $request->input('order_id');
			$set['action_name'] = $request->input('action_name');
			$set['action_param'] = $request->input('action_param');
			$set['action_res'] = $request->input('action_res');
			$set['create_time'] = strtotime($request->input('create_time'));
			$ret = $this->_m_order_log->update($id, $set);

			$tip_info = array("module"=>"order_log", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_order_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.order_log_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_order_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.order_log_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_order_log->delete($id);

		return $ret;

		$tip_info = array("module"=>"order_log", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.order_log_delete",$assign);

	}

	
}