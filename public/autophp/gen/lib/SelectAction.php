<?php
abstract class SelectAction
{
    protected function select($actionNode)
    {
    	
        if($actionNode->inputs)
        {
	        foreach ($actionNode->inputs as $param)
	        {
	        	$params .= empty($params) ? "" : ", ";
	            switch ($param['type'])
	            {
	            	case "variable":
	            		$params = "{$param['name']}";
	            		//$cond = ", ";
	            		break;
	            	case "cond":
	            		$params .= 'array $cond';
	            		$cond = ', $cond';
	            		break;
	                case "limit":
	                    $params .= '$page, $rowPerPage';
	                    $start = '$start = ($page - 1) * $rowPerPage;';
	                    $limit = 'LIMIT $start, $rowPerPage';
	                    break;
	                case "orderby":
	                    $orderby = "ORDER BY {$param['column']}";
	                    break;
	                default:
	                    break;
	            }
	        }
        }
        
        $return = $this->_return($actionNode, $cond) . ";";
        
        $sql = '$sql = "' . preg_replace('@\s@', '', $actionNode->query) . $limit . $orderby . '";';
        
        $select['params'] = '(' . $params . ')';
        $select['body']	= '
        	{
        		' . $start . '
        		' . $sql . '
        		
        		' . $return . '
    		}
        	';
        
        $action = "public function " . $actionNode['name'] . $select['params'] . $select['body'];
        return $action;
    }
    
    private function _return($actionNode, $cond)
    {
        switch ($actionNode['resultType'])
        {
            case "list":
                $return = 'return $this->_db->fetchAll($sql' . $cond . ');';
                break;
            case "row":
                $return = 'return $this->_db->fetchRow($sql' . $cond . ')';
                break;
            case "one":
                $return = 'return $this->_db->fetchOne($sql' . $cond . ')';
                break;
            default:
                break;
        }
        
        return $return;
    }
}
?>