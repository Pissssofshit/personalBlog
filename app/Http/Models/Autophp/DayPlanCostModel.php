<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\DayPlanCost;
use Illuminate\Support\Facades\DB;

class DayPlanCostModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new DayPlanCost();

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
				
			$obj = DayPlanCost::find($id);

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
			return DayPlanCost::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `day_plan_cost`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = DayPlanCost::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  DayPlanCost::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($plan_id = null, $account_id = null, $game_id = null, $site_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `day_plan_cost`.* FROM `day_plan_cost` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `day_plan_cost` WHERE 1=1";
				
			
			if (!empty($plan_id)) {
				$cond["plan_id"] = $plan_id; 

				$sql .= ' AND `day_plan_cost`.`plan_id` = :plan_id';
				$c_sql .= ' AND `day_plan_cost`.`plan_id` = :plan_id';
			}
			if (!empty($account_id)) {
				$cond["account_id"] = $account_id; 

				$sql .= ' AND `day_plan_cost`.`account_id` = :account_id';
				$c_sql .= ' AND `day_plan_cost`.`account_id` = :account_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `day_plan_cost`.`game_id` = :game_id';
				$c_sql .= ' AND `day_plan_cost`.`game_id` = :game_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `day_plan_cost`.`site_id` = :site_id';
				$c_sql .= ' AND `day_plan_cost`.`site_id` = :site_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}