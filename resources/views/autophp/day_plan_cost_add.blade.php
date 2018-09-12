		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">成本提交表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/day_plan_cost">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/day_plan_cost/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 成本提交表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/day_plan_cost/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">成本所属时间戳</label><input type="text"  maxlength="16" name="day_time" id="day_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['day_time'])?$detail['day_time']:''}}"></input></li>
<li><label class="display_name">成本所属日期</label><input type="text" maxlength="10" name="day_date" id="day_date" value="{{isset($detail['day_date'])?$detail['day_date']:''}}"></input></li>
<li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>



<li><label class="display_name">提交者</label><input type="text" maxlength="255" name="create_by" id="create_by" value="{{isset($detail['create_by'])?$detail['create_by']:''}}"></input></li>
<li><label class="display_name">通过者</label><input type="text" maxlength="255" name="pass_by" id="pass_by" value="{{isset($detail['pass_by'])?$detail['pass_by']:''}}"></input></li>
<li><label class="display_name">是否已经通过</label><input type="text" maxlength="2" name="is_passed" id="is_passed" value="{{isset($detail['is_passed'])?$detail['is_passed']:''}}"></input></li>

<li><label class="display_name">通过时间</label><input type="text"  maxlength="16" name="pass_time" id="pass_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['pass_time'])?$detail['pass_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"day_time":{"required":true,"maxlength":16},"day_date":{"required":true,"maxlength":"10"},"plan_id":{"required":true,"maxlength":"10"},"account_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"create_by":{"required":false,"maxlength":"255"},"pass_by":{"required":false,"maxlength":"255"},"is_passed":{"required":false,"maxlength":"2"},"created_time":{"required":false,"maxlength":16},"pass_time":{"required":false,"maxlength":16}},"messages":{"day_time":{"required":"\u3010\u6210\u672c\u6240\u5c5e\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6210\u672c\u6240\u5c5e\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"day_date":{"required":"\u3010\u6210\u672c\u6240\u5c5e\u65e5\u671f\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6210\u672c\u6240\u5c5e\u65e5\u671f\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"plan_id":{"required":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"account_id":{"required":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"create_by":{"required":"\u3010\u63d0\u4ea4\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u63d0\u4ea4\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"pass_by":{"required":"\u3010\u901a\u8fc7\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u901a\u8fc7\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"is_passed":{"required":"\u3010\u662f\u5426\u5df2\u7ecf\u901a\u8fc7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u662f\u5426\u5df2\u7ecf\u901a\u8fc7\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"created_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"pass_time":{"required":"\u3010\u901a\u8fc7\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u901a\u8fc7\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection