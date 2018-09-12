		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">手游渠道回调</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/feedback">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/feedback/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 手游渠道回调">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">渠道回调方法名</label><input type="text" maxlength="40" name="type_alias" id="type_alias" value="{{isset($detail['type_alias'])?$detail['type_alias']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">设备类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">插入时间</label><input type="text" style='width:100px;' maxlength="16" name="insert_time_start" id="insert_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['insert_time_start'])?$detail['insert_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="insert_time_end" id="insert_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['insert_time_end'])?$detail['insert_time_end']:''}}"></input></li>
<li><label class="display_name">回调时间</label><input type="text" style='width:100px;' maxlength="16" name="notice_time_start" id="notice_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['notice_time_start'])?$detail['notice_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="notice_time_end" id="notice_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['notice_time_end'])?$detail['notice_time_end']:''}}"></input></li>
<li><label class="display_name">匹配时间</label><input type="text" style='width:100px;' maxlength="16" name="match_time_start" id="match_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['match_time_start'])?$detail['match_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="match_time_end" id="match_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['match_time_end'])?$detail['match_time_end']:''}}"></input></li>

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
<th>渠道回调方法名</th> 
<th>平台ID</th> 
<th>计划id</th> 
<th>游戏id</th> 
<th>站点id</th> 
<th>设备类型</th> 
<th>ip</th> 
<th>插入时间</th> 
<th>回调时间</th> 
<th>匹配时间</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->type_alias}}</td> 
<td>{{$item->partner_id}}</td> 
<td>{{$item->plan_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->site_id}}</td> 
<td>{{$item->category_id}}</td> 
<td>{{$item->ip}}</td> 
<td>{{$item->insert_time?date('Y-m-d H:i:s',$item->insert_time):''}}</td> 
<td>{{$item->notice_time?date('Y-m-d H:i:s',$item->notice_time):''}}</td> 
<td>{{$item->match_time?date('Y-m-d H:i:s',$item->match_time):''}}</td> 
<td><a href="/autophp/feedback/{{$item->id}}">查看</a> 
					<a href="/autophp/feedback/{{$item->id}}/edit">编辑</a></td>
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