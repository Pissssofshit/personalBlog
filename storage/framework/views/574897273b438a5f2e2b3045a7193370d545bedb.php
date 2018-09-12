		
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
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="<?php echo e($action_url); ?>" exportaction="<?php echo e($action_url); ?>/export">
			<ul class="searchlegend">
				<li><label class="display_name">用户名</label><input type="text" maxlength="250" name="username" id="username" value="<?php echo e(isset($detail['username'])?$detail['username']:''); ?>"></input></li>
<li><label class="display_name">手机号</label><input type="text" maxlength="20" name="mobile" id="mobile" value="<?php echo e(isset($detail['mobile'])?$detail['mobile']:''); ?>"></input></li>

				<li><input class="kbutton kbutton_A" type="submit" value="搜  索" id="btn_search" /></li>
				<li><input class="kbutton kbutton_A" value=" 导  出 " id="btn_export" /></li>
			</ul>
		</form>
	</fieldset>

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
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
            <?php if(isset($list)&&!empty($list)): ?>
			<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($item->id); ?></td> 
<td><?php echo e($item->username); ?></td> 
<td><?php echo e($item->mobile); ?></td> 
<td><?php echo e($item->reg_time?date('Y-m-d H:i:s',$item->reg_time):''); ?></td> 
<td><?php echo e($item->mobile_bind_time?date('Y-m-d H:i:s',$item->mobile_bind_time):''); ?></td> 
<td><?php echo e($item->email_bind_time?date('Y-m-d H:i:s',$item->email_bind_time):''); ?></td> 
<td><?php echo e($item->source); ?></td> 
<td><?php echo e($item->ucode); ?></td> 
<td><?php echo e($item->os); ?></td> 
<td><?php echo e($item->sex); ?></td> 
<td><?php echo e($item->salt); ?></td> 
<td><a href="/autophp/user/<?php echo e($item->id); ?>">查看</a> 
					<a href="/autophp/user/<?php echo e($item->id); ?>/edit">编辑</a></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</table>
		</div></div>
		<div class="list_page"> <?php echo $page_html; ?></div>
	</fieldset>
			</div>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('autophp.common.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>