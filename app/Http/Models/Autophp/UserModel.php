<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\User;
use Illuminate\Support\Facades\DB;

class UserModel
{
	protected $_connection_name = "xdwsy";

	
        public function insert(array $data) {
				

			$obj = new User();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = User::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return User::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `user`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = User::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  User::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($username = null, $mobile = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `user`.* FROM `user` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `user` WHERE 1=1";
				
			
			if (!empty($username)) {
				$cond["username"] = "%$username%"; 

				$sql .= ' AND `user`.`username` like  :username';
				$c_sql .= ' AND `user`.`username` like :username';
			}
			if (!empty($mobile)) {
				$cond["mobile"] = "%$mobile%"; 

				$sql .= ' AND `user`.`mobile` like  :mobile';
				$c_sql .= ' AND `user`.`mobile` like :mobile';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}