<?php
    class DataCollection
    {
        private $_table_xml;
        private $_method;
        
        
        public function GenerateParams($tableName, $tableXmlPath)
        {
            if (!empty($tableName))
            	die("TableName should not be null! \n");
            
            if(file_exists($tableXmlPath))
                $this->_table_xml = new SimpleXMLElement($tableXmlPath, NULL, TRUE);
            
            $tableNode = $this->_searchTableNode($tableName);
            
            return $this->dataCollection($tableNode);
        }
        
        
        public function setMethod($method)
        {
            $this->_method = $method;
        }
        
        public  function collection($tableNode)
        {
            $paramsOption = $this->_toParamsString($this->_getParams($tableNode));
            
            $dataCollection = '
            	$paramOptions = ' . $paramsOption . ";";
            
			if ($this->_method == "update") {
				$dataCollection .= '
				$paramOptions = array_intersect_key($paramOptions, $data);';
			}
            
			$dataCollection .= '
                $data = APP_DataFilter::filter($paramOptions, $data);
            ';
            /*
            if($tableNode['enableUpdateTracking'] == "true")
                $dataCollection .= $this->_updateTracking();
            */
            return $dataCollection;
        }
        
        private function _getParams($tableNode)
        {
            foreach ($tableNode->columns->column as $column)
            {
				if ($column['extra'] == "auto_increment") {
					continue;
				}
                foreach ($column->attributes() as $key => $value)
                {
                    $columns["{$column['name']}"]["$key"] = "$value";
                }
            }
            
            return $columns;
        }
        
        
        private  function _searchTableNode($tableName)
        {
            foreach ($this->_table_xml->table as $table)
            {
                if("{$table['name']}" == $tableName)
                {
                    return $table;
                }
            }
        }
        
        private function _paramValidateFormat($column)
        {
            foreach ($column as $key => $value)
            {
                switch ($key)
                {
                    case "name":
                        $column['alt'] = $column['name'];
                        break;
                    case "type":
                        $typeLen = (array)$this->_typeLen($value);
                        foreach ($typeLen as $key => $value)
                        {
                            if(!isset($column['format']))
                                $column["$key"] = $value;
                        }
                        break;
                    case "nullable":
                        $column['required'] = $value == "false" ? "true" : "false";
                        unset($column["nullable"]);
                        break;
                    case "default":
                        break;
                    case "format":
                        $format = $this->_format($column['format']);
                        foreach ($format as $key => $value)
                        {
                            $column["$key"] = $value;
                        }
                        unset($column['format']);
                        break;
                    default:
                        unset($column["$key"]);
                        break;
                }
            }
            
            return $column; 
        }
        
        private function _format($format)
        {
            
            list($type, $else) = explode("(", $format, 2);
            if(!empty($else))
            {
                list($minString, $maxString) = explode(",", $else, 2);
                list($minName, $minValue) = explode("=", $minString);
                list($maxName, $maxValue) = explode("=", $maxString);
                $params['min'] = trim($minValue) ;
                $params['max'] = trim(str_replace(")", "", $maxValue));
            }
            $params['type'] = $type;
            
            return $params;
            
        }
        
        private function _typeLen($typeLen)
        {
            list($type, $else) = explode("(", $typeLen);
            list($lenght) = explode(")", $else);
            
			if (preg_match("/int/", $type)) {
				$param['type'] = "int";
				$param['min'] = 0;

				if ($lenght <= 10) {
				$param['max'] = pow(10, $lenght) - 1;
				}
			}
			elseif (preg_match("/float/", $type)) {
				$param['type'] = "float";
				$param['min'] = 0;
				$param['max'] = pow(10, $lenght) - 1;
			}
			else {
				$param['type'] = "text";
				$lenght = empty($lenght) ? 16777215 : $lenght;
                $param['max'] = $lenght;
				$param['min'] = 0;
			}
            
            return $param;
        }
        
        private function _toParamsString($params)
        {
            $paramsString = 'array(';
            foreach ($params as $columnName => $param)
            {  
                $param = $this->_paramValidateFormat($param);
                    
                $paramsString .= "'$columnName' => array(";
                
                foreach ($param as $key => $value)
                {
					if ($key == "required") {
						$paramsString .= "'$key' => $value, ";
					}
					else {
						$paramsString .= "'$key' => '$value', ";
					}
                }
                
                $paramsString .= "),
                	";
            }
            $paramsString .= ")";
            
            return $paramsString;
        }
        

        private function _updateTracking()
        {
            switch ($this->_method)
            {
                case "insert":
                    $trunkingCode = '
					$data["created_time"] = $this->_time;
					$data["updated_time"] = $this->_time;
					$data["created_by"] = $this->_user;
					$data["updated_by"] = $this->_user;
					';
                    break;
                case "update":
                    $trunkingCode = '
					$data["updated_time"] = $this->_time;
					$data["updated_by"] = $this->_user;
					';
                    break;
                default:
                    break;
            }
            return $trunkingCode;
        }
    }
?>