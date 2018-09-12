<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\OrderModel;
use App\Library\Pager;
use App\Library\Utils;

class OrderController extends Controller {
	private $_tpl;
	private $_m_order;
	public function __construct() {
		$this->_m_order = new OrderModel();
		parent::__construct();
	}

	public function welcome() {
		header("Location: /admin/order/list");
		return view("autophp.order_index");
	}

	public function index(Request $request) {
		$page = $request->input('page');
		$page = $page > 0 ? $page : 1;
		$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		$data = $this->_m_order->getList($page, $page_size);
		$list = $data['list'];
		$count = $data['count'];
		@list($action_url, $else) = explode("?", $_SERVER['REQUEST_URI']);
		$base_url = $action_url . "?";
		$page_html = Pager::getDivPage($base_url, $count, $page, $page_size);

        
        
        $details = isset($details)?$details:[];
        $assigns = ["detail"=>$details,"list"=>$list,"dict_boolean"=>array("否", "是"),"page_html"=>$page_html,"action_url"=>$action_url,"csrf_token"=>csrf_token()];
		$assign = isset($assign)?array_merge($assign,$assigns):$assigns;
		return view("autophp.order_list",$assign);
	}
	public function export(Request $request) {
		
		$data = $this->_m_order->getList();
		$list = $data['list'];
		$columnnames = '{"id":"ID","user_id":"\u5e73\u53f0\u7528\u6237id","game_id":"\u6e38\u620fid","game_order_id":"\u6e38\u620f\u8ba2\u5355\u53f7","ucode":"\u6e20\u9053\u6807\u793a","subucode":"\u5b50\u6e20\u9053\u6807\u793a","server_id":"\u6e38\u620f\u670d\u52a1\u5668","role_name":"\u6e38\u620f\u89d2\u8272\u540d","desc":"\u8ba2\u5355\u63cf\u8ff0","order_coin":"\u6e38\u620f\u5e01\u6570\u91cf","order_money":"\u8ba2\u5355\u91d1\u989d","pay_channel_id":"\u652f\u4ed8\u65b9\u5f0f:0-\u5e73\u53f0\u5e01;pay_channel\u91cc\u7684id","pay_point":"\u652f\u4ed8\u5e73\u53f0\u5e01\u6570\u91cf","pay_point_free":"\u652f\u4ed8\u7684\u5e73\u53f0\u8d60\u9001\u5e73\u53f0\u5e01\u6570\u91cf","pay_money":"\u5b9e\u9645\u652f\u4ed8\u91d1\u989d","extra":"\u900f\u4f20\u5b57\u6bb5:SDK\u63d0\u4ea4\u8fc7\u6765\u9700\u900f\u4f20\u7684\u5b57\u6bb5","pay_virtual_point":"\u652f\u4ed8\u7684\u865a\u62df\u8d27\u5e01","create_time":"\u521b\u5efa\u65f6\u95f4\u6233","update_time":"\u66f4\u65b0\u65f6\u95f4\u6233","status":"\u8ba2\u5355\u72b6\u6001:1-\u5df2\u521b\u5efa\uff1b2-\u5df2\u63d0\u4ea4\u7b2c\u4e09\u65b9\uff1b3-\u7b2c\u4e09\u65b9\u5145\u503c\u6210\u529f\uff1b4-\u8c03\u7528\u6e38\u620f\u540e\u53f0\u63a5\u53e3\u4e0b\u53d1\u6e38\u620f\u5e01\u6210\u529f\uff1b5-\u7b49\u5f85\u7ee7\u7eed\u652f\u4ed8\uff1b6-\u652f\u4ed8\u8d85\u65f6\uff1b7-\u652f\u4ed8\u5931\u8d25"}';
        
        $columnnames = json_decode($columnnames,true);
        $columnkeys = array_keys($columnnames);
        $data=[];
        foreach( $list as $key=>$val){
            foreach ($columnkeys as $columnfield) {
                $data[$key][$columnfield] = "	" . $val->$columnfield;
            }
        }
        $fileName = "订单". date('YmdHis', time()) .'.csv';
        Utils::export($fileName, $columnnames, $data, "");
	}

	public function create(Request $request) {
		 
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.order_add",$assign);
	}

