		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">平台币</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_point">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_point/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 平台币">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/user_point/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="11" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">user表用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">平台币</label><input type="text" maxlength="11" name="point" id="point" value="{{isset($detail['point'])?$detail['point']:''}}"></input></li>
<li><label class="display_name">赠送的平台币数量</label><input type="text" maxlength="11" name="point_free" id="point_free" value="{{isset($detail['point_free'])?$detail['point_free']:''}}"></input></li>
<li><label class="display_name">更新时间戳</label><input type="text"  maxlength="16" name="update_time" id="update_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['update_time'])?$detail['update_time']:''}}"></input></li>
<li><label class="display_name">最近充值游戏</label><input type="text" maxlength="11" name="last_pay_game_id" id="last_pay_game_id" value="{{isset($detail['last_pay_game_id'])?$detail['last_pay_game_id']:''}}"></input></li>
<li><label class="display_name">最近充值游戏服务器</label><input type="text" maxlength="255" name="last_pay_server_id" id="last_pay_server_id" value="{{isset($detail['last_pay_server_id'])?$detail['last_pay_server_id']:''}}"></input></li>
<li><label class="display_name">最近付费渠道id</label><input type="text" maxlength="11" name="last_pay_channel_id" id="last_pay_channel_id" value="{{isset($detail['last_pay_channel_id'])?$detail['last_pay_channel_id']:''}}"></input></li>
<li><label class="display_name">最近充值金额</label><input type="text" maxlength="11" name="last_pay_money" id="last_pay_money" value="{{isset($detail['last_pay_money'])?$detail['last_pay_money']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"id":{"required":true,"maxlength":"11"},"user_id":{"required":true,"maxlength":"11"},"point":{"required":true,"maxlength":"11"},"point_free":{"required":true,"maxlength":"11"},"update_time":{"required":true,"maxlength":16},"last_pay_game_id":{"required":true,"maxlength":"11"},"last_pay_server_id":{"required":true,"maxlength":"255"},"last_pay_channel_id":{"required":true,"maxlength":"11"},"last_pay_money":{"required":true,"maxlength":"11"}},"messages":{"id":{"required":"\u3010ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ID\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_id":{"required":"\u3010user\u8868\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010user\u8868\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"point":{"required":"\u3010\u5e73\u53f0\u5e01\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u5e01\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"point_free":{"required":"\u3010\u8d60\u9001\u7684\u5e73\u53f0\u5e01\u6570\u91cf\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d60\u9001\u7684\u5e73\u53f0\u5e01\u6570\u91cf\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"update_time":{"required":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"last_pay_game_id":{"required":"\u3010\u6700\u8fd1\u5145\u503c\u6e38\u620f\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6700\u8fd1\u5145\u503c\u6e38\u620f\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"last_pay_server_id":{"required":"\u3010\u6700\u8fd1\u5145\u503c\u6e38\u620f\u670d\u52a1\u5668\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6700\u8fd1\u5145\u503c\u6e38\u620f\u670d\u52a1\u5668\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"last_pay_channel_id":{"required":"\u3010\u6700\u8fd1\u4ed8\u8d39\u6e20\u9053id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6700\u8fd1\u4ed8\u8d39\u6e20\u9053id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"last_pay_money":{"required":"\u3010\u6700\u8fd1\u5145\u503c\u91d1\u989d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6700\u8fd1\u5145\u503c\u91d1\u989d\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection