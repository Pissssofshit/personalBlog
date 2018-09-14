<?php
require_once 'DataCollection.php';

class RegularAction
{
    private  $_tableNode;
    private  $_tableName;
    private  $_pkColumn;

	private $_isDict = false;
	private $_enableCache = false;
    
    public function __construct($tableNode)
    {
        $this->_tableNode = $tableNode;
        $this->_tableName = $tableNode['name'];
        
        foreach ($tableNode->keys->key as $key) {
    		if ($key['type'] == "pk") {
    			$this->_pkColumn = $key->column['name'];
    			break;
    		}
    	}
    	
    	if (empty($this->_pkColumn)) {
    		echo "WARNING: there is no 'PRIMARY KEY' in table '{$this->_tableName}' \n";
    	}

		$is_dict = strtolower(trim($this->_tableNode['isDict']));
    	$this->_isDict = $is_dict == "true" ? true : false;

		$enable_cache = strtolower(trim($this->_tableNode['enableCache']));
		$this->_enableCache = $enable_cache == "true" ? true : false;

    }
    
    public function insert()
    {
		if ($this->_isDict && $this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_dict";
			$cache_delete = "\$this->_cache->delete('$cache_key');";
		}


        $dcObj = new DataCollection();
        $dcObj->setMethod("insert");
		//$resutlData = $dcObj->collection($this->_tableNode);
		//
		//
		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $this->_tableName)));

        $insert = '
        public function insert(array $data) {
			' . $resutlData . '	

			$obj = new ' . $classname . '();

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
';
        
        return $insert;
    }
    
    public function update()
    {
    	if (empty($this->_pkColumn)) {
    		return;
    	}
		if ($this->_isDict && $this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_dict";
			$cache_delete = "\$this->_cache->delete('$cache_key');";
		}
		elseif ($this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_{\${$this->_pkColumn}}";
			$cache_delete = "\$this->_cache->delete(\"$cache_key\");";
		}

        $dcObj = new DataCollection();
        $dcObj->setMethod("update");
		//$resutlData = $dcObj->collection($this->_tableNode);
		
		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $this->_tableName)));
        
        $update = '
       	public function update($' . $this->_pkColumn . ', array $data) {
			' . $resutlData . '	
			$obj = ' . $classname . '::find($' . $this->_pkColumn . ');

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
';
        
        return $update;
    }
    
    public function delete()
    {
    	if (empty($this->_pkColumn)) {
    		return;
    	}
		if ($this->_isDict && $this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_dict";
			$cache_delete = "\$this->_cache->delete('$cache_key');";
		}
		elseif ($this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_{\${$this->_pkColumn}}";
			$cache_delete = "\$this->_cache->delete(\"$cache_key\");";
		}

		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $this->_tableName)));


        $delete = '
       	public function delete($' . $this->_pkColumn . ') {
			return ' . $classname . '::destroy($' . $this->_pkColumn . ');

    	}
		';
        
        return $delete;
    }
    
    public function remove()
    {
    	if (empty($this->_pkColumn)) {
    		return;
    	}
    	$enable = strtolower(trim($this->_tableNode['enableLogicalDeletion']));
    	if ( $enable == "false" || empty($enable)) {
    		return;
    	}
		if ($this->_isDict && $this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_dict";
			$cache_delete = "\$this->_cache->delete('$cache_key');";
		}
		elseif ($this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_{\${$this->_pkColumn}}";
			$cache_delete = "\$this->_cache->delete(\"$cache_key\");";
		}
        $remove = '
        	public function remove($' . $this->_pkColumn . ') {
            	$data["is_deleted"] = 1;
            	$where = $this->_db->quoteInto("' . $this->_pkColumn . ' = ?" , $' . $this->_pkColumn . ');
            
            	if($this->_db->update("' . $this->_tableName . '", $data, $where)) {
					' . $cache_delete . '
            		return $' . $this->_pkColumn . ';
    			}
    			else {
    				return false;
    			}
			}
		';
        
        return $remove;
    }
    
    public function count()
    {
        $code = '
        public function count() {
    		$sql = "SELECT count(*) FROM `'. $this->_tableName  . '`";
    			
    		return DB::select($sql);
    	}
        ';
        
        return $code;
    }
    
    public function detail() {
   		if (empty($this->_pkColumn)) {
    		return;
    	}
		$cache_key = trim($this->_tableNode['name']);
		$enable_cache = trim($this->_tableNode['enableCache']);
		if ($enable_cache == "true") {
			$cache_get = <<<EOF
				\$detail = \$this->_cache->get("{$cache_key}_{\${$this->_pkColumn}}");
				if (!empty(\$detail)) {
					return \$detail;
				}
EOF;
			$cache_set = "\$this->_cache->add(\"{$cache_key}_{\${$this->_pkColumn}}\", serialize(\$detail));";
		}

		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $this->_tableName)));

    	$code = '
    	public function detail($' . $this->_pkColumn . ') {
			' . trim($cache_get) . '
    		if (empty($' . $this->_pkColumn . ')) {
    			return false;
			}


    		$detail = ' . $classname . '::find($' . $this->_pkColumn . ');
			' . trim($cache_set) . '
			return $detail;
    	}
    	';
    	
    	return $code;
    }
    
    public function dict() {
		if (!$this->_isDict) {
			return;
		}

		if ($this->_isDict && $this->_enableCache) {
			$cache_key = trim($this->_tableNode['name']) . "_dict";
			$cache_get = "\$dict = \$this->_cache->get('$cache_key');
				if (!empty(\$dict)) {
					return unserialize(\$dict);
				}
			";

			$cache_set = "\$this->_cache->add('$cache_key', serialize(\$dict));";
		}

		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $this->_tableName)));
    	
    	$code = '
        public function dict() {
			' . $cache_get .'

			$all =  ' . $classname . '::all();

			$dict = array();
			foreach ($all as $row) {
					//$index = $row["' . $this->_pkColumn . '"];
				$row = $row->toArray();
				$index = array_shift($row);
				$dict[$index] = array_shift($row);
			}
				' . $cache_set .'
			return $dict;
    	}
