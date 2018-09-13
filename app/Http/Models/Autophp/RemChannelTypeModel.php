<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemChannelType;
use Illuminate\Support\Facades\DB;

class RemChannelTypeModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemChannelType();

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
				
			$obj = RemChannelType::find($id);

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
			return RemChannelType::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_channel_type`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = RemChannelType::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemChannelType::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($name = null, $state = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_channel_type`.* FROM `rem_channel_type` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_channel_type` WHERE 1=1";
				
			
			if (!empty($name)) {
				$cond["name"] = "%$name%"; 

				$sql .= ' AND `rem_channel_type`.`name` like  :name';
				$c_sql .= ' AND `rem_channel_type`.`name` like :name';
			}
			if (!empty($state)) {
				$cond["state"] = $state; 

				$sql .= ' AND `rem_channel_type`.`state` = :state';
				$c_sql .= ' AND `rem_channel_type`.`state` = :state';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}