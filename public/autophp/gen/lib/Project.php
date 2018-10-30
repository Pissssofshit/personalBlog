<?php
    require_once 'ModelClass.php';
	require_once 'ControllerClass.php';
	require_once 'GenSchema.php';
	require_once 'GenConfig.php';
	require_once 'Layout.php';
	require_once 'Server.php';
	require_once 'GenThrift.php';
    
    class Project
    {
    	private $_dst_path;
        private $_dom;
		private $_version;
        
        public function __construct($tableXmlPath) {
            if(file_exists($tableXmlPath)) {
                $this->_dom = new SimpleXMLElement($tableXmlPath, NULL, TRUE);
				$this->_version = $this->_dom['version'];
			}
            else 
                die("can't read configure file : $tableXmlPath");
		}


		public function getName() {
			return $this->_dom['name'];
		}
		
		public function server($domain, $http_server, $server_path, $web_path) {
			$server = new Server($domain, $web_path);
			$server->$http_server($server_path);
			
			return true;
		}


		public function tables() {
			foreach ($this->_dom->table as $tableNode) {
				
				if (trim($tableNode['version']) == trim($this->_version)) {
					$tables[] = $tableNode['name'];
				}
			}
			return $tables;
		}
        
        public function gen(){
			//$this->_thrift();
			//$this->_schema();
			//$this->_config();

            foreach ($this->_dom->table as $tableNode) {
          		$this->_controller($tableNode);
				$this->_model($tableNode);
				//$this->_view($tableNode);
            }
            
            return true;
		}

		public function _thrift() {
			$thrift = new GenThrift($this->_dom);
			$thrift->setDstPath($this->_dst_path);
			$code = $thrift->generate();
		}



		private function _schema() {
			$schema = new GenSchema($this->_dom);
			$code = $schema->createTable();
			$this->_save($code, "/database/autophp/schema{$this->_version}.sql");

			$code = $schema->createRelationship();
			$this->_save($code, "/database/autophp/relationship{$this->_version}.sql");
		}

			

		private function _config() {
			$config = new GenConfig($this->_dom);
			$code = $config->code();
			$this->_save($code, "/.env");

			$route = $this->_route();
			$this->_save($route, "/routes/autophp.php");

			$menu = $this->_indexmenu();
			$this->_save($menu, "/app/Http/Controllers/Autophp/IndexController.php");

			
            $menu = $this->_constmenu();
			$this->_save($menu, "/config/const.php");
			
			/*
			$tree_code = $config->admin();
			//var_dump($tree_code);

			ob_start();
			var_export($tree_code['bar_tree']);
			$bar_config = ob_get_contents();
			ob_end_clean();

			$config = "<?php
\$CONFIG_ADMIN['bar_tree']={$bar_config};";
			$this->_save($config, "/Configs/admin.navi.php");

			ob_start();
			var_export($tree_code['power_tree']);
			$power_config = ob_get_contents();
			ob_end_clean();

			$config = "<?php
\$CONFIG_ADMIN['power_tree']={$power_config};";
$this->_save($config, "/Configs/admin.power.php");
			*/
		}

		private function _route() {
			$resources = ["\tRoute::get('/', 'IndexController@index');", "\tRoute::get('/welcome', 'IndexController@welcome');", "\t"];

			foreach ($this->_dom->table as $tableNode) {
				$tablename = $tableNode['name'];
				$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tablename)));
                $resources[] = "\tRoute::get('/{$tablename}/export', '{$classname}Controller@export');";
				$resources[] = "\tRoute::resource('/{$tablename}', '{$classname}Controller');";
				$resources[] = "";
			}

			$resources = implode("\n", $resources);

			$route = <<<EOF
