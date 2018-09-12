<?php
/* Smarty version 3.1.32, created on 2018-09-07 02:31:06
  from '/data/web/yaf/h5test.local.com/resources/views/autophp/common/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b91e2ea25daf6_42388642',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97c997fb038fa7546f947b6f91ba0cce722f544c' => 
    array (
      0 => '/data/web/yaf/h5test.local.com/resources/views/autophp/common/index.html',
      1 => 1535709925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/meta.html' => 1,
    'file:common/leftbar.html' => 1,
  ),
),false)) {
function content_5b91e2ea25daf6_42388642 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['project_name']->value;?>
</title>
<?php $_smarty_tpl->_subTemplateRender("file:common/meta.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>
<body class="easyui-layout">
	<div region="north" border="false" >
		<div id="header">
			<h1 style="font-size:30px;padding-left:50px;"><?php echo $_smarty_tpl->tpl_vars['project_name']->value;?>
</h1>
			<div class="top">
				<ul>
					<li><?php echo $_smarty_tpl->tpl_vars['const']->value['USERNAME_LOGIN'];?>
<span style="font-weight:bold">[<?php echo $_smarty_tpl->tpl_vars['admin_name']->value;?>
]</span></li>
					<li><a href="/autophp/password" title="<?php echo $_smarty_tpl->tpl_vars['const']->value['PASSWORD_EDIT'];?>
" target="_top"><?php echo $_smarty_tpl->tpl_vars['const']->value['PASSWORD_EDIT'];?>
</a></li>
					<li><a href="/autophp/logout" title="<?php echo $_smarty_tpl->tpl_vars['const']->value['SYSTEM_LOGOUT'];?>
" target="_top"><?php echo $_smarty_tpl->tpl_vars['const']->value['SYSTEM_LOGOUT'];?>
</a></li>
				</ul>
			</div>		
		</div>
	</div>
	<div region="west" split="true" title="<?php echo $_smarty_tpl->tpl_vars['const']->value['BAR_NAVIGATION'];?>
" style="width:150px;">
		<?php $_smarty_tpl->_subTemplateRender("file:common/leftbar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>
	<div region="center" border="false">
		<iframe id="content" name="content" width="100%" frameborder="0" height="100%" src="/autophp/welcome"></iframe>
	</div>
</body>
</html>
<?php }
}
