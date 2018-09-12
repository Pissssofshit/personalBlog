		
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
	<legend>添加</legend>
	<form action="/autophp/user/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='<?php echo e($csrf_token); ?>'><li><label class="display_name">用户名</label><input type="text" maxlength="250" name="username" id="username" value="<?php echo e(isset($detail['username'])?$detail['username']:''); ?>"></input></li>
<li><label class="display_name">手机号</label><input type="text" maxlength="20" name="mobile" id="mobile" value="<?php echo e(isset($detail['mobile'])?$detail['mobile']:''); ?>"></input></li>
<li><label class="display_name">邮箱</label><input type="text" maxlength="250" name="email" id="email" value="<?php echo e(isset($detail['email'])?$detail['email']:''); ?>"></input></li>
<li><label class="display_name">加密密码</label><input type="text" maxlength="250" name="password" id="password" value="<?php echo e(isset($detail['password'])?$detail['password']:''); ?>"></input></li>
<li><label class="display_name">注册时间戳</label><input type="text"  maxlength="16" name="reg_time" id="reg_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo e(isset($detail['reg_time'])?$detail['reg_time']:''); ?>"></input></li>
<li><label class="display_name">手机绑定时间戳</label><input type="text"  maxlength="16" name="mobile_bind_time" id="mobile_bind_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo e(isset($detail['mobile_bind_time'])?$detail['mobile_bind_time']:''); ?>"></input></li>
<li><label class="display_name">邮箱绑定时间戳</label><input type="text"  maxlength="16" name="email_bind_time" id="email_bind_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo e(isset($detail['email_bind_time'])?$detail['email_bind_time']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='1自然量2公会' >来源1</a>:</label><input type="text" maxlength="2" name="source" id="source" value="<?php echo e(isset($detail['source'])?$detail['source']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='渠道标识' >来源2</a>:</label><input type="text" maxlength="11" name="ucode" id="ucode" value="<?php echo e(isset($detail['ucode'])?$detail['ucode']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='子渠道扩展标示' >来源3</a>:</label><input type="text" maxlength="250" name="subucode" id="subucode" value="<?php echo e(isset($detail['subucode'])?$detail['subucode']:''); ?>"></input></li>
<li><label class="display_name">注册ip</label><input type="text" maxlength="250" name="ip" id="ip" value="<?php echo e(isset($detail['ip'])?$detail['ip']:''); ?>"></input></li>
<li><label class="display_name">注册ua</label><input type="text" maxlength="250" name="ua" id="ua" value="<?php echo e(isset($detail['ua'])?$detail['ua']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='0-pc;1-android;2-ios' >操作系统</a>:</label><input type="text" maxlength="2" name="os" id="os" value="<?php echo e(isset($detail['os'])?$detail['os']:''); ?>"></input></li>
<li><label class="display_name">注册设备id</label><input type="text" maxlength="250" name="device_id" id="device_id" value="<?php echo e(isset($detail['device_id'])?$detail['device_id']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='android为imei；ios为idfa' >物理标识</a>:</label><input type="text" maxlength="250" name="imei" id="imei" value="<?php echo e(isset($detail['imei'])?$detail['imei']:''); ?>"></input></li>
<li><label class="display_name">昵称</label><input type="text" maxlength="250" name="nickname" id="nickname" value="<?php echo e(isset($detail['nickname'])?$detail['nickname']:''); ?>"></input></li>
<li><label class="display_name"><a href='javascript:' title='1男2女' >性别</a>:</label><input type="text" maxlength="2" name="sex" id="sex" value="<?php echo e(isset($detail['sex'])?$detail['sex']:''); ?>"></input></li>
<li><label class="display_name">头像</label><input type="text" maxlength="250" name="head_icon" id="head_icon" value="<?php echo e(isset($detail['head_icon'])?$detail['head_icon']:''); ?>"></input></li>
<li><label class="display_name"></label><input type="text" maxlength="18" name="idcard" id="idcard" value="<?php echo e(isset($detail['idcard'])?$detail['idcard']:''); ?>"></input></li>
<li><label class="display_name"></label><input type="text" maxlength="250" name="realname" id="realname" value="<?php echo e(isset($detail['realname'])?$detail['realname']:''); ?>"></input></li>
<li><label class="display_name">盐值</label><input type="text" maxlength="20" name="salt" id="salt" value="<?php echo e(isset($detail['salt'])?$detail['salt']:''); ?>"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"username":{"required":true,"maxlength":"250"},"mobile":{"required":true,"maxlength":"20"},"email":{"required":true,"maxlength":"250"},"password":{"required":true,"maxlength":"250"},"reg_time":{"required":true,"maxlength":16},"mobile_bind_time":{"required":true,"maxlength":16},"email_bind_time":{"required":true,"maxlength":16},"source":{"required":true,"maxlength":"2"},"ucode":{"required":true,"maxlength":"11"},"subucode":{"required":true,"maxlength":"250"},"ip":{"required":true,"maxlength":"250"},"ua":{"required":true,"maxlength":"250"},"os":{"required":true,"maxlength":"2"},"device_id":{"required":true,"maxlength":"250"},"imei":{"required":true,"maxlength":"250"},"nickname":{"required":true,"maxlength":"250"},"sex":{"required":true,"maxlength":"2"},"head_icon":{"required":true,"maxlength":"250"},"idcard":{"required":true,"maxlength":"18"},"realname":{"required":true,"maxlength":"250"},"salt":{"required":true,"maxlength":"20"}},"messages":{"username":{"required":"\u3010\u7528\u6237\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7528\u6237\u540d\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"mobile":{"required":"\u3010\u624b\u673a\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u624b\u673a\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc720\u4e2a\u5b57\u7b26"},"email":{"required":"\u3010\u90ae\u7bb1\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u90ae\u7bb1\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"password":{"required":"\u3010\u52a0\u5bc6\u5bc6\u7801\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u52a0\u5bc6\u5bc6\u7801\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"reg_time":{"required":"\u3010\u6ce8\u518c\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"mobile_bind_time":{"required":"\u3010\u624b\u673a\u7ed1\u5b9a\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u624b\u673a\u7ed1\u5b9a\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"email_bind_time":{"required":"\u3010\u90ae\u7bb1\u7ed1\u5b9a\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u90ae\u7bb1\u7ed1\u5b9a\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"source":{"required":"\u3010\u6765\u6e901:1\u81ea\u7136\u91cf2\u516c\u4f1a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6765\u6e901:1\u81ea\u7136\u91cf2\u516c\u4f1a\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"ucode":{"required":"\u3010\u6765\u6e902:\u6e20\u9053\u6807\u8bc6\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6765\u6e902:\u6e20\u9053\u6807\u8bc6\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"subucode":{"required":"\u3010\u6765\u6e903:\u5b50\u6e20\u9053\u6269\u5c55\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6765\u6e903:\u5b50\u6e20\u9053\u6269\u5c55\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"ip":{"required":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"ua":{"required":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"os":{"required":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"device_id":{"required":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"imei":{"required":"\u3010\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"nickname":{"required":"\u3010\u6635\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6635\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"sex":{"required":"\u3010\u6027\u522b:1\u75372\u5973\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6027\u522b:1\u75372\u5973\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"head_icon":{"required":"\u3010\u5934\u50cf\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5934\u50cf\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"idcard":{"required":"\u3010\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u3011\u4e0d\u80fd\u8d85\u8fc718\u4e2a\u5b57\u7b26"},"realname":{"required":"\u3010\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"salt":{"required":"\u3010\u76d0\u503c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u76d0\u503c\u3011\u4e0d\u80fd\u8d85\u8fc720\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('autophp.common.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>