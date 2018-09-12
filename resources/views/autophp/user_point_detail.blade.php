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
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">user表用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">平台币:</label><span>{{$detail->point}}</span></li><li><label class="display_name">赠送的平台币数量:</label><span>{{$detail->point_free}}</span></li><li><label class="display_name">更新时间戳:</label><span>{{$detail->update_time}}</span></li><li><label class="display_name">最近充值游戏:</label><span>{{$detail->last_pay_game_id}}</span></li><li><label class="display_name">最近充值游戏服务器:</label><span>{{$detail->last_pay_server_id}}</span></li><li><label class="display_name">最近付费渠道id:</label><span>{{$detail->last_pay_channel_id}}</span></li><li><label class="display_name">最近充值金额:</label><span>{{$detail->last_pay_money}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/user_point/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/user_point";
			
		});
	}
</script>
			</div>
		</div>
@endsection