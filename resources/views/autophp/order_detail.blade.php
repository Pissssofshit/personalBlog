		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">订单</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/order">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/order/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 订单">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">平台用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">游戏订单号:</label><span>{{$detail->game_order_id}}</span></li><li><label class="display_name">渠道标示:</label><span>{{$detail->ucode}}</span></li><li><label class="display_name">子渠道标示:</label><span>{{$detail->subucode}}</span></li><li><label class="display_name">游戏服务器:</label><span>{{$detail->server_id}}</span></li><li><label class="display_name">游戏角色名:</label><span>{{$detail->role_name}}</span></li><li><label class="display_name">订单描述:</label><span>{{$detail->desc}}</span></li><li><label class="display_name">游戏币数量:</label><span>{{$detail->order_coin}}</span></li><li><label class="display_name">订单金额:</label><span>{{$detail->order_money}}</span></li><li><label class="display_name">支付方式:0-平台币;pay_channel里的id:</label><span>{{$detail->pay_channel_id}}</span></li><li><label class="display_name">支付平台币数量:</label><span>{{$detail->pay_point}}</span></li><li><label class="display_name">支付的平台赠送平台币数量:</label><span>{{$detail->pay_point_free}}</span></li><li><label class="display_name">实际支付金额:</label><span>{{$detail->pay_money}}</span></li><li><label class="display_name">透传字段:SDK提交过来需透传的字段:</label><span>{{$detail->extra}}</span></li><li><label class="display_name">支付的虚拟货币:</label><span>{{$detail->pay_virtual_point}}</span></li><li><label class="display_name">创建时间戳:</label><span>{{$detail->create_time}}</span></li><li><label class="display_name">更新时间戳:</label><span>{{$detail->update_time}}</span></li><li><label class="display_name">订单状态:1-已创建；2-已提交第三方；3-第三方充值成功；4-调用游戏后台接口下发游戏币成功；5-等待继续支付；6-支付超时；7-支付失败:</label><span>{{$detail->status}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/order/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/order";
			
		});
	}
</script>
			</div>
		</div>
@endsection