		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">限定币</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_virtual_point">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_virtual_point/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 限定币">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>用户id</th> 
<th>游戏id</th> 
<th>类型</th> 
<th>余额</th> 
<th>操作</th> 

			</tr>
	
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->type}}</td> 
<td>{{$item->point}}</td> 
<td><a href="/autophp/user_virtual_point/{{$item->id}}">查看</a> 
					<a href="/autophp/user_virtual_point/{{$item->id}}/edit">编辑</a></td>
			</tr>
			@endforeach
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection