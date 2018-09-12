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
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">没用的主键:</label><span>{{$detail->id}}</span></li><li><label class="display_name">平台ID:</label><span>{{$detail->uid}}</span></li><li><label class="display_name">平台账号名:</label><span>{{$detail->passport}}</span></li><li><label class="display_name">平台ID:</label><span>{{$detail->partner_id}}</span></li><li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">服id:</label><span>{{$detail->server_id}}</span></li><li><label class="display_name">站点id:</label><span>{{$detail->site_id}}</span></li><li><label class="display_name">回调参数值:</label><span>{{$detail->res}}</span></li><li><label class="display_name">回调返回值:</label><span>{{$detail->info}}</span></li><li><label class="display_name">插入时间:</label><span>{{$detail->insert_time}}</span></li><li><label class="display_name">回调时间:</label><span>{{$detail->notice_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/channel_callback/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/channel_callback";
			
		});
	}
</script>
			</div>
		</div>
@endsection