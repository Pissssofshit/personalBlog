<?php
class GenSchema
{
    private $_xml;
	private $_version;
    public function __construct($dom)
    {
		$this->_xml = $dom;
		$this->_version = $dom['version'];
    }
    
    public function createTable()
    {
        return $this->_createDataBase();
    }
    
    public function createRelationship() 
    {
    	return  $this->_createConstraints();
    }
     
    private function _createDataBase()
    {
        $dbname = $this->_xml['name'];
		$dbuser = $this->_xml['user'];
		$dbpass = $this->_xml['password'];
		$allow_hosts = $this->_xml['hosts'];
		$allow_hosts = empty($allow_hosts) ? "%" : $allow_hosts;

		if (empty($this->_version)) {
        $text = "DROP DATABASE IF EXISTS `$dbname`;
CREATE DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

GRANT all ON $dbname.* TO '$dbuser'@'$allow_hosts' IDENTIFIED BY '$dbpass';

USE `$dbname`;";
		}
		else {
			$text = "USE `$dbname`;";
		}
        $text .= $this->_createTables();

        return $text;
    }
    
    private function _createTables()
    {
        foreach ($this->_xml->table as $table)
        {
			if (trim($table['version']) == trim($this->_version)) {
				$text .= $this->_createTable($table);
			}
        }
        
        return $text;
    }
    
    private function _createConstraints()
    {
        foreach ($this->_xml->table as $table)
        {
			if (trim($table['version']) == trim($this->_version)) {
				$constraints .= $this->_createConstraint($table);
			}
        }
        
        return $constraints;
    }
    
    private function _createConstraint($tableNode)
    {
    	if(!$tableNode->keys)
    		return ;
    	foreach ($tableNode->keys->key as $key)
    	{
    		if ($key['type'] == "fk") {
    			$reference = $key->column;
    			$constraint .= "
ALTER TABLE `{$tableNode['name']}`
  ADD CONSTRAINT `{$key["name"]}` FOREIGN KEY (`{$reference["name"]}`) REFERENCES `{$reference["referencedTable"]}` (`{$reference["referencedColumn"]}`);
			  ";
    		}
    	}
    	
    	return $constraint;
    }
    
    private function _createTable($tableNode)
    {
        
        $auto_increment = $tableNode['autoIncrementStartFrom'] > 0 ? "AUTO_INCREMENT={$tableNode['autoIncrementStartFrom']}" : "";
        $text = "

DROP TABLE IF EXISTS `{$tableNode['name']}`;
CREATE TABLE `{$tableNode['name']}` (";

        $text .= $this->_createColumns($tableNode);

        $text .= $this->_createKeys($tableNode);

        $text .= "
)ENGINE={$tableNode['engine']} DEFAULT CHARSET={$tableNode['charset']} COMMENT='{$tableNode['comment']}' $auto_increment;";

        return $text;        
    }
    
    private function _createColumns($tableNode)
    {
        foreach ($tableNode->columns->column as $column)
        {
            $text .= empty($text)? "" : ",";
            $text .= $this->_createColumn($column);
        }
        
        if($tableNode['enableUpdateTracking'] == "true")
        {
            $text .= empty($text)? "" : ",";
            $text .= "
    `is_deleted` bool NOT NULL default 0";
        }
        
		/*
        if($tableNode['enableUpdateTracking'] == "true")
        {
            $text .= empty($text)? "" : ",";
            $text .= "
    `created_time` int(10) NOT NULL,
    `updated_time` int(10) NOT NULL,
    `created_by` int(10) NOT NULL,
    `updated_by` int(10) NOT NULL";
        }*/
        
        return $text;
    }
    
    
    private function _createColumn($columnNode)
    {
        $isNull = $columnNode['nullable'] == "true"? "" : "NOT NULL";
		$default = (!isset($columnNode['default'])) ? "" : "default '{$columnNode['default']}'";
		$comment = "comment '{$columnNode['displayName']}'";
        $text = "
    `{$columnNode['name']}` {$columnNode['type']} {$isNull} {$default} {$columnNode['extra']} {$comment}";
        
        return $text;
    }
    
    private function _createKeys($tableNode)
    {
        foreach ($tableNode->keys->key as $key)
        {
            $keys .=  ", ";
            switch ($key['type'])
            {
                case "pk":
                    $keys .= $this->_createPK($key);
                    break;
                case "fk":
                	$keys .= $this->_createAK($key);
                	break;
                case "uk":
                    $keys .= $this->_createUK($key);
                    break;
                case "ak":
                    $keys .= $this->_createAK($key);
                    break;
                default:
                    break;
            }
        }
        
        return $keys;
    }
    
    private function _createPK($key)
    {
        foreach ($key->column as $column)
        {
            $columns .= empty($columns) ?  "`{$column['name']}`" : ", `{$column['name']}`" ;
        }
        
        $text = "
    PRIMARY KEY  ($columns)";
        
        return $text;
    }
    
    private function _createUK($key)
    {
        foreach ($key->column as $column)
        {
            $columns .= empty($columns) ?  "`{$column['name']}`" : ", `{$column['name']}`" ;
        }
        
        $text = "
    UNIQUE KEY {$key['name']}($columns)";
        
        return $text;
    }
    
    private function _createAK($key)
    {
        foreach ($key->column as $column)
        {
            $columns .= empty($columns) ?  "`{$column['name']}`" : ", `{$column['name']}`" ;
        }
        
        $text = "
    KEY {$key['name']}($columns)";
        
        return $text;
    }
    
    
}
?>