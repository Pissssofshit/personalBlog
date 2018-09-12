<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\UserLoginLog;
use Illuminate\Support\Facades\DB;

class UserLoginLogModel
{
	protected $_connection_name = "xdwsy";

	
        public function insert(array $data) {
				

			$obj = new UserLoginLog();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = UserLoginLog::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return UserLoginLog::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `user_login_log`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = UserLoginLog::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  UserLoginLog::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `user_login_log`.* FROM `user_login_log` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `user_login_log` WHERE 1=1";
				
			
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}