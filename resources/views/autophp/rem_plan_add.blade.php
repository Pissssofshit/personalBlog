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
				<li class="admin_tab"><a href="/autophp/rem_plan">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_plan/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 类型定义">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/rem_plan/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">计划名</label><input type="text" maxlength="40" name="plan_name" id="plan_name" value="{{isset($detail['plan_name'])?$detail['plan_name']:''}}"></input></li>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">状态</label><input type="text" maxlength="4" name="state" id="state" value="{{isset($detail['state'])?$detail['state']:''}}"></input></li>
<li><label class="display_name">是否启用过</label><input type="text" maxlength="2" name="is_1st" id="is_1st" value="{{isset($detail['is_1st'])?$detail['is_1st']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">推广方式</label><input type="text" maxlength="4" name="mode_id" id="mode_id" value="{{isset($detail['mode_id'])?$detail['mode_id']:''}}"></input></li>


<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"plan_name":{"required":true,"maxlength":"40"},"account_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"state":{"required":false,"maxlength":"4"},"is_1st":{"required":false,"maxlength":"2"},"category_id":{"required":true,"maxlength":"4"},"mode_id":{"required":true,"maxlength":"4"},"created_time":{"required":false,"maxlength":16},"updated_time":{"required":false,"maxlength":16}},"messages":{"plan_name":{"required":"\u3010\u8ba1\u5212\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba1\u5212\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"account_id":{"required":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"state":{"required":"\u3010\u72b6\u6001\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u72b6\u6001\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"is_1st":{"required":"\u3010\u662f\u5426\u542f\u7528\u8fc7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u662f\u5426\u542f\u7528\u8fc7\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"mode_id":{"required":"\u3010\u63a8\u5e7f\u65b9\u5f0f\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u63a8\u5e7f\u65b9\u5f0f\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"created_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"updated_time":{"required":"\u3010\u66f4\u65b0\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection