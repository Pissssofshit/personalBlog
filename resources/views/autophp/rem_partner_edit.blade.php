		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">平台列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_partner">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_partner/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 平台列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/rem_partner/{{$detail->partner_id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input>
<li><label class="display_name">平台名</label><input type="text" maxlength="40" name="partner_name" id="partner_name" value="{{isset($detail['partner_name'])?$detail['partner_name']:''}}"></input></li>
<li><label class="display_name">账号注册检查链接</label><input type="text" maxlength="255" name="check_url" id="check_url" value="{{isset($detail['check_url'])?$detail['check_url']:''}}"></input></li>
<li><label class="display_name">账号注册链接</label><input type="text" maxlength="255" name="reg_url" id="reg_url" value="{{isset($detail['reg_url'])?$detail['reg_url']:''}}"></input></li>
<li><label class="display_name">账号登录链接</label><input type="text" maxlength="255" name="login_url" id="login_url" value="{{isset($detail['login_url'])?$detail['login_url']:''}}"></input></li>
<li><label class="display_name">账号查询链接</label><input type="text" maxlength="255" name="search_url" id="search_url" value="{{isset($detail['search_url'])?$detail['search_url']:''}}"></input></li>
<li><label class="display_name">获取服务器列表链接</label><input type="text" maxlength="255" name="server_url" id="server_url" value="{{isset($detail['server_url'])?$detail['server_url']:''}}"></input></li>
<li><label class="display_name">素材链接</label><input type="text" maxlength="255" name="cdn_url" id="cdn_url" value="{{isset($detail['cdn_url'])?$detail['cdn_url']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"partner_name":{"required":true,"maxlength":"40"},"check_url":{"required":true,"maxlength":"255"},"reg_url":{"required":true,"maxlength":"255"},"login_url":{"required":true,"maxlength":"255"},"search_url":{"required":true,"maxlength":"255"},"server_url":{"required":false,"maxlength":"255"},"cdn_url":{"required":false,"maxlength":"255"}},"messages":{"partner_name":{"required":"\u3010\u5e73\u53f0\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"check_url":{"required":"\u3010\u8d26\u53f7\u6ce8\u518c\u68c0\u67e5\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u6ce8\u518c\u68c0\u67e5\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"reg_url":{"required":"\u3010\u8d26\u53f7\u6ce8\u518c\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u6ce8\u518c\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"login_url":{"required":"\u3010\u8d26\u53f7\u767b\u5f55\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u767b\u5f55\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"search_url":{"required":"\u3010\u8d26\u53f7\u67e5\u8be2\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7\u67e5\u8be2\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"server_url":{"required":"\u3010\u83b7\u53d6\u670d\u52a1\u5668\u5217\u8868\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u83b7\u53d6\u670d\u52a1\u5668\u5217\u8868\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"cdn_url":{"required":"\u3010\u7d20\u6750\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7d20\u6750\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection