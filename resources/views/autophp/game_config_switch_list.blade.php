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
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>游戏id</th> 
<th><a href='javascript:' title='1开启;2关闭' >广告统计app开关</a></th><th><a href='javascript:' title='1开启;2关闭' >微信开关</a></th><th><a href='javascript:' title='游戏启动动画是否播放平台logo' >平台闪屏开关</a></th><th>充值邦定手机提示</th> 
<th>一键注册开关</th> 
<th>创建时间戳</th> 
<th>更新时间戳</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->game_id}}</td> 
<td>{{$item->ad_stat_switch}}</td> 
<td>{{$item->weixin_switch}}</td> 
<td>{{$item->show_platform_switch}}</td> 
<td>{{$item->bind_mobile_when_pay_switch}}</td> 
<td>{{$item->one_key_registe_switch}}</td> 
<td>{{$item->create_time?date('Y-m-d H:i:s',$item->create_time):''}}</td> 
<td>{{$item->update_time?date('Y-m-d H:i:s',$item->update_time):''}}</td> 
<td><a href="/autophp/game_config_switch/{{$item->game_id}}">查看</a> 
					<a href="/autophp/game_config_switch/{{$item->game_id}}/edit">编辑</a></td>
			</tr>
			@endforeach
			@endif
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection