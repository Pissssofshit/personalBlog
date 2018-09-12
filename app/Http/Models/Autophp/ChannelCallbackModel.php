<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\ChannelCallback;
use Illuminate\Support\Facades\DB;

class ChannelCallbackModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new ChannelCallback();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = ChannelCallback::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return ChannelCallback::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `channel_callback`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = ChannelCallback::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  ChannelCallback::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($uid = null, $passport = null, $partner_id = null, $game_id = null, $server_id = null, $site_id = null, $insert_time = array(), $notice_time = array(), $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `channel_callback`.* FROM `channel_callback` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `channel_callback` WHERE 1=1";
				
			
			if (!empty($uid)) {
				$cond["uid"] = $uid; 

				$sql .= ' AND `channel_callback`.`uid` = :uid';
				$c_sql .= ' AND `channel_callback`.`uid` = :uid';
			}
			if (!empty($passport)) {
				$cond["passport"] = "%$passport%"; 

				$sql .= ' AND `channel_callback`.`passport` like  :passport';
				$c_sql .= ' AND `channel_callback`.`passport` like :passport';
			}
			if (!empty($partner_id)) {
				$cond["partner_id"] = $partner_id; 

				$sql .= ' AND `channel_callback`.`partner_id` = :partner_id';
				$c_sql .= ' AND `channel_callback`.`partner_id` = :partner_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `channel_callback`.`game_id` = :game_id';
				$c_sql .= ' AND `channel_callback`.`game_id` = :game_id';
			}
			if (!empty($server_id)) {
				$cond["server_id"] = $server_id; 

				$sql .= ' AND `channel_callback`.`server_id` = :server_id';
				$c_sql .= ' AND `channel_callback`.`server_id` = :server_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `channel_callback`.`site_id` = :site_id';
				$c_sql .= ' AND `channel_callback`.`site_id` = :site_id';
			}
			if (!empty($insert_time)) {
				$start = $insert_time['start'];
				$end = $insert_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["insert_time_start"] = $start;
					$sql .= ' AND `channel_callback`.`insert_time` > :insert_time_start';
					$c_sql .= ' AND `channel_callback`.`insert_time` > :insert_time_start' ;
				}

				if (!empty($end)) {
					$cond["insert_time_end"] = $end;
					$sql .= ' AND `channel_callback`.`insert_time` < :insert_time_end';
					$c_sql .= ' AND `channel_callback`.`insert_time` < :insert_time_end';
				}
			}
			if (!empty($notice_time)) {
				$start = $notice_time['start'];
				$end = $notice_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["notice_time_start"] = $start;
					$sql .= ' AND `channel_callback`.`notice_time` > :notice_time_start';
					$c_sql .= ' AND `channel_callback`.`notice_time` > :notice_time_start' ;
				}

				if (!empty($end)) {
					$cond["notice_time_end"] = $end;
					$sql .= ' AND `channel_callback`.`notice_time` < :notice_time_end';
					$c_sql .= ' AND `channel_callback`.`notice_time` < :notice_time_end';
				}
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}