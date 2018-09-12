		@extends('autophp.common.index')
		@section('title')
		用户管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">第三方用户</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/third_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/third_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 第三方用户">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/third_user/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name"><a href='javascript:' title='user表用户id' >UID</a>:</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='如weixin' >开放平台标示</a>:</label><input type="text" maxlength="250" name="app_type" id="app_type" value="{{isset($detail['app_type'])?$detail['app_type']:''}}"></input></li>
<li><label class="display_name">开放平台用户标示</label><input type="text" maxlength="250" name="openid" id="openid" value="{{isset($detail['openid'])?$detail['openid']:''}}"></input></li>
<li><label class="display_name">开放平台访问令牌</label><input type="text" maxlength="250" name="access_token" id="access_token" value="{{isset($detail['access_token'])?$detail['access_token']:''}}"></input></li>
<li><label class="display_name">令牌实效时间</label><input type="text"  maxlength="16" name="token_expire_time" id="token_expire_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['token_expire_time'])?$detail['token_expire_time']:''}}"></input></li>
<li><label class="display_name">刷新令牌</label><input type="text" maxlength="11" name="refresh_token" id="refresh_token" value="{{isset($detail['refresh_token'])?$detail['refresh_token']:''}}"></input></li>
<li><label class="display_name">开放平台返回的用户信息</label><input type="text" maxlength="" name="user_info" id="user_info" value="{{isset($detail['user_info'])?$detail['user_info']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"user_id":{"required":true,"maxlength":"11"},"app_type":{"required":true,"maxlength":"250"},"openid":{"required":true,"maxlength":"250"},"access_token":{"required":true,"maxlength":"250"},"token_expire_time":{"required":true,"maxlength":16},"refresh_token":{"required":true,"maxlength":"11"},"user_info":{"required":true,"maxlength":""}},"messages":{"user_id":{"required":"\u3010UID:user\u8868\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010UID:user\u8868\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"app_type":{"required":"\u3010\u5f00\u653e\u5e73\u53f0\u6807\u793a:\u5982weixin\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5f00\u653e\u5e73\u53f0\u6807\u793a:\u5982weixin\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"openid":{"required":"\u3010\u5f00\u653e\u5e73\u53f0\u7528\u6237\u6807\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5f00\u653e\u5e73\u53f0\u7528\u6237\u6807\u793a\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"access_token":{"required":"\u3010\u5f00\u653e\u5e73\u53f0\u8bbf\u95ee\u4ee4\u724c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5f00\u653e\u5e73\u53f0\u8bbf\u95ee\u4ee4\u724c\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"token_expire_time":{"required":"\u3010\u4ee4\u724c\u5b9e\u6548\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4ee4\u724c\u5b9e\u6548\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"refresh_token":{"required":"\u3010\u5237\u65b0\u4ee4\u724c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5237\u65b0\u4ee4\u724c\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_info":{"required":"\u3010\u5f00\u653e\u5e73\u53f0\u8fd4\u56de\u7684\u7528\u6237\u4fe1\u606f\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5f00\u653e\u5e73\u53f0\u8fd4\u56de\u7684\u7528\u6237\u4fe1\u606f\u3011\u4e0d\u80fd\u8d85\u8fc7\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection