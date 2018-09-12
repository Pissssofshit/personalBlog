<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\GameConfigSwitch;
use Illuminate\Support\Facades\DB;

class GameConfigSwitchModel
{
	protected $_connection_name = "xdwsy";

	
        public function insert(array $data) {
				

			$obj = new GameConfigSwitch();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($game_id, array $data) {
				
			$obj = GameConfigSwitch::find($game_id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($game_id) {
			return GameConfigSwitch::destroy($game_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `game_config_switch`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($game_id) {
			
    		if (empty($game_id)) {
    			return false;
			}


    		$detail = GameConfigSwitch::find($game_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  GameConfigSwitch::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["game_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `game_config_switch`.* FROM `game_config_switch` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `game_config_switch` WHERE 1=1";
				
			
			$sql .= " ORDER BY game_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}