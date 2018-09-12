		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏开关</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_config_switch">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_config_switch/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏开关">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">广告统计app开关:1开启;2关闭:</label><span>{{$detail->ad_stat_switch}}</span></li><li><label class="display_name">广告统计参数:</label><span>{{$detail->ad_stat_key}}</span></li><li><label class="display_name">微信开关:1开启;2关闭:</label><span>{{$detail->weixin_switch}}</span></li><li><label class="display_name">app id:</label><span>{{$detail->weixin_app_id}}</span></li><li><label class="display_name">app key:</label><span>{{$detail->weixin_app_key}}</span></li><li><label class="display_name">app secret:</label><span>{{$detail->weixin_app_secret}}</span></li><li><label class="display_name">平台闪屏开关:游戏启动动画是否播放平台logo:</label><span>{{$detail->show_platform_switch}}</span></li><li><label class="display_name">充值邦定手机提示:</label><span>{{$detail->bind_mobile_when_pay_switch}}</span></li><li><label class="display_name">一键注册开关:</label><span>{{$detail->one_key_registe_switch}}</span></li><li><label class="display_name">创建时间戳:</label><span>{{$detail->create_time}}</span></li><li><label class="display_name">更新时间戳:</label><span>{{$detail->update_time}}</span></li><li><label class="display_name">创建者:</label><span>{{$detail->create_by}}</span></li><li><label class="display_name">更新者:</label><span>{{$detail->update_by}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->game_id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/game_config_switch/{{$detail->game_id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/game_config_switch";
			
		});
	}
</script>
			</div>
		</div>
@endsection