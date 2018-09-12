<?php
/* Smarty version 3.1.32, created on 2018-09-07 10:22:26
  from '/data/web/yaf/h5test.local.com/resources/views/autophp/user_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b925162e10886_80047479',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d3f1feb33bf3e3667021c62428a29a491be9d8f' => 
    array (
      0 => '/data/web/yaf/h5test.local.com/resources/views/autophp/user_list.html',
      1 => 1536285952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/head.inc' => 1,
  ),
),false)) {
function content_5b925162e10886_80047479 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/web/yaf/h5test.local.com/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<?php $_smarty_tpl->_subTemplateRender("file:common/head.inc", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<meta name="csrf-token" content="<?php echo $_smarty_tpl->tpl_vars['csrf_token']->value;?>
"> 
	</head>
	<body>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户">
			<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user/create">添  加</a></li>
			</ul>
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action_url']->value;?>
">
			<ul>
				<li><label class="display_name">用户名</label><input type="text" maxlength="250" name="username" id="username" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['username'];?>
"></input></li>


				<li><input class="kbutton kbutton_A" type="submit" value="搜  索" id="btn_search" /></li>
			</ul>
			
		</form>
	</fieldset>

	<fieldset>
		<legend>列表</legend>
		<table>
			<tr>
				<th>UID</th> 
<th>用户名</th> 
<th>手机号</th> 
<th>注册时间戳</th> 
<th>手机绑定时间戳</th> 
<th>邮箱绑定时间戳</th> 
<th><a href='javascript:' title='1自然量2公会' >来源1</a></th><th><a href='javascript:' title='渠道标识' >来源2</a></th><th><a href='javascript:' title='0-pc;1-android;2-ios' >操作系统</a></th><th><a href='javascript:' title='1男2女' >性别</a></th><th>盐值</th> 
<th>操作</th> 

			</tr>
			
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->username;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->mobile;?>
</td> 
<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->reg_time,"%Y-%m-%d %H:%M");?>
</td> 
<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->mobile_bind_time,"%Y-%m-%d %H:%M");?>
</td> 
<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->email_bind_time,"%Y-%m-%d %H:%M");?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->source;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->ucode;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->os;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->sex;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->salt;?>
</td> 
<td><a href="/autophp/user/<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">查看</a> 
					<a href="/autophp/user/<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
/edit">编辑</a></td>
			</tr>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</table>
		<div class="list_page"><?php echo $_smarty_tpl->tpl_vars['page_html']->value;?>
</div>
	</fieldset>
			</div>
		</div>
	</body>
</html><?php }
}
