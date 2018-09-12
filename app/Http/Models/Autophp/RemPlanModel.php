<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemPlan;
use Illuminate\Support\Facades\DB;

class RemPlanModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemPlan();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($plan_id, array $data) {
				
			$obj = RemPlan::find($plan_id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($plan_id) {
			return RemPlan::destroy($plan_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_plan`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($plan_id) {
			
    		if (empty($plan_id)) {
    			return false;
			}


    		$detail = RemPlan::find($plan_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemPlan::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["plan_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($plan_name = null, $account_id = null, $game_id = null, $site_id = null, $category_id = null, $mode_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_plan`.* FROM `rem_plan` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_plan` WHERE 1=1";
				
			
			if (!empty($plan_name)) {
				$cond["plan_name"] = "%$plan_name%"; 

				$sql .= ' AND `rem_plan`.`plan_name` like  :plan_name';
				$c_sql .= ' AND `rem_plan`.`plan_name` like :plan_name';
			}
			if (!empty($account_id)) {
				$cond["account_id"] = $account_id; 

				$sql .= ' AND `rem_plan`.`account_id` = :account_id';
				$c_sql .= ' AND `rem_plan`.`account_id` = :account_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `rem_plan`.`game_id` = :game_id';
				$c_sql .= ' AND `rem_plan`.`game_id` = :game_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `rem_plan`.`site_id` = :site_id';
				$c_sql .= ' AND `rem_plan`.`site_id` = :site_id';
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `rem_plan`.`category_id` = :category_id';
				$c_sql .= ' AND `rem_plan`.`category_id` = :category_id';
			}
			if (!empty($mode_id)) {
				$cond["mode_id"] = $mode_id; 

				$sql .= ' AND `rem_plan`.`mode_id` = :mode_id';
				$c_sql .= ' AND `rem_plan`.`mode_id` = :mode_id';
			}
			$sql .= " ORDER BY plan_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}