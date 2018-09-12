<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\UserPointLogModel;
use App\Library\Pager;
use App\Library\Utils;

class UserPointLogController extends Controller {
	private $_tpl;
	private $_m_user_point_log;
	public function __construct() {
		$this->_m_user_point_log = new UserPointLogModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/user_point_log/list");
		return view("autophp.user_point_log_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_user_point_log->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.user_point_log_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_user_point_log->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"\u5e73\u53f0\u7528\u6237id","before_point":"\u53d8\u66f4\u524d\u5e73\u53f0\u5e01","point":"\u53d8\u66f4\u7684\u5e73\u53f0\u5e01","after_point":"\u53d8\u66f4\u540e\u7684\u5e73\u53f0\u5e01","before_point_free":"\u53d8\u66f4\u524d\u8d60\u9001\u5e73\u53f0\u5e01","point_free":"\u53d8\u66f4\u7684\u8d60\u9001\u5e73\u53f0\u5e01","after_point_free":"\u53d8\u66f4\u540e\u7684\u8d60\u9001\u5e73\u53f0\u5e01","type":"\u53d8\u66f4\u7c7b\u578b","desc":"\u53d8\u66f4\u8bf4\u660e","create_time":"\u53d8\u66f4\u65f6\u95f4\u6233"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "平台币日志". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("autophp.user_point_log_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['before_point'] = $request->input('before_point');
			$input['point'] = $request->input('point');
			$input['after_point'] = $request->input('after_point');
			$input['before_point_free'] = $request->input('before_point_free');
			$input['point_free'] = $request->input('point_free');
			$input['after_point_free'] = $request->input('after_point_free');
			$input['type'] = $request->input('type');
			$input['desc'] = $request->input('desc');
			$input['create_time'] = strtotime($request->input('create_time'));
			$ret = $this->_m_user_point_log->insert($input);

			$tip_info = array("module"=>"user_point_log", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.user_point_log_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_user_point_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.user_point_log_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['before_point'] = $request->input('before_point');
			$set['point'] = $request->input('point');
			$set['after_point'] = $request->input('after_point');
			$set['before_point_free'] = $request->input('before_point_free');
			$set['point_free'] = $request->input('point_free');
			$set['after_point_free'] = $request->input('after_point_free');
			$set['type'] = $request->input('type');
			$set['desc'] = $request->input('desc');
			$set['create_time'] = strtotime($request->input('create_time'));
			$ret = $this->_m_user_point_log->update($id, $set);

			$tip_info = array("module"=>"user_point_log", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_user_point_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.user_point_log_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_user_point_log->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.user_point_log_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_user_point_log->delete($id);

		return $ret;

		$tip_info = array("module"=>"user_point_log", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.user_point_log_delete",$assign);

	}

	
}