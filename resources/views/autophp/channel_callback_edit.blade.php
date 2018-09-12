		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">页游渠道回调</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/channel_callback">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/channel_callback/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 页游渠道回调">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/channel_callback/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="uid" id="uid" value="{{isset($detail['uid'])?$detail['uid']:''}}"></input></li>
<li><label class="display_name">平台账号名</label><input type="text" maxlength="40" name="passport" id="passport" value="{{isset($detail['passport'])?$detail['passport']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">服id</label><input type="text" maxlength="10" name="server_id" id="server_id" value="{{isset($detail['server_id'])?$detail['server_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">回调参数值</label><input type="text" maxlength="255" name="res" id="res" value="{{isset($detail['res'])?$detail['res']:''}}"></input></li>
<li><label class="display_name">回调返回值</label><input type="text" maxlength="255" name="info" id="info" value="{{isset($detail['info'])?$detail['info']:''}}"></input></li>
<li><label class="display_name">插入时间</label><input type="text"  maxlength="16" name="insert_time" id="insert_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['insert_time'])?$detail['insert_time']:''}}"></input></li>
<li><label class="display_name">回调时间</label><input type="text"  maxlength="16" name="notice_time" id="notice_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['notice_time'])?$detail['notice_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"uid":{"required":true,"maxlength":"10"},"passport":{"required":true,"maxlength":"40"},"partner_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"server_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"res":{"required":false,"maxlength":"255"},"info":{"required":false,"maxlength":"255"},"insert_time":{"required":true,"maxlength":16},"notice_time":{"required":true,"maxlength":16}},"messages":{"uid":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"passport":{"required":"\u3010\u5e73\u53f0\u8d26\u53f7\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u8d26\u53f7\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"partner_id":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"server_id":{"required":"\u3010\u670did\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u670did\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"res":{"required":"\u3010\u56de\u8c03\u53c2\u6570\u503c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u53c2\u6570\u503c\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"info":{"required":"\u3010\u56de\u8c03\u8fd4\u56de\u503c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u8fd4\u56de\u503c\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"insert_time":{"required":"\u3010\u63d2\u5165\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u63d2\u5165\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"notice_time":{"required":"\u3010\u56de\u8c03\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection