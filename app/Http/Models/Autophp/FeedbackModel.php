<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\Feedback;
use Illuminate\Support\Facades\DB;

class FeedbackModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new Feedback();

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
				
			$obj = Feedback::find($id);

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
			return Feedback::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `feedback`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = Feedback::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  Feedback::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($type_alias = null, $partner_id = null, $plan_id = null, $game_id = null, $site_id = null, $category_id = null, $insert_time = array(), $notice_time = array(), $match_time = array(), $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `feedback`.* FROM `feedback` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `feedback` WHERE 1=1";
				
			
			if (!empty($type_alias)) {
				$cond["type_alias"] = "%$type_alias%"; 

				$sql .= ' AND `feedback`.`type_alias` like  :type_alias';
				$c_sql .= ' AND `feedback`.`type_alias` like :type_alias';
			}
			if (!empty($partner_id)) {
				$cond["partner_id"] = $partner_id; 

				$sql .= ' AND `feedback`.`partner_id` = :partner_id';
				$c_sql .= ' AND `feedback`.`partner_id` = :partner_id';
			}
			if (!empty($plan_id)) {
				$cond["plan_id"] = $plan_id; 

				$sql .= ' AND `feedback`.`plan_id` = :plan_id';
				$c_sql .= ' AND `feedback`.`plan_id` = :plan_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `feedback`.`game_id` = :game_id';
				$c_sql .= ' AND `feedback`.`game_id` = :game_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `feedback`.`site_id` = :site_id';
				$c_sql .= ' AND `feedback`.`site_id` = :site_id';
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `feedback`.`category_id` = :category_id';
				$c_sql .= ' AND `feedback`.`category_id` = :category_id';
			}
			if (!empty($insert_time)) {
				$start = $insert_time['start'];
				$end = $insert_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["insert_time_start"] = $start;
					$sql .= ' AND `feedback`.`insert_time` > :insert_time_start';
					$c_sql .= ' AND `feedback`.`insert_time` > :insert_time_start' ;
				}

				if (!empty($end)) {
					$cond["insert_time_end"] = $end;
					$sql .= ' AND `feedback`.`insert_time` < :insert_time_end';
					$c_sql .= ' AND `feedback`.`insert_time` < :insert_time_end';
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
					$sql .= ' AND `feedback`.`notice_time` > :notice_time_start';
					$c_sql .= ' AND `feedback`.`notice_time` > :notice_time_start' ;
				}

				if (!empty($end)) {
					$cond["notice_time_end"] = $end;
					$sql .= ' AND `feedback`.`notice_time` < :notice_time_end';
					$c_sql .= ' AND `feedback`.`notice_time` < :notice_time_end';
				}
			}
			if (!empty($match_time)) {
				$start = $match_time['start'];
				$end = $match_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["match_time_start"] = $start;
					$sql .= ' AND `feedback`.`match_time` > :match_time_start';
					$c_sql .= ' AND `feedback`.`match_time` > :match_time_start' ;
				}

				if (!empty($end)) {
					$cond["match_time_end"] = $end;
					$sql .= ' AND `feedback`.`match_time` < :match_time_end';
					$c_sql .= ' AND `feedback`.`match_time` < :match_time_end';
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