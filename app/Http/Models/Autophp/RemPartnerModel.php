<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemPartner;
use Illuminate\Support\Facades\DB;

class RemPartnerModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemPartner();

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

       	public function update($partner_id, array $data) {
				
			$obj = RemPartner::find($partner_id);

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

       	public function delete($partner_id) {
			return RemPartner::destroy($partner_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_partner`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($partner_id) {
			
    		if (empty($partner_id)) {
    			return false;
			}


    		$detail = RemPartner::find($partner_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemPartner::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["partner_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($partner_name = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_partner`.* FROM `rem_partner` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_partner` WHERE 1=1";
				
			
			if (!empty($partner_name)) {
				$cond["partner_name"] = "%$partner_name%"; 

				$sql .= ' AND `rem_partner`.`partner_name` like  :partner_name';
				$c_sql .= ' AND `rem_partner`.`partner_name` like :partner_name';
			}
			$sql .= " ORDER BY partner_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}