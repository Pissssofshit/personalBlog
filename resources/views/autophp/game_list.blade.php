		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏渠道包</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏渠道包">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>主体id</th> 
<th><a href='javascript:' title='默认为1android' >系统类别</a></th><th><a href='javascript:' title='1元人民币兑换多少游戏币' >兑换率</a></th><th><a href='javascript:' title='对应渠道标记为0' >原始ucode</a></th><th>创建时间戳</th> 
<th>更新时间戳</th> 
<th>操作</th> 

			</tr>
	
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->entity_id}}</td> 
<td>{{$item->os}}</td> 
<td>{{$item->coin_rate}}</td> 
<td>{{$item->ucode}}</td> 
<td>{{$item->create_time?date('Y-m-d H:i:s',$item->create_time):''}}</td> 
<td>{{$item->update_time?date('Y-m-d H:i:s',$item->update_time):''}}</td> 
<td><a href="/autophp/game/{{$item->id}}">查看</a> 
					<a href="/autophp/game/{{$item->id}}/edit">编辑</a></td>
			</tr>
			@endforeach
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection