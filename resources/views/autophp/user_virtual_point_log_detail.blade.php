		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">限定币变更日志</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 限定币变更日志">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">平台用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">变更前虚拟币:</label><span>{{$detail->before_point}}</span></li><li><label class="display_name">变更的虚拟币:</label><span>{{$detail->point}}</span></li><li><label class="display_name">变更后的虚拟币:</label><span>{{$detail->after_point}}</span></li><li><label class="display_name">变更类型:</label><span>{{$detail->type}}</span></li><li><label class="display_name">变更说明:</label><span>{{$detail->desc}}</span></li><li><label class="display_name">变更时间戳:</label><span>{{$detail->create_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/user_virtual_point_log/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/user_virtual_point_log";
			
		});
	}
</script>
			</div>
		</div>
@endsection