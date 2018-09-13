<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\RemAccount;
use Illuminate\Support\Facades\DB;

class RemAccountModel
{
	protected $_connection_name = "pop";

	
        public function insert(array $data) {
				

			$obj = new RemAccount();

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

       	public function update($account_id, array $data) {
				
			$obj = RemAccount::find($account_id);

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

       	public function delete($account_id) {
			return RemAccount::destroy($account_id);

    	}
		
        public function count() {
    		$sql = "SELECT count(*) FROM `rem_account`";
    			
    		return DB::select($sql);
    	}
        
    	public function detail($account_id) {
			
    		if (empty($account_id)) {
    			return false;
			}


    		$detail = RemAccount::find($account_id);
			
			return $detail;
    	}
    	
        public function dict() {
			

			$all =  RemAccount::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["account_id"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				
			return $dict;
    	}

		public function getList($account_name = null, $company_id = null, $page = 1, $page_size = 12) {
			$cond = [];
    		$sql = "SELECT `rem_account`.* FROM `rem_account` WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `rem_account` WHERE 1=1";
				
			
			if (!empty($account_name)) {
				$cond["account_name"] = "%$account_name%"; 

				$sql .= ' AND `rem_account`.`account_name` like  :account_name';
				$c_sql .= ' AND `rem_account`.`account_name` like :account_name';
			}
			if (!empty($company_id)) {
				$cond["company_id"] = $company_id; 

				$sql .= ' AND `rem_account`.`company_id` = :company_id';
				$c_sql .= ' AND `rem_account`.`company_id` = :company_id';
			}
			$sql .= " ORDER BY account_id DESC ";
		 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	
	
}