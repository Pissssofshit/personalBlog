<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemGame;
use Illuminate\Support\Facades\DB;

class RemGameModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemGame();

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

       	public function update($game_id, array $data) {
				
			$obj = RemGame::find($game_id);

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

       	public function delete($game_id) {
			return RemGame::destroy($game_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_game`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($game_id) {
			
    		if (empty($game_id)) {
    			return false;
			}


    		$detail = RemGame::find($game_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemGame::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["game_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($partner_id = null, $game_name = null, $state = null, $category_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_game`.* FROM `rem_game` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_game` WHERE 1=1";
				
			
			if (!empty($partner_id)) {
				$cond["partner_id"] = $partner_id; 

				$sql .= ' AND `rem_game`.`partner_id` = :partner_id';
				$c_sql .= ' AND `rem_game`.`partner_id` = :partner_id';
			}
			if (!empty($game_name)) {
				$cond["game_name"] = "%$game_name%"; 

				$sql .= ' AND `rem_game`.`game_name` like  :game_name';
				$c_sql .= ' AND `rem_game`.`game_name` like :game_name';
			}
			if (!empty($state)) {
				$cond["state"] = $state; 

				$sql .= ' AND `rem_game`.`state` = :state';
				$c_sql .= ' AND `rem_game`.`state` = :state';
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `rem_game`.`category_id` = :category_id';
				$c_sql .= ' AND `rem_game`.`category_id` = :category_id';
			}
			$sql .= " ORDER BY game_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}