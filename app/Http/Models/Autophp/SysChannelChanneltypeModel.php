<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\SysChannelChanneltype;
use Illuminate\Support\Facades\DB;

class SysChannelChanneltypeModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new SysChannelChanneltype();

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function update($id, array $data) {
				
			$obj = SysChannelChanneltype::find($id);

			foreach ($data as $key=>$value) {
				$obj->$key=$value;
			}

			$ret = $obj->save();

			return $ret;	
    	}

       	public function delete($id) {
			return SysChannelChanneltype::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `sys_channel_channeltype`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = SysChannelChanneltype::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  SysChannelChanneltype::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($channel_id = null, $channel_type_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `sys_channel_channeltype`.* FROM `sys_channel_channeltype` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `sys_channel_channeltype` WHERE 1=1";
				
			
			if (!empty($channel_id)) {
				$cond["channel_id"] = $channel_id; 

				$sql .= ' AND `sys_channel_channeltype`.`channel_id` = :channel_id';
				$c_sql .= ' AND `sys_channel_channeltype`.`channel_id` = :channel_id';
			}
			if (!empty($channel_type_id)) {
				$cond["channel_type_id"] = $channel_type_id; 

				$sql .= ' AND `sys_channel_channeltype`.`channel_type_id` = :channel_type_id';
				$c_sql .= ' AND `sys_channel_channeltype`.`channel_type_id` = :channel_type_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}