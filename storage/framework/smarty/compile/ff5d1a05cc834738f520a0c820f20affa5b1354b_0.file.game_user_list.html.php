<?php
/* Smarty version 3.1.32, created on 2018-09-07 02:46:46
  from '/data/web/yaf/h5test.local.com/resources/views/autophp/game_user_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b91e6966ec927_71138227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff5d1a05cc834738f520a0c820f20affa5b1354b' => 
    array (
      0 => '/data/web/yaf/h5test.local.com/resources/views/autophp/game_user_list.html',
      1 => 1536285952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/head.inc' => 1,
  ),
),false)) {
function content_5b91e6966ec927_71138227 (Smarty_Internal_Template $_smarty_tpl) {
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
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户游戏表">
			<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_user/create">添  加</a></li>
			</ul>
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<table>
			<tr>
				<th>ID</th> 
<th>游戏id</th> 
<th>平台用户id</th> 
<th>渠道标示</th> 
<th><a href='javascript:' title='0-pc;1-android;2-ios' >操作系统</a></th><th>注册时间戳</th> 
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
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->game_id;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->user_id;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->ucode;?>
</td> 
<td><?php echo $_smarty_tpl->tpl_vars['item']->value->os;?>
</td> 
<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->reg_time,"%Y-%m-%d %H:%M");?>
</td> 
<td><a href="/autophp/game_user/<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
">查看</a> 
					<a href="/autophp/game_user/<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
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
