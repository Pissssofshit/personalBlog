<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\CfgPayWay;
use Illuminate\Support\Facades\DB;

class CfgPayWayModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new CfgPayWay();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = CfgPayWay::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return CfgPayWay::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `cfg_pay_way`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = CfgPayWay::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  CfgPayWay::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($name = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `cfg_pay_way`.* FROM `cfg_pay_way` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `cfg_pay_way` WHERE 1=1";
				
			
			if (!empty($name)) {
				$cond["name"] = "%$name%"; 

				$sql .= ' AND `cfg_pay_way`.`name` like  :name';
				$c_sql .= ' AND `cfg_pay_way`.`name` like :name';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}