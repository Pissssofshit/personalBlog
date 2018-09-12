<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemChannel;
use Illuminate\Support\Facades\DB;

class RemChannelModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemChannel();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($channel_id, array $data) {
				
			$obj = RemChannel::find($channel_id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($channel_id) {
			return RemChannel::destroy($channel_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_channel`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($channel_id) {
			
    		if (empty($channel_id)) {
    			return false;
			}


    		$detail = RemChannel::find($channel_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemChannel::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["channel_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($channel_name = null, $category_id = null, $state = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_channel`.* FROM `rem_channel` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_channel` WHERE 1=1";
				
			
			if (!empty($channel_name)) {
				$cond["channel_name"] = "%$channel_name%"; 

				$sql .= ' AND `rem_channel`.`channel_name` like  :channel_name';
				$c_sql .= ' AND `rem_channel`.`channel_name` like :channel_name';
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `rem_channel`.`category_id` = :category_id';
				$c_sql .= ' AND `rem_channel`.`category_id` = :category_id';
			}
			if (!empty($state)) {
				$cond["state"] = $state; 

				$sql .= ' AND `rem_channel`.`state` = :state';
				$c_sql .= ' AND `rem_channel`.`state` = :state';
			}
			$sql .= " ORDER BY channel_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}