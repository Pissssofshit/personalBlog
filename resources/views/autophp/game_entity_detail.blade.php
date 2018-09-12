		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_entity">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_entity/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">游戏主体名称:</label><span>{{$detail->name}}</span></li><li><label class="display_name">状态:1启用2禁用:</label><span>{{$detail->enable}}</span></li><li><label class="display_name">创建时间戳:</label><span>{{$detail->create_time}}</span></li><li><label class="display_name">更新时间戳:</label><span>{{$detail->update_time}}</span></li><li><label class="display_name">创建者:</label><span>{{$detail->create_by}}</span></li><li><label class="display_name">更新者:</label><span>{{$detail->update_by}}</span></li><li><label class="display_name">代充折扣:</label><span>{{$detail->discount}}</span></li><li><label class="display_name">充值返点:</label><span>{{$detail->back_pay}}</span></li><li><label class="display_name">上架状态:</label><span>{{$detail->status}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/game_entity/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/game_entity";
			
		});
	}
</script>
			</div>
		</div>
@endsection