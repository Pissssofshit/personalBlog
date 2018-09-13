<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemCompany;
use Illuminate\Support\Facades\DB;

class RemCompanyModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemCompany();

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
				
			$obj = RemCompany::find($id);

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
			return RemCompany::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_company`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = RemCompany::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemCompany::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($type_alias = null, $channel_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_company`.* FROM `rem_company` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_company` WHERE 1=1";
				
			
			if (!empty($type_alias)) {
				$cond["type_alias"] = "%$type_alias%"; 

				$sql .= ' AND `rem_company`.`type_alias` like  :type_alias';
				$c_sql .= ' AND `rem_company`.`type_alias` like :type_alias';
			}
			if (!empty($channel_id)) {
				$cond["channel_id"] = $channel_id; 

				$sql .= ' AND `rem_company`.`channel_id` = :channel_id';
				$c_sql .= ' AND `rem_company`.`channel_id` = :channel_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}