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
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">平台用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">order表id:</label><span>{{$detail->order_id}}</span></li><li><label class="display_name">动作名称:</label><span>{{$detail->action_name}}</span></li><li><label class="display_name">动作参数:</label><span>{{$detail->action_param}}</span></li><li><label class="display_name">动作结果:</label><span>{{$detail->action_res}}</span></li><li><label class="display_name">时间戳:</label><span>{{$detail->create_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/order_log/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/order_log";
			
		});
	}
</script>
			</div>
		</div>
@endsection