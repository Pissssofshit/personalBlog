<?php
    require_once 'ModelClass.php';
    
    class GenModel extends  ModelClass
    {
    	private $_dst_path;
        private $_dom;
        
        public function __construct($tableXmlPath) {
            if(file_exists($tableXmlPath))
                $this->_dom = new SimpleXMLElement($tableXmlPath, NULL, TRUE);
            else 
                die("can't read configure file!");
        }
        
        public function generate(){
            $db_name = $this->_dom['name'];
            foreach ($this->_dom->table as $tableNode) {
          		$model = $this->model($tableNode, $db_name);
                $this->_save($model, $tableNode['name']);
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
        	
        	$file_path = $path . $file_name . ".php";
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