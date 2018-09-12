		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">账号列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_account">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_account/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 账号列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/rem_account/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">账号名称</label><input type="text" maxlength="40" name="account_name" id="account_name" value="{{isset($detail['account_name'])?$detail['account_name']:''}}"></input></li>
<li><label class="display_name">账号域名</label><input type="text" maxlength="255" name="account_url" id="account_url" value="{{isset($detail['account_url'])?$detail['account_url']:''}}"></input></li>
<li><label class="display_name">公司id</label><input type="text" maxlength="10" name="company_id" id="company_id" value="{{isset($detail['company_id'])?$detail['company_id']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"account_name":{"required":true,"maxlength":"40"},"account_url":{"required":false,"maxlength":"255"},"company_id":{"required":true,"maxlength":"10"}},"messages":{"account_name":{"required":"\u3010\u8d26\u53f7\u540d\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u540d\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"account_url":{"required":"\u3010\u8d26\u53f7\u57df\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u57df\u540d\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"company_id":{"required":"\u3010\u516c\u53f8id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u516c\u53f8id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection