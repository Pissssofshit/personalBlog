<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\PowerRole;
use Illuminate\Support\Facades\DB;

class PowerRoleModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new PowerRole();

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

       	public function update($power_role_id, array $data) {
				
			$obj = PowerRole::find($power_role_id);

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

       	public function delete($power_role_id) {
			return PowerRole::destroy($power_role_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `power_role`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($power_role_id) {
			
    		if (empty($power_role_id)) {
    			return false;
			}


    		$detail = PowerRole::find($power_role_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  PowerRole::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["power_role_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($company_ids = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `power_role`.* FROM `power_role` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `power_role` WHERE 1=1";
				
			
			if (!empty($company_ids)) {
				$cond["company_ids"] = "%$company_ids%"; 

				$sql .= ' AND `power_role`.`company_ids` like  :company_ids';
				$c_sql .= ' AND `power_role`.`company_ids` like :company_ids';
			}
			$sql .= " ORDER BY power_role_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}