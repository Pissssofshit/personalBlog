<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\PayLog;
use Illuminate\Support\Facades\DB;

class PayLogModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new PayLog();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}
			try{
			$ret = $obj->save();
			}catch(\Exception $e){
                $ret = false;
            }

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = PayLog::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}
			try{
			$ret = $obj->save();
			}catch(\Exception $e){
                $ret = false;
            }
			return $ret;	
    	}

       	public function delete($id) {
			return PayLog::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `pay_log`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = PayLog::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  PayLog::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($order_id = null, $uid = null, $partner_id = null, $game_id = null, $server_id = null, $site_id = null, $reg_time = array(), $pay_time = array(), $pay_money = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `pay_log`.* FROM `pay_log` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `pay_log` WHERE 1=1";
				
			
			if (!empty($order_id)) {
				$cond["order_id"] = $order_id; 

				$sql .= ' AND `pay_log`.`order_id` = :order_id';
				$c_sql .= ' AND `pay_log`.`order_id` = :order_id';
			}
			if (!empty($uid)) {
				$cond["uid"] = $uid; 

				$sql .= ' AND `pay_log`.`uid` = :uid';
				$c_sql .= ' AND `pay_log`.`uid` = :uid';
			}
			if (!empty($partner_id)) {
				$cond["partner_id"] = $partner_id; 

				$sql .= ' AND `pay_log`.`partner_id` = :partner_id';
				$c_sql .= ' AND `pay_log`.`partner_id` = :partner_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `pay_log`.`game_id` = :game_id';
				$c_sql .= ' AND `pay_log`.`game_id` = :game_id';
			}
			if (!empty($server_id)) {
				$cond["server_id"] = $server_id; 

				$sql .= ' AND `pay_log`.`server_id` = :server_id';
				$c_sql .= ' AND `pay_log`.`server_id` = :server_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `pay_log`.`site_id` = :site_id';
				$c_sql .= ' AND `pay_log`.`site_id` = :site_id';
			}
			if (!empty($reg_time)) {
				$start = $reg_time['start'];
				$end = $reg_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["reg_time_start"] = $start;
					$sql .= ' AND `pay_log`.`reg_time` > :reg_time_start';
					$c_sql .= ' AND `pay_log`.`reg_time` > :reg_time_start' ;
				}

				if (!empty($end)) {
					$cond["reg_time_end"] = $end;
					$sql .= ' AND `pay_log`.`reg_time` < :reg_time_end';
					$c_sql .= ' AND `pay_log`.`reg_time` < :reg_time_end';
				}
			}
			if (!empty($pay_time)) {
				$start = $pay_time['start'];
				$end = $pay_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["pay_time_start"] = $start;
					$sql .= ' AND `pay_log`.`pay_time` > :pay_time_start';
					$c_sql .= ' AND `pay_log`.`pay_time` > :pay_time_start' ;
				}

				if (!empty($end)) {
					$cond["pay_time_end"] = $end;
					$sql .= ' AND `pay_log`.`pay_time` < :pay_time_end';
					$c_sql .= ' AND `pay_log`.`pay_time` < :pay_time_end';
				}
			}
			if (!empty($pay_money)) {
				$cond["pay_money"] = $pay_money; 

				$sql .= ' AND `pay_log`.`pay_money` = :pay_money';
				$c_sql .= ' AND `pay_log`.`pay_money` = :pay_money';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}