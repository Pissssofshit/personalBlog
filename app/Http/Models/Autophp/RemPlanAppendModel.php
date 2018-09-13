<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemPlanAppend;
use Illuminate\Support\Facades\DB;

class RemPlanAppendModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemPlanAppend();

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

       	public function update($plan_id, array $data) {
				
			$obj = RemPlanAppend::find($plan_id);

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

       	public function delete($plan_id) {
			return RemPlanAppend::destroy($plan_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_plan_append`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($plan_id) {
			
    		if (empty($plan_id)) {
    			return false;
			}


    		$detail = RemPlanAppend::find($plan_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemPlanAppend::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["plan_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($ios_game_id = null, $version = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_plan_append`.* FROM `rem_plan_append` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_plan_append` WHERE 1=1";
				
			
			if (!empty($ios_game_id)) {
				$cond["ios_game_id"] = $ios_game_id; 

				$sql .= ' AND `rem_plan_append`.`ios_game_id` = :ios_game_id';
				$c_sql .= ' AND `rem_plan_append`.`ios_game_id` = :ios_game_id';
			}
			if (!empty($version)) {
				$cond["version"] = "%$version%"; 

				$sql .= ' AND `rem_plan_append`.`version` like  :version';
				$c_sql .= ' AND `rem_plan_append`.`version` like :version';
			}
			$sql .= " ORDER BY plan_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}