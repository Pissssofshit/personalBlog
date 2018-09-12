<?php
/* Smarty version 3.1.32, created on 2018-09-07 02:47:02
  from '/data/web/yaf/h5test.local.com/resources/views/autophp/common/leftbar.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b91e6a6be81e4_56678850',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e9e608baf87dba3583cdf8fe9372d557f548123' => 
    array (
      0 => '/data/web/yaf/h5test.local.com/resources/views/autophp/common/leftbar.html',
      1 => 1535709925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b91e6a6be81e4_56678850 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="easyui-accordion" fit="true" border="false">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bar_tree']->value, 'item_1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item_1']->value) {
?>
	<?php if (!empty($_smarty_tpl->tpl_vars['item_1']->value['privilege'])) {?>
	<div title="<?php echo $_smarty_tpl->tpl_vars['item_1']->value['name'];?>
" style="overflow:auto;">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item_1']->value['sub'], 'item_2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item_2']->value) {
?>
		<?php if (!empty($_smarty_tpl->tpl_vars['item_2']->value['privilege'])) {?>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['item_2']->value['url'];?>
" target="content" title="<?php echo $_smarty_tpl->tpl_vars['item_2']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['item_2']->value['name'];?>
</a></li>
		<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
	<?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
	function show_menu(idname) {
		$("#"+idname).toggle();
	}
<?php echo '</script'; ?>
><?php }
}