';
        
        return $code;
    }
    
    public function getlist() {
    	$params = $conds = $joins = array();
		$refer_tables = array();
    	foreach ($this->_tableNode->keys->key as $key) {
			
    		if ($key['type'] == "fk") {
				$column = $key->column;
				$refer_table = "{$column['referencedTable']}";
				
				if (in_array($refer_table, $refer_tables)) {
					continue;
				}

				if ($this->_tableName == $refer_table) {
					continue;
				}
				
				array_push($refer_tables, $refer_table);
				
				
    			
    			$joins[] = " LEFT JOIN `{$column['referencedTable']}` ON `{$this->_tableName}`.`{$column['name']}` = `{$column['referencedTable']}`.`{$column['referencedColumn']}`";
    		}
    	}
		//var_dump($refer_tables);

		foreach($this->_tableNode->columns->column as $column) {
			if (empty($column['queryType']))
				continue;

			if ($column['queryType'] == "fuzzy") {
				$params[] = "\${$column['name']} = null";
				$conds[] = <<<EOF

			if (gettype(\${$column['name']})!=gettype(NULL)) {
				\$cond["{$column['name']}"] = "%\${$column['name']}%"; 

				\$sql .= ' AND `{$this->_tableName}`.`{$column['name']}` like  :{$column['name']}';
				\$c_sql .= ' AND `{$this->_tableName}`.`{$column['name']}` like :{$column['name']}';
			}
EOF;
			}
			elseif ($column['queryType'] == "range") {
				$params[] = "\${$column['name']} = array()";
				if ($column['displayType'] == "time") {
					$time_format = "\$start = strtotime(\$start);
				\$end = strlen(\$end) > 10 ? \$end : \$end . \" 23:99:99\";
				\$end = strtotime(\$end);
					";
				}

				$conds[] = <<<EOF

			if (!empty(\${$column['name']})) {
				\$start = \${$column['name']}['start'];
				\$end = \${$column['name']}['end'];


				$time_format
				if (!empty(\$start)) {
					\$cond["{$column['name']}_start"] = \$start;
					\$sql .= ' AND `{$this->_tableName}`.`{$column['name']}` > :{$column['name']}_start';
					\$c_sql .= ' AND `{$this->_tableName}`.`{$column['name']}` > :{$column['name']}_start' ;
				}

				if (!empty(\$end)) {
					\$cond["{$column['name']}_end"] = \$end;
					\$sql .= ' AND `{$this->_tableName}`.`{$column['name']}` < :{$column['name']}_end';
					\$c_sql .= ' AND `{$this->_tableName}`.`{$column['name']}` < :{$column['name']}_end';
				}
			}
EOF;
			}
			else {
				$params[] = "\${$column['name']} = null";
				$conds[] = <<<EOF

			if (gettype(\${$column['name']})!=gettype(NULL)) {
				\$cond["{$column['name']}"] = \${$column['name']}; 

				\$sql .= ' AND `{$this->_tableName}`.`{$column['name']}` = :{$column['name']}';
				\$c_sql .= ' AND `{$this->_tableName}`.`{$column['name']}` = :{$column['name']}';
			}
EOF;
			}
		}

		$params[] = "\$page = 1, \$page_size = 12";
		$joins = implode(" ", $joins);
    	$params = implode(", ", $params);
		$conds = implode("", $conds);

		$order_by = '
			$sql .= " ORDER BY ' . $this->_pkColumn . ' DESC ";
		';

    	$sql_limit = ' 
			$start = ($page - 1) * $page_size;
			$sql .= " LIMIT $start, $page_size";
		';

    	$code = '
		public function getList(' . $params . ') {
			$cond = [];
    		$sql = "SELECT `' . $this->_tableName . '`.* FROM `' . $this->_tableName . '`' . $joins . ' WHERE 1=1";
			$c_sql = "SELECT count(*) as `count` FROM `' . $this->_tableName . '`' . $joins . ' WHERE 1=1";
				
			' . $conds  . $order_by .  $sql_limit . '
			
			$list =  DB::connection($this->_connection_name)->select($sql, $cond);
			$count = DB::connection($this->_connection_name)->select($c_sql, $cond)[0];

			return array("list"=>$list, "count"=>$count->count);
    	}
    	';

		return $code;
    }

	public function getTree() {
		if ($this->_tableNode['type'] != "tree") {
			return;
		}

		foreach ($this->_tableNode->keys->key as $key) {
    		if ($key['type'] == "fk") {
    			$column = $key->column;
    			$joins[] = " LEFT JOIN `{$column['referencedTable']}` ON `{$this->_tableName}`.`{$column['name']}` = `{$column['referencedTable']}`.`{$column['referencedColumn']}`";
    		}
    	}

    	$code = '
    		public function getTree() {

				$data = $this->getList();
				if (empty($data["list"])) {
					return;
				}

				$records = $data["list"];
				foreach ($records as $record)
				{
					$tree[$record["' . $this->_pkColumn . '"]] = $record;
				}
				
				$ids = array();
				
				foreach ($records as $record)
				{
					$tree[$record["pid"]]["children"][$record["' . $this->_pkColumn . '"]] = &$tree[$record["' . $this->_pkColumn . '"]];
					
					array_push($ids, $record["module_id"]);
					
					if(!isset($root) || in_array($root, $ids))
						$root = $record["pid"];
				}

				return $tree[$root];
    		}
    	';

		return $code;
	}
}
?>
