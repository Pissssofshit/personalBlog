<?php
require_once 'SelectAction.php';
require_once 'RegularAction.php';

class ModelClass extends SelectAction
{
    protected $_src_path;

    public function code($tableNode, $db_name)
    {
    	$model_file = $this->_src_path . $tableNode['name'] . ".xml";
    	if(file_exists($model_file)){
            $m_dom = new SimpleXMLElement($model_file, NULL, TRUE);
        }
        else {
        	$this->_m_dom = null;
        } 
    	
       //$className = self::UCWords($tableNode['name']);
		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));
		
		$enable_cache = strtolower(trim($tableNode['enableCache']));

		if ($enable_cache == "true") {
			$cache_init = "global \$_CONFIG;
			\$this->_cache = new Cache_Memcache(\$_CONFIG['cache']);";
		}

		$model = <<<EOF
<?php
namespace App\Http\Models\Autophp;

use App\Database\Models\\{$classname};
use Illuminate\Support\Facades\DB;

class {$classname}Model
{
	protected \$_connection_name = "$db_name";

	{$this->_regularAction($tableNode)}
	{$this->_xmlAction($m_dom)}
}
EOF;
       
       return $model;
	}


	public function db_model($tableNode, $db_name) {

		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));
		 foreach ($tableNode->keys->key as $key) {
    		if ($key['type'] == "pk") {
    			$pk = $key->column['name'];
    			break;
    		}
    	}
	
		$model = <<<EOF
<?php


namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

class {$classname} extends Model
{
	protected \$connection = "$db_name";
	protected \$table = "{$tableNode['name']}";
	public \$timestamps = false;
	//public \$incrementing = false;
	public \$primaryKey = "{$pk}";
	
}
EOF;
       
       return $model;
	}


	




    
    private function _xmlAction($m_dom)
    {
    	if(!$m_dom)
    		return;
    		
        foreach ($m_dom->action as $action)
        {
            if($action['mode'] == "select")
                $xmlAction .= $this->_viewAction($action);
            
            if($action['mode'] == "custom")
                $xmlAction .= $this->_customAction($action);
        }
        
        return $xmlAction;
    }
    
    private function _viewAction($actionNode)
    {
        return $this->select($actionNode);
    }
    
    private function _customAction()
    {
        
    }
    
    private function _regularAction($tableNode)
    {
        $raObj = new RegularAction($tableNode);
        $methods = get_class_methods($raObj);
        
        foreach ($methods as $method) {
            if($method != "__construct")
                $regularActions .= $raObj->$method();
        }
        
        return $regularActions;
    }
    
    
    public static function UCWords($tableName)
    {
        $tableName = str_replace("_", " ", $tableName);
        $tableName = ucwords($tableName);
        $tableName = str_replace(" ", "", $tableName);
            
        return $tableName;
    }
}
?>