<?php 
Route::group(['namespace'=>'Autophp', 'prefix'=>'autophp'], function(){
$resources
});
EOF;
			return $route;
		}

		public function _setviewpath(){
            $code = <<<EOF
			<?php
			return [
				'paths' => [
					resource_path('views/autophp'),
				],
				'compiled' => realpath(storage_path('framework/views')),
			];
EOF;
            return $code;
		}

		private function _constmenu() {
			foreach ($this->_dom->table as $tableNode) {
				$tablename = $tableNode['name'];
				$groupname = $tableNode['group'];
				$groupkey = md5($groupname);
				$resources[$groupkey]["sub"][] = ["url" => "/autophp/{$tableNode['name']}", "name"=>"{$tableNode['comment']}", "privilege"=>true];
				$resources[$groupkey]['name'] = "$groupname";
				$resources[$groupkey]['privilege'] = true;
			}

			$menu = var_export($resources, true);

			$route = <<<EOF
<?php

return [
	"menu" => $menu,
];

EOF;
			return $route;
		}

        private function _indexmenu() {
            foreach ($this->_dom->table as $tableNode) {
                $tablename = $tableNode['name'];
                $groupname = $tableNode['group'];
                $groupkey = md5($groupname);
                $resources[$groupkey]["sub"][] = ["url" => "/autophp/{$tableNode['name']}", "name"=>"{$tableNode['comment']}", "privilege"=>true];
                $resources[$groupkey]['name'] = "$groupname";
                $resources[$groupkey]['privilege'] = true;
            }

            $resources = json_encode($resources);

            $route = <<<EOF
<?php
namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {
	public function __construct() {
        parent::__construct();
	}

	public function index() {
		return view("autophp.common.index");
	}

	public function welcome() {
		return "Welcome to autopp test framework!";
	}
}

EOF;
            return $route;
        }


		private function _controller($tableNode) {
			$controller = new ControllerClass();
			$code = $controller->code($tableNode);
			$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));
			$this->_save($code, "/app/Http/Controllers/Autophp/{$classname}Controller.php");

			return true;
		}

		private function _model($tableNode) {
			$model = new ModelClass();
			$db_name = $this->_dom['name'];
			$code = $model->db_model($tableNode, $db_name);
			$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));
			$this->_save($code, "/app/Database/Models/{$classname}.php");
			
			$code = $model->code($tableNode, $db_name);
			$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));
			$this->_save($code, "/app/Http/Models/Autophp/{$classname}Model.php");

			return true;
		}

		private function _view($tableNode) {
			$view_path = $this->_dst_path . "/resources/views/autophp";
			$view = new ViewFile($view_path);
			$view->code($tableNode);
		}

		public function test() {
			foreach ($this->_dom->table as $tableNode) {
          		$content = new Content($tableNode);
			
				echo $content->_list();
				echo $content->_add();
				exit();
            }
		}

		public function partgen($table_names, $modules) {
			$tableNodes = array();
			foreach ($table_names as $table_name) {
				foreach ($this->_dom->table as $tableNode) {
					if ($table_name == $tableNode['name']) {
						$tableNodes[] = $tableNode;
					}
				}
			}

			//$this->_thrift();

			if (in_array("schema", $modules)){
				$this->_schema();
				$this->_config();
			}

			foreach ($tableNodes as $tableNode) {
				if (in_array("controller", $modules)) {
					$this->_controller($tableNode);
				}
				if (in_array("model", $modules)) {
					$this->_model($tableNode);
				}
				if (in_array("view", $modules)) {
					$this->_view($tableNode);
				}
			}
			
			return true;
		}

		public function importdb($username = "root", $password = "", $host = "localhost", $with_relation = false) {
			$schema_file = $this->_dst_path . "/database/autophp/schema.sql";
			$relationship_file = $this->_dst_path . "/database/autophp/relationship.sql";
			
			if (!empty($password)) {
				$password = "-p{$password}";
			}
			$cmd = "/usr/local/mysql/bin/mysql -u{$username} {$password} -h{$host}< $schema_file";
			echo $cmd;
			echo exec($cmd, $out);
			
			
			if ($with_relation) {
				$cmd = "/usr/local/mysql/bin/mysql -u{$username} {$password} -h{$host}< $relationship_file";
				echo exec($cmd, $out);
			}

			return true;
		}

		public function setDstPath($path) {
            $this->_dst_path = $path;
        }

        public function setSrcPath($path) {
        	$this->_src_path = $path;
        }
        
        private function _save($file_content, $file_name) {
        	if (empty($this->_dst_path)) {
        		die("DST_PATH must setting");
        	}
        	
			$path = $this->_dst_path;
			if (!file_exists($path)) {

				die("DST_PATH is not exist! \n");
        	}
        	
			$file_path = $path . $file_name;

			$dir = dirname($file_path);
			if (!file_exists($dir)) {
				echo "Create dir: $dir";
				shell_exec("mkdir -p $dir 2>&1");
			}
        	if (!$fh = fopen($file_path, "w")) {
        		die("ERROR: Open file '$file_path' failed \n");
        	}
        	
        	if(fwrite($fh, $file_content) === FALSE){
                die("ERROR: Write file '$file_path' failed \n");
            }
            
            fclose($fh);
        }
    }
?>
