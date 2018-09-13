<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\SysPlanMaterial;
use Illuminate\Support\Facades\DB;

class SysPlanMaterialModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new SysPlanMaterial();

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
				
			$obj = SysPlanMaterial::find($id);

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
			return SysPlanMaterial::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `sys_plan_material`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = SysPlanMaterial::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  SysPlanMaterial::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($plan_id = null, $material_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `sys_plan_material`.* FROM `sys_plan_material` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `sys_plan_material` WHERE 1=1";
				
			
			if (!empty($plan_id)) {
				$cond["plan_id"] = $plan_id; 

				$sql .= ' AND `sys_plan_material`.`plan_id` = :plan_id';
				$c_sql .= ' AND `sys_plan_material`.`plan_id` = :plan_id';
			}
			if (!empty($material_id)) {
				$cond["material_id"] = $material_id; 

				$sql .= ' AND `sys_plan_material`.`material_id` = :material_id';
				$c_sql .= ' AND `sys_plan_material`.`material_id` = :material_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}