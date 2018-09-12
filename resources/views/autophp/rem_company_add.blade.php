		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">公司列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_company">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_company/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 公司列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/rem_company/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">渠道回调方法名</label><input type="text" maxlength="40" name="type_alias" id="type_alias" value="{{isset($detail['type_alias'])?$detail['type_alias']:''}}"></input></li>
<li><label class="display_name">渠道ID</label><input type="text" maxlength="10" name="channel_id" id="channel_id" value="{{isset($detail['channel_id'])?$detail['channel_id']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"type_alias":{"required":true,"maxlength":"40"},"channel_id":{"required":true,"maxlength":"10"}},"messages":{"type_alias":{"required":"\u3010\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"channel_id":{"required":"\u3010\u6e20\u9053ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection