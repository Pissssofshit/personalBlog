		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">成本提交表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/day_plan_cost">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/day_plan_cost/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 成本提交表">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>

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
				<th>没用的主键</th> 
<th>成本所属时间戳</th> 
<th>成本所属日期</th> 
<th>计划id</th> 
<th>账号id</th> 
<th>游戏id</th> 
<th>站点id</th> 
<th>游戏币成本</th> 
<th>人民币成本</th> 
<th>币单价</th> 
<th>是否已经通过</th> 
<th>创建时间</th> 
<th>通过时间</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->day_time?date('Y-m-d H:i:s',$item->day_time):''}}</td> 
<td>{{$item->day_date}}</td> 
<td>{{$item->plan_id}}</td> 
<td>{{$item->account_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->site_id}}</td> 
<td>{{$item->cost}}</td> 
<td>{{$item->rmb_cost}}</td> 
<td>{{$item->rate}}</td> 
<td>{{$item->is_passed}}</td> 
<td>{{$item->created_time?date('Y-m-d H:i:s',$item->created_time):''}}</td> 
<td>{{$item->pass_time?date('Y-m-d H:i:s',$item->pass_time):''}}</td> 
<td><a href="/autophp/day_plan_cost/{{$item->id}}">查看</a> 
					<a href="/autophp/day_plan_cost/{{$item->id}}/edit">编辑</a></td>
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