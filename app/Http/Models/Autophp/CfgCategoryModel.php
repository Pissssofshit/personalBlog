<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\CfgCategory;
use Illuminate\Support\Facades\DB;

class CfgCategoryModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new CfgCategory();

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

       	public function update($category_id, array $data) {
				
			$obj = CfgCategory::find($category_id);

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

       	public function delete($category_id) {
			return CfgCategory::destroy($category_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `cfg_category`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($category_id) {
			
    		if (empty($category_id)) {
    			return false;
			}


    		$detail = CfgCategory::find($category_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  CfgCategory::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["category_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($category_name = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `cfg_category`.* FROM `cfg_category` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `cfg_category` WHERE 1=1";
				
			
			if (!empty($category_name)) {
				$cond["category_name"] = "%$category_name%"; 

				$sql .= ' AND `cfg_category`.`category_name` like  :category_name';
				$c_sql .= ' AND `cfg_category`.`category_name` like :category_name';
			}
			$sql .= " ORDER BY category_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}