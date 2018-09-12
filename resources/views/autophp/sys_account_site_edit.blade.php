		@extends('autophp.common.index')
		@section('title')
		sys
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">sys</a></li>
					<li class="active">账号站点关联</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/sys_account_site">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/sys_account_site/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：sys >> 账号站点关联">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/sys_account_site/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"account_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"}},"messages":{"account_id":{"required":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection