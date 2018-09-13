<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\CfgMode;
use Illuminate\Support\Facades\DB;

class CfgModeModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new CfgMode();

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

       	public function update($mode_id, array $data) {
				
			$obj = CfgMode::find($mode_id);

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

       	public function delete($mode_id) {
			return CfgMode::destroy($mode_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `cfg_mode`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($mode_id) {
			
    		if (empty($mode_id)) {
    			return false;
			}


    		$detail = CfgMode::find($mode_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  CfgMode::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["mode_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($mode_name = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `cfg_mode`.* FROM `cfg_mode` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `cfg_mode` WHERE 1=1";
				
			
			if (!empty($mode_name)) {
				$cond["mode_name"] = "%$mode_name%"; 

				$sql .= ' AND `cfg_mode`.`mode_name` like  :mode_name';
				$c_sql .= ' AND `cfg_mode`.`mode_name` like :mode_name';
			}
			$sql .= " ORDER BY mode_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}