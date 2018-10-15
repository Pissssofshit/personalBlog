<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <TITLE>接口生成工具</TITLE>
</HEAD>
<BODY>
    <?php
        $app_path =  dirname(dirname(__FILE__));
        $md_path = $app_path."/markdown/";
        $api_path = $app_path."/api/";
        $doc_path = $app_path."/doc/";

        $app_domain = $_SERVER['HTTP_HOST'];
        $doc_url = $app_domain."/blueprint/doc/xxx.html";
        $api_url = "xxxxx:9931";
    ?>
    <h3>操作步骤：</h3>
    <ul>
        <li>1、将写好的xxx.md文件上传至 <?php echo $app_path; ?></li>
        <li>2、系统将会生成相应的文档页面，访问 <?php echo $doc_url; ?></li>
        <li>3、系统将会生成相应的接口，访问 <?php echo $api_url; ?></li>
    </ul>
</BODY>
</HTML>
