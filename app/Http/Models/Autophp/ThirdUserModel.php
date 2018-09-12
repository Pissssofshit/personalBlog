<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\ThirdUser;
use Illuminate\Support\Facades\DB;

class ThirdUserModel
{
	protected $_connection_name = "xdwsy";

	
        public function insert(array $data) {
				

			$obj = new ThirdUser();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = ThirdUser::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return ThirdUser::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `third_user`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = ThirdUser::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  ThirdUser::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($user_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `third_user`.* FROM `third_user` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `third_user` WHERE 1=1";
				
			
			if (!empty($user_id)) {
				$cond["user_id"] = "%$user_id%"; 

				$sql .= ' AND `third_user`.`user_id` like  :user_id';
				$c_sql .= ' AND `third_user`.`user_id` like :user_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}