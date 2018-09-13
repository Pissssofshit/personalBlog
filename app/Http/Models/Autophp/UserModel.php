<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\User;
use Illuminate\Support\Facades\DB;

class UserModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new User();

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
				
			$obj = User::find($id);

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

		public function getList($uid = null, $passport = null, $partner_id = null, $plan_id = null, $account_id = null, $game_id = null, $material_id = null, $site_id = null, $is_role = null, $is_reg = null, $reg_time = array(), $category_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `user`.* FROM `user` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `user` WHERE 1=1";
				
			
			if (!empty($uid)) {
				$cond["uid"] = $uid; 

				$sql .= ' AND `user`.`uid` = :uid';
				$c_sql .= ' AND `user`.`uid` = :uid';
			}
			if (!empty($passport)) {
				$cond["passport"] = "%$passport%"; 

				$sql .= ' AND `user`.`passport` like  :passport';
				$c_sql .= ' AND `user`.`passport` like :passport';
			}
			if (!empty($partner_id)) {
				$cond["partner_id"] = $partner_id; 

				$sql .= ' AND `user`.`partner_id` = :partner_id';
				$c_sql .= ' AND `user`.`partner_id` = :partner_id';
			}
			if (!empty($plan_id)) {
				$cond["plan_id"] = $plan_id; 

				$sql .= ' AND `user`.`plan_id` = :plan_id';
				$c_sql .= ' AND `user`.`plan_id` = :plan_id';
			}
			if (!empty($account_id)) {
				$cond["account_id"] = $account_id; 

				$sql .= ' AND `user`.`account_id` = :account_id';
				$c_sql .= ' AND `user`.`account_id` = :account_id';
			}
			if (!empty($game_id)) {
				$cond["game_id"] = $game_id; 

				$sql .= ' AND `user`.`game_id` = :game_id';
				$c_sql .= ' AND `user`.`game_id` = :game_id';
			}
			if (!empty($material_id)) {
				$cond["material_id"] = $material_id; 

				$sql .= ' AND `user`.`material_id` = :material_id';
				$c_sql .= ' AND `user`.`material_id` = :material_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `user`.`site_id` = :site_id';
				$c_sql .= ' AND `user`.`site_id` = :site_id';
			}
			if (!empty($is_role)) {
				$cond["is_role"] = $is_role; 

				$sql .= ' AND `user`.`is_role` = :is_role';
				$c_sql .= ' AND `user`.`is_role` = :is_role';
			}
			if (!empty($is_reg)) {
				$cond["is_reg"] = $is_reg; 

				$sql .= ' AND `user`.`is_reg` = :is_reg';
				$c_sql .= ' AND `user`.`is_reg` = :is_reg';
			}
			if (!empty($reg_time)) {
				$start = $reg_time['start'];
				$end = $reg_time['end'];


				$start = strtotime($start);
				$end = strlen($end) > 10 ? $end : $end . " 23:99:99";
				$end = strtotime($end);
					
				if (!empty($start)) {
					$cond["reg_time_start"] = $start;
					$sql .= ' AND `user`.`reg_time` > :reg_time_start';
					$c_sql .= ' AND `user`.`reg_time` > :reg_time_start' ;
				}

				if (!empty($end)) {
					$cond["reg_time_end"] = $end;
					$sql .= ' AND `user`.`reg_time` < :reg_time_end';
					$c_sql .= ' AND `user`.`reg_time` < :reg_time_end';
				}
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `user`.`category_id` = :category_id';
				$c_sql .= ' AND `user`.`category_id` = :category_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}