<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\CfgSubsistSign;
use Illuminate\Support\Facades\DB;

class CfgSubsistSignModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new CfgSubsistSign();

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

       	public function update($subsist_day, array $data) {
				
			$obj = CfgSubsistSign::find($subsist_day);

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

       	public function delete($subsist_day) {
			return CfgSubsistSign::destroy($subsist_day);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `cfg_subsist_sign`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($subsist_day) {
			
    		if (empty($subsist_day)) {
    			return false;
			}


    		$detail = CfgSubsistSign::find($subsist_day);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  CfgSubsistSign::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["subsist_day"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `cfg_subsist_sign`.* FROM `cfg_subsist_sign` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `cfg_subsist_sign` WHERE 1=1";
				
			
			$sql .= " ORDER BY subsist_day DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}