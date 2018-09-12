		
		<?php $__env->startSection('title'); ?>
		用户管理
		<?php $__env->stopSection(); ?>
         <?php $__env->startSection('content'); ?>
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">用户</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">UID:</label><span><?php echo e($detail->id); ?></span></li><li><label class="display_name">用户名:</label><span><?php echo e($detail->username); ?></span></li><li><label class="display_name">手机号:</label><span><?php echo e($detail->mobile); ?></span></li><li><label class="display_name">邮箱:</label><span><?php echo e($detail->email); ?></span></li><li><label class="display_name">加密密码:</label><span><?php echo e($detail->password); ?></span></li><li><label class="display_name">注册时间戳:</label><span><?php echo e($detail->reg_time); ?></span></li><li><label class="display_name">手机绑定时间戳:</label><span><?php echo e($detail->mobile_bind_time); ?></span></li><li><label class="display_name">邮箱绑定时间戳:</label><span><?php echo e($detail->email_bind_time); ?></span></li><li><label class="display_name">来源1:1自然量2公会:</label><span><?php echo e($detail->source); ?></span></li><li><label class="display_name">来源2:渠道标识:</label><span><?php echo e($detail->ucode); ?></span></li><li><label class="display_name">来源3:子渠道扩展标示:</label><span><?php echo e($detail->subucode); ?></span></li><li><label class="display_name">注册ip:</label><span><?php echo e($detail->ip); ?></span></li><li><label class="display_name">注册ua:</label><span><?php echo e($detail->ua); ?></span></li><li><label class="display_name">操作系统:0-pc;1-android;2-ios:</label><span><?php echo e($detail->os); ?></span></li><li><label class="display_name">注册设备id:</label><span><?php echo e($detail->device_id); ?></span></li><li><label class="display_name">物理标识:android为imei；ios为idfa:</label><span><?php echo e($detail->imei); ?></span></li><li><label class="display_name">昵称:</label><span><?php echo e($detail->nickname); ?></span></li><li><label class="display_name">性别:1男2女:</label><span><?php echo e($detail->sex); ?></span></li><li><label class="display_name">头像:</label><span><?php echo e($detail->head_icon); ?></span></li><li><label class="display_name">:</label><span><?php echo e($detail->idcard); ?></span></li><li><label class="display_name">:</label><span><?php echo e($detail->realname); ?></span></li><li><label class="display_name">盐值:</label><span><?php echo e($detail->salt); ?></span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./<?php echo e($detail->id); ?>/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/user/<?php echo e($detail->id); ?>', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "<?php echo e($csrf_token); ?>" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/user";
			
		});
	}
</script>
			</div>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('autophp.common.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>