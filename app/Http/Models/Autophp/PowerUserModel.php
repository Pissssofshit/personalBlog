<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\PowerUser;
use Illuminate\Support\Facades\DB;

class PowerUserModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new PowerUser();

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

       	public function update($power_user_id, array $data) {
				
			$obj = PowerUser::find($power_user_id);

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

       	public function delete($power_user_id) {
			return PowerUser::destroy($power_user_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `power_user`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($power_user_id) {
			
    		if (empty($power_user_id)) {
    			return false;
			}


    		$detail = PowerUser::find($power_user_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  PowerUser::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["power_user_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($power_user_name = null, $power_role_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `power_user`.* FROM `power_user` LEFT JOIN `power_role` ON `power_user`.`power_role_id` = `power_role`.`power_role_id` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `power_user` LEFT JOIN `power_role` ON `power_user`.`power_role_id` = `power_role`.`power_role_id` WHERE 1=1";
				
			
			if (!empty($power_user_name)) {
				$cond["power_user_name"] = "%$power_user_name%"; 

				$sql .= ' AND `power_user`.`power_user_name` like  :power_user_name';
				$c_sql .= ' AND `power_user`.`power_user_name` like :power_user_name';
			}
			if (!empty($power_role_id)) {
				$cond["power_role_id"] = $power_role_id; 

				$sql .= ' AND `power_user`.`power_role_id` = :power_role_id';
				$c_sql .= ' AND `power_user`.`power_role_id` = :power_role_id';
			}
			$sql .= " ORDER BY power_user_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}