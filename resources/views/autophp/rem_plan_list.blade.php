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
				<li class="admin_tab"><a href="/autophp/rem_plan">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_plan/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 类型定义">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">计划名</label><input type="text" maxlength="40" name="plan_name" id="plan_name" value="{{isset($detail['plan_name'])?$detail['plan_name']:''}}"></input></li>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">推广方式</label><input type="text" maxlength="4" name="mode_id" id="mode_id" value="{{isset($detail['mode_id'])?$detail['mode_id']:''}}"></input></li>

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
<th>计划名</th> 
<th>账号id</th> 
<th>游戏id</th> 
<th>站点id</th> 
<th>状态</th> 
<th>是否启用过</th> 
<th>类型</th> 
<th>推广方式</th> 
<th>创建时间</th> 
<th>更新时间</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->plan_id}}</td> 
<td>{{$item->plan_name}}</td> 
<td>{{$item->account_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->site_id}}</td> 
<td>{{$item->state}}</td> 
<td>{{$item->is_1st}}</td> 
<td>{{$item->category_id}}</td> 
<td>{{$item->mode_id}}</td> 
<td>{{$item->created_time?date('Y-m-d H:i:s',$item->created_time):''}}</td> 
<td>{{$item->updated_time?date('Y-m-d H:i:s',$item->updated_time):''}}</td> 
<td><a href="/autophp/rem_plan/{{$item->plan_id}}">查看</a> 
					<a href="/autophp/rem_plan/{{$item->plan_id}}/edit">编辑</a></td>
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