	public function store(Request $request) {
		if (!empty($_POST)) {
			$input = array();
			$input['user_id'] = $request->input('user_id');
			$input['game_id'] = $request->input('game_id');
			$input['game_order_id'] = $request->input('game_order_id');
			$input['ucode'] = $request->input('ucode');
			$input['subucode'] = $request->input('subucode');
			$input['server_id'] = $request->input('server_id');
			$input['role_name'] = $request->input('role_name');
			$input['desc'] = $request->input('desc');
			$input['order_coin'] = $request->input('order_coin');
			$input['order_money'] = $request->input('order_money');
			$input['pay_channel_id'] = $request->input('pay_channel_id');
			$input['pay_point'] = $request->input('pay_point');
			$input['pay_point_free'] = $request->input('pay_point_free');
			$input['pay_money'] = $request->input('pay_money');
			$input['extra'] = $request->input('extra');
			$input['pay_virtual_point'] = $request->input('pay_virtual_point');
			$input['create_time'] = strtotime($request->input('create_time'));
			$input['update_time'] = strtotime($request->input('update_time'));
			$input['status'] = $request->input('status');
			$ret = $this->_m_order->insert($input);

			$tip_info = array("module"=>"order", "action"=>"添加", "status"=>"$ret");
            $assign["tip_info"] = $tip_info;
            $assign["csrf_token"] = csrf_token();
			return view("autophp.common.tips",$assign);
		}

		 
		$assign["dict_boolean"] = array("否", "是");
		return view("autophp.order_add",$assign);
	}

	public function edit($id) {
		$detail = $this->_m_order->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] =array("否", "是");
        $assign["csrf_token"] =csrf_token();
		return view("autophp.order_edit",$assign);
	}

	public function update(Request $request) {
		$id =  $request->input("id");
		if (!empty($_POST)) {
			$set = array();
			$set['user_id'] = $request->input('user_id');
			$set['game_id'] = $request->input('game_id');
			$set['game_order_id'] = $request->input('game_order_id');
			$set['ucode'] = $request->input('ucode');
			$set['subucode'] = $request->input('subucode');
			$set['server_id'] = $request->input('server_id');
			$set['role_name'] = $request->input('role_name');
			$set['desc'] = $request->input('desc');
			$set['order_coin'] = $request->input('order_coin');
			$set['order_money'] = $request->input('order_money');
			$set['pay_channel_id'] = $request->input('pay_channel_id');
			$set['pay_point'] = $request->input('pay_point');
			$set['pay_point_free'] = $request->input('pay_point_free');
			$set['pay_money'] = $request->input('pay_money');
			$set['extra'] = $request->input('extra');
			$set['pay_virtual_point'] = $request->input('pay_virtual_point');
			$set['create_time'] = strtotime($request->input('create_time'));
			$set['update_time'] = strtotime($request->input('update_time'));
			$set['status'] = $request->input('status');
			$ret = $this->_m_order->update($id, $set);

			$tip_info = array("module"=>"order", "action"=>"更新", "status"=>"$ret");
			$assign["tip_info"] =$tip_info;
			return view("autophp.common.tips",$assign);
			
		}
		$detail = $this->_m_order->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ?'': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ?'': date('Y-m-d H:i', $detail['update_time']);
		$assign["detail"] = $detail;
		

		
        $assign["dict_boolean"] = array("否", "是");
        $assign["csrf_token"] = csrf_token();
		return view("autophp.order_edit",$assign);
	}

	public function show($id) {

		$detail = $this->_m_order->detail($id);
		$detail['create_time'] =  empty($detail['create_time']) ? '': date('Y-m-d H:i', $detail['create_time']);
			$detail['update_time'] =  empty($detail['update_time']) ? '': date('Y-m-d H:i', $detail['update_time']); 
		
        $assign["detail"] = $detail;
		
		$assign["dict_boolean"] = array("否", "是");
		$assign["csrf_token"] = csrf_token();
		return view("autophp.order_detail",$assign);
	}

	public function destroy($id) {
		$assign["csrf_token"]=csrf_token();

		$ret = $this->_m_order->delete($id);

		return $ret;

		$tip_info = array("module"=>"order", "action"=>"删除", "status"=>"$ret");
		$assign["tip_info"]=$tip_info;
		view("autophp.common.tips");
		return;
        return view("autophp.order_delete",$assign);

	}

	
}