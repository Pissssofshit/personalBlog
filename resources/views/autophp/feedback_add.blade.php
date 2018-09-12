		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">手游渠道回调</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/feedback">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/feedback/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 手游渠道回调">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/feedback/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">渠道回调方法名</label><input type="text" maxlength="40" name="type_alias" id="type_alias" value="{{isset($detail['type_alias'])?$detail['type_alias']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">设备号</label><input type="text" maxlength="255" name="click_id" id="click_id" value="{{isset($detail['click_id'])?$detail['click_id']:''}}"></input></li>
<li><label class="display_name">设备类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">ip</label><input type="text" maxlength="32" name="ip" id="ip" value="{{isset($detail['ip'])?$detail['ip']:''}}"></input></li>
<li><label class="display_name">回调链接</label><input type="text" maxlength="255" name="callback_url" id="callback_url" value="{{isset($detail['callback_url'])?$detail['callback_url']:''}}"></input></li>
<li><label class="display_name">插入时间</label><input type="text"  maxlength="16" name="insert_time" id="insert_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['insert_time'])?$detail['insert_time']:''}}"></input></li>
<li><label class="display_name">回调时间</label><input type="text"  maxlength="16" name="notice_time" id="notice_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['notice_time'])?$detail['notice_time']:''}}"></input></li>
<li><label class="display_name">匹配时间</label><input type="text"  maxlength="16" name="match_time" id="match_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['match_time'])?$detail['match_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"type_alias":{"required":true,"maxlength":"40"},"partner_id":{"required":true,"maxlength":"10"},"plan_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"click_id":{"required":false,"maxlength":"255"},"category_id":{"required":true,"maxlength":"4"},"ip":{"required":false,"maxlength":"32"},"callback_url":{"required":false,"maxlength":"255"},"insert_time":{"required":true,"maxlength":16},"notice_time":{"required":true,"maxlength":16},"match_time":{"required":true,"maxlength":16}},"messages":{"type_alias":{"required":"\u3010\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053\u56de\u8c03\u65b9\u6cd5\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"partner_id":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"plan_id":{"required":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"click_id":{"required":"\u3010\u8bbe\u5907\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8bbe\u5907\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u8bbe\u5907\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8bbe\u5907\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"ip":{"required":"\u3010ip\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ip\u3011\u4e0d\u80fd\u8d85\u8fc732\u4e2a\u5b57\u7b26"},"callback_url":{"required":"\u3010\u56de\u8c03\u94fe\u63a5\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u94fe\u63a5\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"insert_time":{"required":"\u3010\u63d2\u5165\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u63d2\u5165\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"notice_time":{"required":"\u3010\u56de\u8c03\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"match_time":{"required":"\u3010\u5339\u914d\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5339\u914d\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection