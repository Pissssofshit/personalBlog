		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">订单变更日志</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/order_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/order_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 订单变更日志">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/order_log/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="11" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">平台用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">order表id</label><input type="text" maxlength="11" name="order_id" id="order_id" value="{{isset($detail['order_id'])?$detail['order_id']:''}}"></input></li>
<li><label class="display_name">动作名称</label><input type="text" maxlength="255" name="action_name" id="action_name" value="{{isset($detail['action_name'])?$detail['action_name']:''}}"></input></li>
<li><label class="display_name">动作参数</label><input type="text" maxlength="255" name="action_param" id="action_param" value="{{isset($detail['action_param'])?$detail['action_param']:''}}"></input></li>
<li><label class="display_name">动作结果</label><input type="text" maxlength="255" name="action_res" id="action_res" value="{{isset($detail['action_res'])?$detail['action_res']:''}}"></input></li>
<li><label class="display_name">时间戳</label><input type="text"  maxlength="16" name="create_time" id="create_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['create_time'])?$detail['create_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"id":{"required":true,"maxlength":"11"},"user_id":{"required":true,"maxlength":"11"},"order_id":{"required":true,"maxlength":"11"},"action_name":{"required":true,"maxlength":"255"},"action_param":{"required":true,"maxlength":"255"},"action_res":{"required":true,"maxlength":"255"},"create_time":{"required":true,"maxlength":16}},"messages":{"id":{"required":"\u3010ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ID\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_id":{"required":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"order_id":{"required":"\u3010order\u8868id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010order\u8868id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"action_name":{"required":"\u3010\u52a8\u4f5c\u540d\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u52a8\u4f5c\u540d\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"action_param":{"required":"\u3010\u52a8\u4f5c\u53c2\u6570\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u52a8\u4f5c\u53c2\u6570\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"action_res":{"required":"\u3010\u52a8\u4f5c\u7ed3\u679c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u52a8\u4f5c\u7ed3\u679c\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"create_time":{"required":"\u3010\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection