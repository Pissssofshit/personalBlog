		@extends('autophp.common.index')
		@section('title')
		用户管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">用户游戏表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 用户游戏表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">平台用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">游戏用户名:</label><span>{{$detail->name}}</span></li><li><label class="display_name">渠道标示:</label><span>{{$detail->ucode}}</span></li><li><label class="display_name">子渠道标示:</label><span>{{$detail->subucode}}</span></li><li><label class="display_name">注册ip:</label><span>{{$detail->ip}}</span></li><li><label class="display_name">注册ua:</label><span>{{$detail->ua}}</span></li><li><label class="display_name">操作系统:0-pc;1-android;2-ios:</label><span>{{$detail->os}}</span></li><li><label class="display_name">注册设备id:</label><span>{{$detail->device_id}}</span></li><li><label class="display_name">特理标识:android为imei；ios为idfa:</label><span>{{$detail->imei}}</span></li><li><label class="display_name">版本:</label><span>{{$detail->version}}</span></li><li><label class="display_name">注册时间戳:</label><span>{{$detail->reg_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/game_user/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/game_user";
			
		});
	}
</script>
			</div>
		</div>
@endsection