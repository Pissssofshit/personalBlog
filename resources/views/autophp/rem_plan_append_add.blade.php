		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">类型定义</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_plan_append">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_plan_append/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 类型定义">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/rem_plan_append/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">ios游戏id</label><input type="text" maxlength="10" name="ios_game_id" id="ios_game_id" value="{{isset($detail['ios_game_id'])?$detail['ios_game_id']:''}}"></input></li>
<li><label class="display_name">热云url</label><input type="text" maxlength="255" name="re_yun_url" id="re_yun_url" value="{{isset($detail['re_yun_url'])?$detail['re_yun_url']:''}}"></input></li>
<li><label class="display_name">渠道包地址</label><input type="text" maxlength="255" name="package_url" id="package_url" value="{{isset($detail['package_url'])?$detail['package_url']:''}}"></input></li>
<li><label class="display_name">版本号</label><input type="text" maxlength="40" name="version" id="version" value="{{isset($detail['version'])?$detail['version']:''}}"></input></li>
<li><label class="display_name">打包状态</label><input type="text" maxlength="4" name="status" id="status" value="{{isset($detail['status'])?$detail['status']:''}}"></input></li>
<li><label class="display_name">倒计时</label><input type="text" maxlength="4" name="count_down" id="count_down" value="{{isset($detail['count_down'])?$detail['count_down']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"ios_game_id":{"required":true,"maxlength":"10"},"re_yun_url":{"required":false,"maxlength":"255"},"package_url":{"required":false,"maxlength":"255"},"version":{"required":true,"maxlength":"40"},"status":{"required":false,"maxlength":"4"},"count_down":{"required":false,"maxlength":"4"}},"messages":{"ios_game_id":{"required":"\u3010ios\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ios\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"re_yun_url":{"required":"\u3010\u70ed\u4e91url\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u70ed\u4e91url\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"package_url":{"required":"\u3010\u6e20\u9053\u5305\u5730\u5740\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053\u5305\u5730\u5740\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"version":{"required":"\u3010\u7248\u672c\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7248\u672c\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"status":{"required":"\u3010\u6253\u5305\u72b6\u6001\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6253\u5305\u72b6\u6001\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"count_down":{"required":"\u3010\u5012\u8ba1\u65f6\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5012\u8ba1\u65f6\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection