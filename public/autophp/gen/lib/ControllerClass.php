<?php

class ControllerClass {
	private $_tableNode;
	private $_tableName;
	private $_dir;
	private $_autophpviewdir;

	public function __construct($dir = ""){
		if ($dir) {
			$this->_dir = "{$dir}/";
			$this->_pre = ucfirst($dir) . ".";
		}
		$this->_autophpviewdir = "autophp.";
	}


	public function code($tableNode) {
		$this->_tableNode = $tableNode;
		$this->_tableName = $tableNode['name'];

		$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $tableNode['name'])));

		foreach($this->_tableNode->keys->key as $key) {
			if ($key['type'] == "pk") {
				$this->_pk = $key->column[0]["name"];
			}
		}

		$code = <<<EOF
<?php

namespace App\Http\Controllers\Autophp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Http\Models\Autophp\\{$classname}Model;
use App\Library\Pager;
use App\Library\Utils;

class {$classname}Controller extends Controller {
	private \$_tpl;
	private \$_m_{$this->_tableName};
	public function __construct() {
		\$this->_m_{$this->_tableName} = new {$classname}Model();
		parent::__construct();
	}

	{$this->_index()}

	{$this->_list()}
	{$this->_export()}

	{$this->_create()}

	{$this->_store()}

	{$this->_edit()}

	{$this->_update()}

	{$this->_detail()}

	{$this->_delete()}

	{$this->_tree()}
}
EOF;

		return $code;
	}

	private function _list() {
		foreach($this->_tableNode->columns->column as $column) {
			if (empty($column['queryType']))
				continue;

			$params[] = "\${$column['name']}";
			

			if ($column['queryType'] == "range") {
				$requests[] = "\${$column['name']}['start'] = \$request->input('{$column['name']}_start');";
                $detail[] = "\$details['{$column['name']}_start'] = \${$column['name']}['start'];";
				$requests[] = "\${$column['name']}['end'] = \$request->input('{$column['name']}_end');";
                $detail[] = "\$details['{$column['name']}_end'] = \${$column['name']}['end'];";
				$url_params[] = "{$column['name']}_start={\${$column['name']}['start']}";
				$url_params[] = "{$column['name']}_end={\${$column['name']}['end']}";
			}
			else {
				$requests[] = "\${$column['name']} = \$request->input('{$column['name']}');";
                $detail[] = "\$details['{$column['name']}'] = \${$column['name']};";
				$url_params[] = "{$column['name']}={\${$column['name']}}";
			}
		}
		
		
		$params[] = "\$page, \$page_size";
		$requests[] = "\$page = \$request->input('page');";
       // $detail = json_encode($detail);
		$params = implode(", ", $params);
		$requests = implode("\r\n\t\t", $requests);
        $detail = implode("\r\n\t\t", $detail);
		$url_params = implode("&", $url_params);
		$code = <<<EOF
	public function index(Request \$request) {
		{$requests}
		\$page = \$page > 0 ? \$page : 1;
		\$page_size = defined("PAGE_SIZE") ? PAGE_SIZE : 12;
		\$data = \$this->_m_{$this->_tableName}->getList($params);
		\$list = \$data['list'];
		\$count = \$data['count'];
		@list(\$action_url, \$else) = explode("?", \$_SERVER['REQUEST_URI']);
		\$base_url = \$action_url . "?{$url_params}";
		\$page_html = Pager::getDivPage(\$base_url, \$count, \$page, \$page_size);

        {$this->dict()}
        {$detail}
        \$details = isset(\$details)?\$details:[];
        \$assigns = ["detail"=>\$details,"list"=>\$list,"dict_boolean"=>array("否", "是"),"page_html"=>\$page_html,"action_url"=>\$action_url,"csrf_token"=>csrf_token()];
		\$assign = isset(\$assign)?array_merge(\$assign,\$assigns):\$assigns;
		return view("{$this->_autophpviewdir}{$this->_tableName}_list",\$assign);
	}
EOF;
		return trim($code);
	}


    private function _export() {
        $tablename = $this->_tableNode['comment']?$this->_tableNode['comment']:$this->_tableNode['name'];
        foreach($this->_tableNode->columns->column as $column) {
            $columnnames["{$column['name']}"] ="{$column['displayName']}" ;
            if (empty($column['queryType']))
                continue;

            $params[] = "\${$column['name']}";


            if ($column['queryType'] == "range") {
                $requests[] = "\${$column['name']}['start'] = \$request->input('{$column['name']}_start');";
                $requests[] = "\${$column['name']}['end'] = \$request->input('{$column['name']}_end');";
                $url_params[] = "{$column['name']}_start={\${$column['name']}['start']}";
                $url_params[] = "{$column['name']}_end={\${$column['name']}['end']}";
            }
            else {
                $requests[] = "\${$column['name']} = \$request->input('{$column['name']}');";
                $url_params[] = "{$column['name']}={\${$column['name']}}";
            }
        }

        $params = implode(", ", $params);
        $requests = implode("\r\n\t\t", $requests);
        $url_params = implode("&", $url_params);
        $columnnames = json_encode($columnnames);
        $code = <<<EOF
	public function export(Request \$request) {
		{$requests}
		\$data = \$this->_m_{$this->_tableName}->getList($params);
		\$list = \$data['list'];
		\$columnnames = '$columnnames';
        {$this->dict()}
        \$columnnames = json_decode(\$columnnames,true);
        \$columnkeys = array_keys(\$columnnames);
        \$data=[];
        foreach( \$list as \$key=>\$val){
            foreach (\$columnkeys as \$columnfield) {
                \$data[\$key][\$columnfield] = "\t" . \$val->\$columnfield;
            }
        }
        \$fileName = "$tablename". date('YmdHis', time()) .'.csv';
        Utils::export(\$fileName, \$columnnames, \$data, "");
	}
EOF;
        return trim($code);
    }

	private function _tree() {
		if ($this->_tableNode['type'] != "tree" ) {
			return;
		}

				$code = <<<EOF
	public function tree(Request \$request) {
		{$requests}
		\$tree = \$this->_m_{$this->_tableName}->getTree($params);
        {$this->dict()}
        \$assign["tree"] =\$tree;
        \$assign["dict_boolean"] =array("否", "是");
        \$assign["csrf_token"] =csrf_token();
		return view("{$this->_autophpviewdir}{$this->_tableName}_tree",\$assign);
	}
EOF;
		return trim($code);
	}


	private function _create() {
	
		$code = <<<EOF
	public function create(Request \$request) {
		{$this->dict(false, false)} {$priv_format}
        \$assign = ["dict_boolean"=>array("否", "是"),"csrf_token"=>csrf_token()];
		return view("{$this->_autophpviewdir}{$this->_tableName}_add",\$assign);
	}
EOF;
		return trim($code);	
	
	}

	
	private function _store() {
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$pk = $column['name'];
				continue;
			}

			if (empty($pk)) {
				$pk = $this->_pk;
			}

			if (empty($column['track'])) {
				if ($column['displayType'] == "time") {
					$requests[] = "\$input['{$column['name']}'] = strtotime(\$request->input('{$column['name']}'));";
				}
				elseif ($column['displayType'] == "checkbox") {
					$requests[] = "\$input['{$column['name']}'] = json_encode(\$request->input('{$column['name']}'));";
				}
				elseif ($column['displayType'] == "privilege") {
					$requests[] = "\$input['{$column['name']}'] = json_encode(\$request->input('{$column['name']}'));";
					$priv_format = <<<EOF
			global \$CONFIG_ADMIN;
			\$power_list = \$CONFIG_ADMIN['power_tree'];
			unset(\$power_list['no_valide']);
			\$assign['power_list'] = \$power_list;
EOF;
				}
				else {
					$requests[] = "\$input['{$column['name']}'] = \$request->input('{$column['name']}');";
				}
			}
			else {
				if ($column['track'] == "create") {
					if ($column['displayType'] == "time") {
						$requests[] = "\$input['{$column['name']}'] = time();";
					}
					else {
						//$requests[] = "global \$admin_name;";
						$requests[] = "\$input['{$column['name']}'] = AuthLogin::instance()->getUid();";
					}
				}
			}
		}
		$requests = implode("\r\n\t\t\t", $requests);

		$code = <<<EOF
	public function store(Request \$request) {
		if (!empty(\$_POST)) {
			\$input = array();
			{$requests}
			\$ret = \$this->_m_{$this->_tableName}->insert(\$input);

			\$tip_info = array("module"=>"{$this->_tableName}", "action"=>"添加", "status"=>"\$ret");
            \$assign["tip_info"] = \$tip_info;
            \$assign["csrf_token"] = csrf_token();
			return view("{$this->_autophpviewdir}common.tips",\$assign);
		}

		{$this->dict(false, false)} {$priv_format}
		\$assign["dict_boolean"] = array("否", "是");
		return view("{$this->_autophpviewdir}{$this->_tableName}_add",\$assign);
	}
EOF;
		return trim($code);
	}


	private function _edit() {
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$pk = $column['name'];
				continue;
			}

			if (empty($pk)) {
				$pk = $this->_pk;
			}

			if (empty($column['track'])) {
				if ($column['displayType'] == "time") {
					$requests[] = "\$set['{$column['name']}'] = strtotime(\$request->input('{$column['name']}'));";
					$detail_format[] = "\$detail['{$column['name']}'] =  empty(\$detail['{$column['name']}']) ?'': date('Y-m-d H:i', \$detail['{$column['name']}']);";
				}
				elseif ($column['displayType'] == "checkbox" || $column['displayType'] == "privilege") {
					$requests[] = "\$set['{$column['name']}'] = json_encode(\$request->input('{$column['name']}'));";
					$detail_format[] = "\$detail['{$column['name']}'] = json_decode(\$detail['{$column['name']}'], true);";
				}
				else {
					$requests[] = "\$set['{$column['name']}'] = \$request->input('{$column['name']}');";
				}
			}
			else {
				if ($column['track'] == "update") {
					if ($column['displayType'] == "time") {
						$requests[] = "\$set['{$column['name']}'] = time();";
					}
					else {
						//$requests[] = "global \$admin_name;";
						$requests[] = "\$input['{$column['name']}'] = AuthLogin::instance()->getUid();";
					}
				}
			}

			if ($column['displayType'] == "privilege") {
				$priv_format = <<<EOF
		global \$CONFIG_ADMIN;
		\$power_list = \$CONFIG_ADMIN['power_tree'];
		unset(\$power_list['no_valide']);
		\$assign["csrf_token"] = csrf_token();
		\$assign["power_list"] = \$power_list;
EOF;
			}
		}

		$requests = implode("\r\n\t\t\t", $requests);
		$detail_format = implode("\r\n\t\t\t", $detail_format);


		$code = <<<EOF
	public function edit(\$$pk) {
		\$detail = \$this->_m_{$this->_tableName}->detail(\$$pk);
		{$detail_format}
		\$assign["detail"] = \$detail;
		{$this->dict(true, false)}

		{$priv_format}
        \$assign["dict_boolean"] =array("否", "是");
        \$assign["csrf_token"] =csrf_token();
		return view("{$this->_autophpviewdir}{$this->_tableName}_edit",\$assign);
	}
EOF;

		return trim($code);
	}


	private function _update() {
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$pk = $column['name'];
				continue;
			}

			if (empty($pk)) {
				$pk = $this->_pk;
			}

			if (empty($column['track'])) {
				if ($column['displayType'] == "time") {
					$requests[] = "\$set['{$column['name']}'] = strtotime(\$request->input('{$column['name']}'));";
					$detail_format[] = "\$detail['{$column['name']}'] =  empty(\$detail['{$column['name']}']) ?'': date('Y-m-d H:i', \$detail['{$column['name']}']);";
				}
				elseif ($column['displayType'] == "checkbox" || $column['displayType'] == "privilege") {
					$requests[] = "\$set['{$column['name']}'] = json_encode(\$request->input('{$column['name']}'));";
					$detail_format[] = "\$detail['{$column['name']}'] = json_decode(\$detail['{$column['name']}'], true);";
				}
				else {
					$requests[] = "\$set['{$column['name']}'] = \$request->input('{$column['name']}');";
				}
			}
			else {
				if ($column['track'] == "update") {
					if ($column['displayType'] == "time") {
						$requests[] = "\$set['{$column['name']}'] = time();";
					}
					else {
						//$requests[] = "global \$admin_name;";
						$requests[] = "\$input['{$column['name']}'] = AuthLogin::instance()->getUid();";
					}
				}
			}

			if ($column['displayType'] == "privilege") {
				$priv_format = <<<EOF
		global \$CONFIG_ADMIN;
		\$power_list = \$CONFIG_ADMIN['power_tree'];
		unset(\$power_list['no_valide']);
		\$assign["csrf_token"] =csrf_token();
		\$assign["power_list"] =\$power_list;
EOF;
			}
		}

		$requests = implode("\r\n\t\t\t", $requests);
		$detail_format = implode("\r\n\t\t\t", $detail_format);

		$code = <<<EOF
	public function update(Request \$request) {
		\$$pk =  \$request->input("$pk");
		if (!empty(\$_POST)) {
			\$set = array();
			{$requests}
			\$ret = \$this->_m_{$this->_tableName}->update(\$$pk, \$set);

			\$tip_info = array("module"=>"{$this->_tableName}", "action"=>"更新", "status"=>"\$ret");
			\$assign["tip_info"] =\$tip_info;
			return view("{$this->_autophpviewdir}common.tips",\$assign);
			
		}
		\$detail = \$this->_m_{$this->_tableName}->detail(\$$pk);
		{$detail_format}
		\$assign["detail"] = \$detail;
		{$this->dict(true, false)}

		{$priv_format}
        \$assign["dict_boolean"] = array("否", "是");
        \$assign["csrf_token"] = csrf_token();
		return view("{$this->_autophpviewdir}{$this->_tableName}_edit",\$assign);
	}
EOF;

		return trim($code);
	}

	private function _detail() {
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$pk = $column['name'];
				continue;
			}

			if (empty($pk)) {
				$pk = $this->_pk;
			}

			if ($column['displayType'] == "time") { 
				$detail_format[] = "\$detail['{$column['name']}'] =  empty(\$detail['{$column['name']}']) ? '': date('Y-m-d H:i', \$detail['{$column['name']}']);";
			}
			elseif ($column['displayType'] == "checkbox") {
				$detail_format[] = "\$detail['{$column['name']}'] = json_decode(\$detail['{$column['name']}'], true);";
			}
			elseif ($column['displayType'] == "privilege") {
				$detail_format[] = "\$detail['{$column['name']}'] = json_decode(\$detail['{$column['name']}'], true);";
				$priv_format = <<<EOF
			global \$CONFIG_ADMIN;
			\$power_list = \$CONFIG_ADMIN['power_tree'];
			unset(\$power_list['no_valide']);
			\$assign["power_list"] = \$power_list;
EOF;
			}
		}

		$detail_format = implode("\r\n\t\t\t", $detail_format);

		$code = <<<EOF
	public function show(\$$pk) {

		\$detail = \$this->_m_{$this->_tableName}->detail(\$$pk);
		{$detail_format} 
		{$this->dict(true)}
        \$assign["detail"] = \$detail;
		{$priv_format}
		\$assign["dict_boolean"] = array("否", "是");
		\$assign["csrf_token"] = csrf_token();
		return view("{$this->_autophpviewdir}{$this->_tableName}_detail",\$assign);
	}
EOF;

		return trim($code);		
	}

	private function _delete() {
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$pk = $column['name'];
				continue;
			}
		}

		if (empty($pk)) {
			$pk = $this->_pk;
		}

		$code = <<<EOF

	public function destroy(\$$pk) {
		\$assign["csrf_token"]=csrf_token();

		\$ret = \$this->_m_{$this->_tableName}->delete(\$$pk);

		return \$ret;

		\$tip_info = array("module"=>"{$this->_tableName}", "action"=>"删除", "status"=>"\$ret");
		\$assign["tip_info"]=\$tip_info;
		view("{$this->_autophpviewdir}common.tips");
		return;
        return view("{$this->_autophpviewdir}{$this->_tableName}_delete",\$assign);

	}
EOF;

		return trim($code);
	}

	private function _index() {
		$code = <<<EOF
	public function welcome() {
		header("Location: /admin/{$this->_tableName}/list");
		return view("{$this->_autophpviewdir}{$this->_tableName}_index");
	} 
EOF;
		return trim($code);
	}
	
	public function dict($is_detail = false, $is_tip = true) {
		foreach ($this->_tableNode->keys->key as $key) {
			if ($key['type'] != "fk") {
				continue;
			}
			

			$column = $key->column;
			
			if ($is_detail) {
				$code .= "
		\${$column['name']} = \$detail['{$column['name']}'];
";
			}

			if ($is_tip) {
				$tip_code = '$dict_list[0] = "请选择";';
			}

			$classname = str_replace(" ", "", ucwords(str_replace("_", " ", $column['referencedTable'])));
			
			$code .= <<<EOF
		\$m_{$column['referencedTable']} = new \\App\\Http\\Models\\Autophp\\{$classname}Model();
		\$dict_list = \$m_{$column['referencedTable']}->dict();
		{$tip_code}
		ksort(\$dict_list);
		@\$dict_{$column['referencedTable']} = array(\${$column['name']}, \$dict_list);
		\$assign["dict_{$column['referencedTable']}"]=\$dict_{$column['referencedTable']};

EOF;
		}
		return $code;
	}

}
