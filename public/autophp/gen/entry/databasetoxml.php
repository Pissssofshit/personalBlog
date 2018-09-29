<?php
//配置数据库
header("content-type:text/html;charset=utf-8");
if($_POST) {
    $dbserver = isset($_POST["dbserver"])?$_POST["dbserver"]:"localhost";
    $dbusername = isset($_POST["dbusername"])?$_POST["dbusername"]:"root";
    $dbpassword = isset($_POST["dbpassword"])?$_POST["dbpassword"]:"";
    $database = isset($_POST["database"])?$_POST["database"]:"chess";

    try {
        $mysql_conn = new PDO("mysql:host=$dbserver;dbname=$database", $dbusername, $dbpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $mysql_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $mysql_conn->prepare("select * from information_schema.tables where table_schema='{$database}' and table_type='base table'");
        $stmt->execute();

        // 设置结果集为关联数组
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            // $table = isset($v["Tables_in_" . $database]) ? $v["Tables_in_" . $database] : "";
            $tablename = $v["TABLE_NAME"];
            $engine = isset($v["ENGINE"]) ? $v["ENGINE"] : "InnoDB";
            $tables[$k]['TABLE_NAME'] = $tablename;
            $tables[$k]['ENGINE'] = $engine;
        }
        $no_show_table = array();    //不需要显示的表
        $no_show_field = array();   //不需要显示的字段
//循环取得所有表的备注及表中列消息
        foreach ($tables as $k => $v) {
            $sql = 'SELECT * FROM ';
            $sql .= 'INFORMATION_SCHEMA.TABLES ';
            $sql .= 'WHERE ';
            $sql .= "table_name = '{$v['TABLE_NAME']}'  AND table_schema = '{$database}'";
            $table_result = $mysql_conn->prepare($sql);
            $table_result->execute();
            while ($t = $table_result->fetch(PDO::FETCH_ASSOC)) {
                $tables[$k]['TABLE_COMMENT'] = $t['TABLE_COMMENT'];
            }

            $sql = 'SELECT * FROM ';
            $sql .= 'INFORMATION_SCHEMA.COLUMNS ';
            $sql .= 'WHERE ';
            $sql .= "table_name = '{$v['TABLE_NAME']}' AND table_schema = '{$database}'";

            $fields = array();
            $field_result = $mysql_conn->prepare($sql);
            $field_result->execute();
            while ($t = $field_result->fetch(PDO::FETCH_ASSOC)) {
                $fields[] = $t;
            }
            $tables[$k]['COLUMN'] = $fields;
        }

        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "    <database name=\"{$database}\"  shortname=\"{$database}\" user=\"{$dbusername}\" password=\"123456\" hosts=\"%\" title=\"{$database}\" namespace=\"{$database}\">\n";
        foreach ($tables as $k => $v) {
            // $html .= '    <h3>' . ($k + 1) . '、' . $v['TABLE_COMMENT'] .'  （'. $v['TABLE_NAME']. '）</h3>'."\n";
            $commentshow = $v['TABLE_COMMENT']?$v['TABLE_COMMENT']:$v['TABLE_NAME'];
            $xmlisshow = '       <table name="' . $v['TABLE_NAME'] . '" engine="' . $v['ENGINE'] . '" charset="utf8" autoIncrementStartFrom="1" enableCache="false" isDict="true" comment="' . $commentshow . '" group="">' . "\n";
            $xmlisshow .= '            <columns>' . "\n";
            $thispk = "";
            foreach ($v['COLUMN'] as $f) {
                if (@!is_array($no_show_field[$v['TABLE_NAME']])) {
                    $no_show_field[$v['TABLE_NAME']] = array();
                }
                if (!in_array($f['COLUMN_NAME'], $no_show_field[$v['TABLE_NAME']])) {
                    $extra = "";
                    if($f['COLUMN_KEY']=='PRI'){$thispk = $f['COLUMN_NAME'];}

                    if ($f['EXTRA'] == 'auto_increment') {
                        $extra = 'extra="auto_increment"';
                    }else{
                        $extra = $f['COLUMN_DEFAULT']==""?"":'default="' . $f['COLUMN_DEFAULT'] . '"';
                    }
                    $isnull = $f['IS_NULLABLE'] == "NO" ? "false" : "true";
                    $columncomment = $f['COLUMN_COMMENT']?$f['COLUMN_COMMENT']:$f['COLUMN_NAME'];
                    $xmlisshow .= '               <column name="' . $f['COLUMN_NAME'] . '" ' . $extra . ' type="' . $f['COLUMN_TYPE'] . '" nullable="' . $isnull . '"  displayName="' .$columncomment . '" displayType="text" />';
                    $xmlisshow .= "\n";
                }
            }

            $xmlisshow .= '        </columns>'."\n";
            $xmlisshow .= '        <keys>
			        <key type="pk">
				        <column name="' . $thispk . '"/>
		            </key>
		       </keys>' . "\n";
            $xmlisshow .= "\n";
            $xmlisshow .= '    </table>' . "\n";
            if($thispk) {
                $xml .=$xmlisshow;
            }
        }
        $xml .= "   </database>\n";
        unset($_POST);
        if ($xml) {
            $file_content = $xml;
            define('BASE_PATH'  , dirname(realpath(dirname(__FILE__))));
            $db_conf_file = BASE_PATH . "/dbxml/{$database}.xml";
            $file_path = $db_conf_file;
            if (!$fh = fopen($file_path, "w")) {
                die("ERROR: Open file '$file_path' failed \n");
            }

            if(fwrite($fh, $file_content) === FALSE){
                die("ERROR: Write file '$file_path' failed \n");
            }
            fclose($fh);
            echo "<a href='/autophp/gen/entry/index.php?xml=$database'>生成{$database}.xml成功 请到页面生成autophp框架!</a>";
            exit;
        }
    }catch(Exception $e){
        header("Content-type: text/html; charset=utf-8");
        echo $e->getMessage();
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>数据库表结构</title>
    <meta name="generator" content="ThinkDb V1.0" />
    <meta name="author" content="" />
    <meta name="copyright" content="2008-2014 Tensent Inc." />
    <style>
        body, td, th { font-family: "微软雅黑"; font-size: 14px; }
        .warp{margin:auto; width:900px;}
        .warp h3{margin:0px; padding:0px; line-height:30px; margin-top:10px;}
        table { border-collapse: collapse; border: 1px solid #CCC; background: #efefef; }
        table th { text-align: left; font-weight: bold; height: 26px; line-height: 26px; font-size: 14px; text-align:center; border: 1px solid #CCC; padding:5px;}
        table td { height: 20px; font-size: 14px; border: 1px solid #CCC; background-color: #fff; padding:5px;}
        .c1 { width: 120px; }
        .c2 { width: 120px; }
        .c3 { width: 150px; }
        .c4 { width: 80px; text-align:center;}
        .c5 { width: 80px; text-align:center;}
        .c6 { width: 80px; }
        .c7 { width: 190px; }
    </style>
</head>
<body>
<div class="warp">
    <h1 style="text-align:center;">数据库表生成xml</h1>
    <form method="post">
        数据库地址:<input type="text" name="dbserver" value="192.168.99.100" />
        数据库名:<input type="text" name="database" value="" />
        用户名:<input type="text" name="dbusername" value="root" />
        密码:<input type="text" name="dbpassword" value="123" />
        <input type="submit" value="生成XML文件" />
    </form>

</div>
</body>
</html>