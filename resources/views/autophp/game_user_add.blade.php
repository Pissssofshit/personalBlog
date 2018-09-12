		@extends('autophp.common.index')
		@section('title')
		用户管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">用户游戏表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户游戏表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/game_user/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">游戏id</label><input type="text" maxlength="11" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">平台用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">游戏用户名</label><input type="text" maxlength="250" name="name" id="name" value="{{isset($detail['name'])?$detail['name']:''}}"></input></li>
<li><label class="display_name">渠道标示</label><input type="text" maxlength="11" name="ucode" id="ucode" value="{{isset($detail['ucode'])?$detail['ucode']:''}}"></input></li>
<li><label class="display_name">子渠道标示</label><input type="text" maxlength="250" name="subucode" id="subucode" value="{{isset($detail['subucode'])?$detail['subucode']:''}}"></input></li>
<li><label class="display_name">注册ip</label><input type="text" maxlength="100" name="ip" id="ip" value="{{isset($detail['ip'])?$detail['ip']:''}}"></input></li>
<li><label class="display_name">注册ua</label><input type="text" maxlength="250" name="ua" id="ua" value="{{isset($detail['ua'])?$detail['ua']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='0-pc;1-android;2-ios' >操作系统</a>:</label><input type="text" maxlength="2" name="os" id="os" value="{{isset($detail['os'])?$detail['os']:''}}"></input></li>
<li><label class="display_name">注册设备id</label><input type="text" maxlength="250" name="device_id" id="device_id" value="{{isset($detail['device_id'])?$detail['device_id']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='android为imei；ios为idfa' >特理标识</a>:</label><input type="text" maxlength="250" name="imei" id="imei" value="{{isset($detail['imei'])?$detail['imei']:''}}"></input></li>
<li><label class="display_name">版本</label><input type="text" maxlength="250" name="version" id="version" value="{{isset($detail['version'])?$detail['version']:''}}"></input></li>
<li><label class="display_name">注册时间戳</label><input type="text"  maxlength="16" name="reg_time" id="reg_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time'])?$detail['reg_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"game_id":{"required":true,"maxlength":"11"},"user_id":{"required":true,"maxlength":"11"},"name":{"required":true,"maxlength":"250"},"ucode":{"required":true,"maxlength":"11"},"subucode":{"required":true,"maxlength":"250"},"ip":{"required":true,"maxlength":"100"},"ua":{"required":true,"maxlength":"250"},"os":{"required":true,"maxlength":"2"},"device_id":{"required":true,"maxlength":"250"},"imei":{"required":true,"maxlength":"250"},"version":{"required":true,"maxlength":"250"},"reg_time":{"required":true,"maxlength":16}},"messages":{"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_id":{"required":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"name":{"required":"\u3010\u6e38\u620f\u7528\u6237\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620f\u7528\u6237\u540d\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"ucode":{"required":"\u3010\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"subucode":{"required":"\u3010\u5b50\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5b50\u6e20\u9053\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"ip":{"required":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cip\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"},"ua":{"required":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518cua\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"os":{"required":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u64cd\u4f5c\u7cfb\u7edf:0-pc;1-android;2-ios\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"device_id":{"required":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u8bbe\u5907id\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"imei":{"required":"\u3010\u7279\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7279\u7406\u6807\u8bc6:android\u4e3aimei\uff1bios\u4e3aidfa\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"version":{"required":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"reg_time":{"required":"\u3010\u6ce8\u518c\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection