		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">用户管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 用户管理">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/power_user/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">用户帐号</label><input type="text" maxlength="30" name="power_user_name" id="power_user_name" value="{{isset($detail['power_user_name'])?$detail['power_user_name']:''}}"></input></li>
<li><label class="display_name">真实姓名</label><input type="text" maxlength="30" name="truename" id="truename" value="{{isset($detail['truename'])?$detail['truename']:''}}"></input></li>
<li><label class="display_name">密码</label><input type="text" maxlength="32" name="password" id="password" value="{{isset($detail['password'])?$detail['password']:''}}"></input></li>
<li><label class="display_name">角色类型</label><select name="power_role_id" id="power_role_id">
                           @foreach($dict_power_role[1] as $key=>$val)
                            <option value={{$key}} @if($dict_power_role[0]==$key) selected  @endif>{{$val}}</option>
                           @endforeach
                      
                </select></li>

<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"power_user_name":{"required":true,"maxlength":"30"},"truename":{"required":true,"maxlength":"30"},"password":{"required":true,"maxlength":"32"},"power_role_id":{"required":false,"maxlength":"10"},"created_time":{"required":false,"maxlength":16}},"messages":{"power_user_name":{"required":"\u3010\u7528\u6237\u5e10\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7528\u6237\u5e10\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc730\u4e2a\u5b57\u7b26"},"truename":{"required":"\u3010\u771f\u5b9e\u59d3\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u771f\u5b9e\u59d3\u540d\u3011\u4e0d\u80fd\u8d85\u8fc730\u4e2a\u5b57\u7b26"},"password":{"required":"\u3010\u5bc6\u7801\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5bc6\u7801\u3011\u4e0d\u80fd\u8d85\u8fc732\u4e2a\u5b57\u7b26"},"power_role_id":{"required":"\u3010\u89d2\u8272\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u89d2\u8272\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"created_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection