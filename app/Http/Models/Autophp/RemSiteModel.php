<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemSite;
use Illuminate\Support\Facades\DB;

class RemSiteModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemSite();

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

       	public function update($site_id, array $data) {
				
			$obj = RemSite::find($site_id);

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

       	public function delete($site_id) {
			return RemSite::destroy($site_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_site`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($site_id) {
			
    		if (empty($site_id)) {
    			return false;
			}


    		$detail = RemSite::find($site_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemSite::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["site_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($channel_id = null, $site_name = null, $state = null, $category_id = null, $pay_way_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_site`.* FROM `rem_site` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_site` WHERE 1=1";
				
			
			if (!empty($channel_id)) {
				$cond["channel_id"] = $channel_id; 

				$sql .= ' AND `rem_site`.`channel_id` = :channel_id';
				$c_sql .= ' AND `rem_site`.`channel_id` = :channel_id';
			}
			if (!empty($site_name)) {
				$cond["site_name"] = "%$site_name%"; 

				$sql .= ' AND `rem_site`.`site_name` like  :site_name';
				$c_sql .= ' AND `rem_site`.`site_name` like :site_name';
			}
			if (!empty($state)) {
				$cond["state"] = $state; 

				$sql .= ' AND `rem_site`.`state` = :state';
				$c_sql .= ' AND `rem_site`.`state` = :state';
			}
			if (!empty($category_id)) {
				$cond["category_id"] = $category_id; 

				$sql .= ' AND `rem_site`.`category_id` = :category_id';
				$c_sql .= ' AND `rem_site`.`category_id` = :category_id';
			}
			if (!empty($pay_way_id)) {
				$cond["pay_way_id"] = $pay_way_id; 

				$sql .= ' AND `rem_site`.`pay_way_id` = :pay_way_id';
				$c_sql .= ' AND `rem_site`.`pay_way_id` = :pay_way_id';
			}
			$sql .= " ORDER BY site_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}