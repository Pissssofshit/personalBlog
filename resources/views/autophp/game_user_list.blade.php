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
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>游戏id</th> 
<th>平台用户id</th> 
<th>渠道标示</th> 
<th><a href='javascript:' title='0-pc;1-android;2-ios' >操作系统</a></th><th>注册时间戳</th> 
<th>操作</th> 

			</tr>
	
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->ucode}}</td> 
<td>{{$item->os}}</td> 
<td>{{$item->reg_time?date('Y-m-d H:i:s',$item->reg_time):''}}</td> 
<td><a href="/autophp/game_user/{{$item->id}}">查看</a> 
					<a href="/autophp/game_user/{{$item->id}}/edit">编辑</a></td>
			</tr>
			@endforeach
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection