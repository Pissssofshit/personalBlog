		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">类型定义</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_plan_append">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_plan_append/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 类型定义">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">ios游戏id</label><input type="text" maxlength="10" name="ios_game_id" id="ios_game_id" value="{{isset($detail['ios_game_id'])?$detail['ios_game_id']:''}}"></input></li>
<li><label class="display_name">版本号</label><input type="text" maxlength="40" name="version" id="version" value="{{isset($detail['version'])?$detail['version']:''}}"></input></li>

				<li><input class="kbutton kbutton_A" type="submit" value="搜  索" id="btn_search" /></li>
				<li><input class="kbutton kbutton_A" value=" 导  出 " id="btn_export" /></li>
			</ul>
		</form>
	</fieldset>

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>计划ID</th> 
<th>ios游戏id</th> 
<th>版本号</th> 
<th>打包状态</th> 
<th>倒计时</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->plan_id}}</td> 
<td>{{$item->ios_game_id}}</td> 
<td>{{$item->version}}</td> 
<td>{{$item->status}}</td> 
<td>{{$item->count_down}}</td> 
<td><a href="/autophp/rem_plan_append/{{$item->plan_id}}">查看</a> 
					<a href="/autophp/rem_plan_append/{{$item->plan_id}}/edit">编辑</a></td>
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