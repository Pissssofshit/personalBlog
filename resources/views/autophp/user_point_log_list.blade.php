		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">平台币日志</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_point_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_point_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 平台币日志">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>平台用户id</th> 
<th>变更前平台币</th> 
<th>变更的平台币</th> 
<th>变更后的平台币</th> 
<th>变更前赠送平台币</th> 
<th>变更的赠送平台币</th> 
<th>变更后的赠送平台币</th> 
<th>变更时间戳</th> 
<th>操作</th> 

			</tr>
	
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->before_point}}</td> 
<td>{{$item->point}}</td> 
<td>{{$item->after_point}}</td> 
<td>{{$item->before_point_free}}</td> 
<td>{{$item->point_free}}</td> 
<td>{{$item->after_point_free}}</td> 
<td>{{$item->create_time?date('Y-m-d H:i:s',$item->create_time):''}}</td> 
<td><a href="/autophp/user_point_log/{{$item->id}}">查看</a> 
					<a href="/autophp/user_point_log/{{$item->id}}/edit">编辑</a></td>
			</tr>
			@endforeach
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection