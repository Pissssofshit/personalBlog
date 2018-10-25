<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <TITLE>代码生成工具</TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="zhuangzhenhua">
  <META NAME="Keywords" CONTENT="PHP 自动化">
  <META NAME="Description" CONTENT="">
 </HEAD>

 <BODY>
<!--代码生成开始-->
<?php
	error_reporting(E_ALL & ~E_NOTICE &~E_WARNING);
	ini_set("display_errors", 1);
	define('BASE_PATH'  , dirname(realpath(dirname(__FILE__))));
	$autophp_lib = BASE_PATH . "/lib";
	$include_path[] = ".";
	$include_path[] = BASE_PATH;
	$include_path[] = $autophp_lib;
	set_include_path(implode(PATH_SEPARATOR, $include_path));

	$host = $_SERVER['HTTP_HOST'];
	$pos = strpos(BASE_PATH, $host);
	$project_path = substr(BASE_PATH, 0, $pos) . $host;

	$xml = $_GET['xml'];
	if (!empty($xml))
		$db_conf_file = BASE_PATH . "/dbxml/{$xml}.xml";
	else {
		list($dbname, $else) = explode(".", $host);
		$db_conf_file = BASE_PATH . "/dbxml/{$dbname}.xml";
	}

	if (!file_exists($db_conf_file)) {
		echo "<pre>数据配置文件：{$db_conf_file}不存在; <br/>请提供：{$db_conf_file}</pre>";die();
	}

	require_once 'Project.php';
	$dst_path = $_POST['proj_path'];
	$project = new Project($db_conf_file);
	$project->setDstPath($dst_path);

	$pname = "{$project->getName()}";
	$pname = "{$_SERVER['SERVER_NAME']}";

	//$project_path = "/data/web/laravel/{$pname}";
?>

	<div id="div_gen">
	<div>
	<pre>
<?php echo "1、当前配置文件：{$db_conf_file},  如需指定文件,可以指定URL参数（如：?xml=dc)。\n";
	echo "2、新项目按键按序号执行。\n";
	echo "3、执行完成后设置hosts: 
	192.168.99.100 {$pname} #win7
	127.0.0.1	{$pname} #mac、win10";
?>
</pre></div>
	<form method="post" action="">
	<li>项目目录: <input type="text" name="proj_path" value="<?php echo $project_path  ?>" style="width:200px"/></li>
		<table>
			<tr>
				<td>table列表</td><td>module列表</td>
			</tr>
			<tr>
			<td valign="top">



<?php	
	$table = $_POST['table'];
	$module = $_POST['module'];

	$tables = $project->tables();
	foreach ($tables as $table_name) {
		if (in_array($table_name, $table)) {
			echo '<input type="checkbox" name="table[]" id="' . $table_name . '" value="' . $table_name . '" checked /><label for="' . $table_name . '" style="color:red">' . $table_name . '</label><br>';
		}
		else {
			echo '<input type="checkbox" name="table[]" id="' . $table_name . '" value="' . $table_name . '" checked/><label for="' . $table_name . '">' . $table_name . '</label><br>';
		}
	}
?>
			</td>
			<td valign="top">
<?php
	$module_list = array("schema", "model", "controller", "view");
	foreach ($module_list as $module_name) {
		if (in_array($module_name, $module)) {
			echo '<input type="checkbox" name="module[]" id="' . $module_name . '" value="' . $module_name . '" checked /><label for="' . $module_name . '" style="color:red">' . $module_name . '</label><br>';			
		}
		else {
			echo '<input type="checkbox" name="module[]" id="' . $module_name . '" value="' . $module_name . '" checked/><label for="' . $module_name . '">' . $module_name . '</label><br>';
		}
	}
?>
			</td></tr>
			<tr><td>
				<input type="submit" value="1、生成代码（多次执行覆盖）" />
			</td></tr>
		<table>
	</form>
<?php 
if (!empty($table) && !empty($module)) {
	if (!file_exists($dst_path)) {
		die("ERROR: project path isn't exists! ");
	}



	$status = $project->partgen($table, $module);

	if ($status) {
		echo "生成autophp框架完成，下一步，点击导入数据库";
	}
	//$model_gen->gen();
}
?>
	</div>
<!--代码生成结束-->

<!--数据库导入开始-->
	<div id="div_import">
	<form method="post" action="">
		<table>
			<tr>
				<td>项目目录：</td>
				<td><input type="text" name="proj_path" value="<?php echo $project_path ?>" style="width:200px"/></td>
			</tr>
			<tr>
				<td>DB主机：</td>
				<td><input type="text" value="mysql" name="db_host"></td>
			</tr>
			<tr>
				<td>DB用名名：</td>
				<td><input type="text" value="root" name="db_username"></td>
			</tr>
			<tr>
				<td>DB密码：</td>
				<td><input type="password" value="123456" name="db_password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" name="db_fk" id="db_fk" value="1"><label for="db_fk" style="font-size:12px">是否关链外键</label>
				</td>
			</tr>
			<tr><td>
				<input type="submit" value="2、导入数据库" />
			</td></tr>
		</table>
	</form>
<?php
	$db_username = $_POST['db_username'];
	$db_password = $_POST['db_password'];
	$db_host = $_POST['db_host'];
	$db_fk = $_POST['db_fk'];

	if (!empty($db_username)) {
		$status = $project->importdb($db_username, $db_password, $db_host, $db_fk);

		if ($status) {
			echo "导入成功, 点击进入<a href='/autophp'>autophp浏览</a>";
		}
	}
?>
	</div>
<!--数据库导入结束-->

<!--项目服务，框架搭建开始-->
<!--
	<div id="div_server">
		<form aciton="" method="post">
			<table>
			<tr>
				<td>项目域名：</td>
				<td><input type="text" name="domain" value="<?php echo $pname ?>"></td>
			</tr>
			<tr>
				<td>WEB根目录：</td>
				<td><input type="text" name="web_path" value="/data/apache/www"></td>
			</tr>
			<tr>
				<td>HTTP服务：</td>
				<td><input type="radio" value="apache" name="http_server" id="apache" /><label for="apache" style="font-size:12px">apache</label>
					<input type="radio" value="nginx" name="http_server" id="nginx" checked/><label for="nginx" style="font-size:12px">nginx</label>
					安装目录：<input type="text" value="/usr/local/nginx" name="server_path" />
				</td>
			</tr>
			<tr><td>
				<input type="submit" value="1、框架初始化（执行1次）" />
			</td></tr>
		</table>
		</form>
<?php
	$domain = $_POST['domain'];
	$web_path = $_POST['web_path'];
	$http_server = $_POST['http_server'];
	$server_path = $_POST['server_path'];
	if (!empty($domain)) {
		$status = $project->server($domain, $http_server, $server_path, $web_path);

		if ($status) {
			echo "导入成功";
		}
		else {
			echo "项目域名是必须的";
		}
	}
?>
	</div>
-->
<!--项目服务，框架搭建结束-->
	
 </BODY>
</HTML>


