		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_entity">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_entity/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th><a href='javascript:' title='1启用2禁用' >状态</a></th><th>创建时间戳</th> 
<th>更新时间戳</th> 
<th>代充折扣</th> 
<th>充值返点</th> 
<th>上架状态</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->enable}}</td> 
<td>{{$item->create_time?date('Y-m-d H:i:s',$item->create_time):''}}</td> 
<td>{{$item->update_time?date('Y-m-d H:i:s',$item->update_time):''}}</td> 
<td>{{$item->discount}}</td> 
<td>{{$item->back_pay}}</td> 
<td>{{$item->status}}</td> 
<td><a href="/autophp/game_entity/{{$item->id}}">查看</a> 
					<a href="/autophp/game_entity/{{$item->id}}/edit">编辑</a></td>
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