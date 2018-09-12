<?php
/* Smarty version 3.1.32, created on 2018-09-11 06:42:13
  from '/data/web/yaf/h5test.local.com/resources/views/autophp/common/tips.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9763c55238b9_30650756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d6985cb745dadc9ea74c301a0ac03dd06ab7012' => 
    array (
      0 => '/data/web/yaf/h5test.local.com/resources/views/autophp/common/tips.html',
      1 => 1535709925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/head.inc' => 1,
  ),
),false)) {
function content_5b9763c55238b9_30650756 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<?php $_smarty_tpl->_subTemplateRender("file:common/head.inc", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</head>
	<body>
		<div id="main" class="easyui-panel" title="当前位置：提示信息">
			<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/<?php echo $_smarty_tpl->tpl_vars['tip_info']->value['module'];?>
">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/<?php echo $_smarty_tpl->tpl_vars['tip_info']->value['module'];?>
/create">添  加</a></li>
			</ul>
			<div class="easyui-panel" border="false" style="padding:1px">

			<fieldset>
				<legend>提示信息</legend>
				<?php if ($_smarty_tpl->tpl_vars['tip_info']->value['status']) {?>
					<div class="op_tip">
						<li class="op_tip_success"><?php echo $_smarty_tpl->tpl_vars['tip_info']->value['action'];?>
操作成功！</li>

						<?php if ($_smarty_tpl->tpl_vars['tip_info']->value['action'] != "删除") {?>
						<li class="op_tip_suggest">您可以点击<a href="javascript:void(0)" onclick="javascript:history.back()">这里</a>继续<?php echo $_smarty_tpl->tpl_vars['tip_info']->value['action'];?>
</span></li>
						<?php }?>
				<?php } else { ?>
					<div class="op_tip ">
						<li class="op_tip_failed">
							<?php echo $_smarty_tpl->tpl_vars['tip_info']->value['action'];?>
失败！

							<?php if ($_smarty_tpl->tpl_vars['tip_info']->value['action'] == "更新") {?>
								<span class="op_tip_suggest">注意：更新操作没有作任何修改，也会提示“失败”</span>
							<?php }?>
						</li>
						<li class="op_tip_suggest">您可以点击<a href="javascript:void(0)" onclick="javascript:history.back()">这里</a>返回，再次尝试操作，如果仍旧失败，请联系系统管理员</li>

						<?php if ($_smarty_tpl->tpl_vars['tip_info']->value['detail']) {?>
						<li class="op_tip_failed">Message: <?php echo $_smarty_tpl->tpl_vars['tip_info']->value['detail'];?>
</li>
						<?php }?>
					</div>
				<?php }?>
			</fieldset>
			</div>
		</div>
	</body>
</html>
<?php }
}
