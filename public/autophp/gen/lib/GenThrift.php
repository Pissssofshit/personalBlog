<?php

class GenThrift 
{
	private $_xml;
	private $_version;

	public function __construct($dom) {
		$this->_xml = $dom;
		$this->_version = $dom['version'];
		$this->_dst_path = "/data/projects/point/thrifts/";
		$this->_include_entities = array();
	}

	public function generate() {
		foreach ($this->_xml->table as $tableNode) {
			$entity = $this->_tableEntity($tableNode);
			$this->_save($entity, "thrifts/entity/{$this->_entityName($tableNode['name'])}.thrift");
			$this->_include_entities[] = "include '../entity/{$this->_entityName($tableNode['name'])}.thrift'";

		}

		$el = $this->_createErrorLevelEntity();
		$this->_save($el, "thrifts/entity/ErrorLevel.thrift");
		$this->_include_entities[] = "include '../entity/Errorlevel.thrift'";

		$ex = $this->_createException();
		$name = $this->_entityName($this->_xml['name']);
		$this->_save($ex, "thrifts/exception/{$name}ServiceException.thrift");
		$this->_include_entities[] = "include '../exception/{$name}ServiceException.thrift'";

		$se = $this->_createService();
		$this->_save($se, "thrifts/service/{$this->_entityName($this->_xml['name'])}Service.thrift");

		$composer_json = $this->_createComposerJson();
		$this->_save($composer_json, "composer.json");

		$git_init = $this->_createGitInit();
		$this->_save($git_init, "git_init.sh");


		exec("cd {$this->_dst_path}/nova-{$this->_xml['name']}/thrifts/ &&  ../../autophp/tool/zan-thrift-linux 2>&1");


		return true;
	}


	private function _createGitInit() {
		$name = $this->_xml['name'];
		$text = <<<EOF
echo "git_init.sh" > .gitignore
git init
git remote add origin https://gitlab.mjutech.com/nova-service/nova-{$name}.git
git add .
git commit -m "Initial commit"
git push -u origin master

EOF;

		return $text;
	}


	private function _createComposerJson() {
		$json = array();
		$name = $this->_xml['name'];
		$namespace = str_replace(".", " ", $this->_xml['namespace']);
		$namespace = str_replace(" ", '\\\\', ucwords($namespace));
		$namespace .= "\\\\";
		$json['name'] = "nova-service/nova-{$name}";
		$json['repositories'] = array();
		$json['require'] = array("packaged/thrift"=>"0.9.2.1");
		$json['autoload'] = array("psr-4"=>array("$namespace"=>"sdk/gen-php"), "classmap"=>array());
		$json['minimum-stability'] = "dev";

		$text = $this->_jsonFormat(stripslashes(json_encode($json)));

		return $text;
	}

	private function _entityName($tablename) {
		$name = str_replace("_", " ", $tablename);
		$name = str_replace(" ", "", ucwords($name));

		return $name;
	
	}

	private function _createErrorLevelEntity()
	{
		$namespace = $this->_xml['namespace'];

		$text = "namespace nova {$namespace}.entity

enum ErrorLevel {
    DEBUG = 1,
    INFO = 2,
    WARN = 3,
    ERROR = 4
}
";

		return $text;
	
	}

	private function _createException()
	{
		$namespace = $this->_xml['namespace'];
		$name = $this->_entityName($this->_xml['name']);
		$text = "namespace nova {$namespace}.exception


exception {$name}ServiceException {
	1: string message,
	2: i32 code
		
}";


		return $text;

	
	}

	private function _createService() {
		$namespace = $this->_xml['namespace'];
		$name = $this->_entityName($this->_xml['name']);
		$include_entities = implode("\n", $this->_include_entities);
		$text = "namespace nova {$namespace}.service

{$include_entities}

service {$name}Service {\n";

		$text .=  " string hello();"; //构造service方法

		$text .= "}";

		return $text;

		
	}

	private function _tableEntity($tableNode) {
		$namespace = $this->_xml['namespace'];
		$name = $this->_entityName($tableNode['name']);
		$text = "namespace nova {$namespace}.entity

include 'ErrorLevel.thrift'

struct {$name} {\n";

		$text .=  $this->_columnEntities($tableNode);

		$text .= "}";

		return $text;
	
	}

	private function _columnEntities($tableNode) {
		foreach ($tableNode->columns->column as  $column) {
			$text .= "\t" . ++$i . ":" . $this->_columnEntity($column);
		}
		$text .= "\t" . ++$i . ":optional ErrorLevel.ErrorLevel errorLevel\n";

		return $text;
	}

	private function _columnEntity($columnNode) {
		$isNull = $columnNode['nullable'] == "true"? "optional" : "required";
		if (preg_match("/bool/", $columnNode['type'])) {
			$type = "bool";
		}
		elseif (preg_match("/bigint/", $columnNode['type'])) {
			$type = "i64";
		}
		elseif (preg_match("/tinyint/", $columnNode['type'])) {
			$type = "i16";
		}
		elseif (preg_match("/int/", $columnNode['type'])) {
			$type = "i32";
		}
		elseif (preg_match("/char|text/", $columnNode['type'])) {
			$type = "string";
		}
		elseif (preg_match("/float|double/", $columnNode['type'])) {
			$type = "double";
		}

		$text = "$isNull $type ${columnNode['name']}, \n";

		return $text;
	}

		public function setDstPath($path) {
            $this->_dst_path = dirname($path);
        }

        public function setSrcPath($path) {
        	$this->_src_path = $path;
        }
        
        private function _save($file_content, $file_name) {
        	if (empty($this->_dst_path)) {
        		die("DST_PATH must setting");
        	}
        	
			$path = $this->_dst_path . "/nova-" . $this->_xml['name'] . "/";
			if (!file_exists($path)) {
        		echo("DST_PATH is not exist! create dir: $path \n");
				exec("mkdir -p $path");
        	}
        	
			$file_path = $path . $file_name;
			$dir_path = dirname($file_path); 
			if (!file_exists($dir_path)) {
				echo "create path: $file_path";	
				exec("mkdir -p $dir_path");
			}
		
        	if (!$fh = fopen($file_path, "w")) {
        		die("ERROR: Open file '$file_path' failed \n");
        	}
        	
        	if(fwrite($fh, $file_content) === FALSE){
                die("ERROR: Write file '$file_path' failed \n");
            }
            
            fclose($fh);
		}


		private function _jsonFormat($json, $indent=null){  
			   $tabcount = 0;
    $result = '';
    $inquote = false;
    $ignorenext = false;
    if ($html) {
      $tab = "   ";
      $newline = "<br/>";
    } else {
      $tab = "\t";
      $newline = "\n";
    }
    for($i = 0; $i < strlen($json); $i++) {
      $char = $json[$i];
      if ($ignorenext) {
        $result .= $char;
        $ignorenext = false;
      } else {
        switch($char) {
          case '{':
            $tabcount++;
            $result .= $char . $newline . str_repeat($tab, $tabcount);
            break;
          case '}':
            $tabcount--;
            $result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char;
            break;
          case ',':
            $result .= $char . $newline . str_repeat($tab, $tabcount);
            break;
          case '"':
            $inquote = !$inquote;
            $result .= $char;
            break;
          case '\\':
            if ($inquote) $ignorenext = true;
            $result .= $char;
            break;
          default:
            $result .= $char;
        }
      }
    }
    return $result;
  
	} 
}
