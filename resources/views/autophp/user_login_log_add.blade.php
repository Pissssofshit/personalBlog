		@extends('autophp.common.index')
		@section('title')
		用户管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">用户登陆</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_login_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_login_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户登陆">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/user_login_log/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">用户名</label><input type="text" maxlength="250" name="username" id="username" value="{{isset($detail['username'])?$detail['username']:''}}"></input></li>
<li><label class="display_name">手机号</label><input type="text" maxlength="20" name="mobile" id="mobile" value="{{isset($detail['mobile'])?$detail['mobile']:''}}"></input></li>
<li><label class="display_name">邮箱</label><input type="text" maxlength="100" name="email" id="email" value="{{isset($detail['email'])?$detail['email']:''}}"></input></li>
<li><label class="display_name">登陆时间戳</label><input type="text"  maxlength="16" name="login_time" id="login_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['login_time'])?$detail['login_time']:''}}"></input></li>
<li><label class="display_name">来源渠道标示</label><input type="text" maxlength="11" name="ucode" id="ucode" value="{{isset($detail['ucode'])?$detail['ucode']:''}}"></input></li>
<li><label class="display_name">子渠道标示</label><input type="text" maxlength="250" name="subucode" id="subucode" value="{{isset($detail['subucode'])?$detail['subucode']:''}}"></input></li>
<li><label class="display_name">注册ip</label><input type="text" maxlength="100" name="ip" id="ip" value="{{isset($detail['ip'])?$detail['ip']:''}}"></input></li>
<li><label class="display_name">注册ua</label><input type="text" maxlength="250" name="ua" id="ua" value="{{isset($detail['ua'])?$detail['ua']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='0pc;1android;2ios' >操作系统</a>:</label><input type="text" maxlength="2" name="os" id="os" value="{{isset($detail['os'])?$detail['os']:''}}"></input></li>
<li><label class="display_name">注册设备id</label><input type="text" maxlength="250" name="device_id" id="device_id" value="{{isset($detail['device_id'])?$detail['device_id']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='android为imei；ios为idfa' >物理标识</a>:</label><input type="text" maxlength="250" name="imei" id="imei" value="{{isset($detail['imei'])?$detail['imei']:''}}"></input></li>
<li><label class="display_name">版本</label><input type="text" maxlength="250" name="version" id="version" value="{{isset($detail['version'])?$detail['version']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"user_id":{"required":true,"maxlength":"11"},"username":{"required":true,"maxlength":"250"},"mobile":{"required":true,"maxlength":"20"},"email":{"required":true,"maxlength":"100"},"login_time":{"required":true,"maxlength":16},"ucode":{"required":true,"maxlength":"11"},"subucode":{"required":true,"maxlength":"250"},"ip":{"required":true,"maxlength":"100"},"ua":{"required":true,"maxlength":"250"},"os":{"required":true,"maxlength":"2"},"device_id":{"required":true,"maxlength":"250"},"imei":{"required":true,"maxlength":"250"},"version":{"required":true,"maxlength":"250"}},"messages":{"user_id":{"required":"\u3010\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"username":{"required":"\u3010\u7528\u6237\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7528\u6237\u540d\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"mobile":{"required":"\u3010\u624b\u673a\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u624b\u673a\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc720\u4e2a\u5b57\u7b26"},"email":{"required":"\u3010\u90ae\u7bb1\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u90ae\u7bb1\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"},"login_time":{"required":"\u3010\u767b\u9646\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u767b\u9646\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"ucode":{"required":"\u3010\u6765\u6e90\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6765\u6e90\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"subucode":{"required":"\u3010\u5b50\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5b50\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"ip":{"required":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"},"ua":{"required":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"os":{"required":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0pc;1android;2ios\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0pc;1android;2ios\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"device_id":{"required":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"imei":{"required":"\u3010\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7269\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"version":{"required":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection