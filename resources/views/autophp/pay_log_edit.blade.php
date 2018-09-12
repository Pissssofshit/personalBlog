		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">充值订单表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/pay_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/pay_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 充值订单表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/pay_log/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">订单号</label><input type="text" maxlength="32" name="order_id" id="order_id" value="{{isset($detail['order_id'])?$detail['order_id']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="uid" id="uid" value="{{isset($detail['uid'])?$detail['uid']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">服id</label><input type="text" maxlength="10" name="server_id" id="server_id" value="{{isset($detail['server_id'])?$detail['server_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">注册时间</label><input type="text"  maxlength="16" name="reg_time" id="reg_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time'])?$detail['reg_time']:''}}"></input></li>
<li><label class="display_name">充值时间</label><input type="text"  maxlength="16" name="pay_time" id="pay_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['pay_time'])?$detail['pay_time']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="10" name="pay_money" id="pay_money" value="{{isset($detail['pay_money'])?$detail['pay_money']:''}}"></input></li>
<li><label class="display_name">首充</label><input type="text" maxlength="2" name="is_1st_pay" id="is_1st_pay" value="{{isset($detail['is_1st_pay'])?$detail['is_1st_pay']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"order_id":{"required":true,"maxlength":"32"},"uid":{"required":true,"maxlength":"10"},"partner_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"server_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"reg_time":{"required":true,"maxlength":16},"pay_time":{"required":true,"maxlength":16},"pay_money":{"required":true,"maxlength":"10"},"is_1st_pay":{"required":false,"maxlength":"2"}},"messages":{"order_id":{"required":"\u3010\u8ba2\u5355\u53f7\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba2\u5355\u53f7\u3011\u4e0d\u80fd\u8d85\u8fc732\u4e2a\u5b57\u7b26"},"uid":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"partner_id":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"server_id":{"required":"\u3010\u670did\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u670did\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"reg_time":{"required":"\u3010\u6ce8\u518c\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"pay_time":{"required":"\u3010\u5145\u503c\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5145\u503c\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"pay_money":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"is_1st_pay":{"required":"\u3010\u9996\u5145\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u9996\u5145\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection