<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\SysAccountSite;
use Illuminate\Support\Facades\DB;

class SysAccountSiteModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new SysAccountSite();

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
				
			$obj = SysAccountSite::find($id);

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
			return SysAccountSite::destroy($id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `sys_account_site`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($id) {
			
    		if (empty($id)) {
    			return false;
			}


    		$detail = SysAccountSite::find($id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  SysAccountSite::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($account_id = null, $site_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `sys_account_site`.* FROM `sys_account_site` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `sys_account_site` WHERE 1=1";
				
			
			if (!empty($account_id)) {
				$cond["account_id"] = $account_id; 

				$sql .= ' AND `sys_account_site`.`account_id` = :account_id';
				$c_sql .= ' AND `sys_account_site`.`account_id` = :account_id';
			}
			if (!empty($site_id)) {
				$cond["site_id"] = $site_id; 

				$sql .= ' AND `sys_account_site`.`site_id` = :site_id';
				$c_sql .= ' AND `sys_account_site`.`site_id` = :site_id';
			}
			$sql .= " ORDER BY id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}