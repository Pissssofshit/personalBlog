		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">平台币</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_point">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_point/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 平台币">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>user表用户id</th> 
<th>平台币</th> 
<th>赠送的平台币数量</th> 
<th>更新时间戳</th> 
<th>最近充值游戏</th> 
<th>最近付费渠道id</th> 
<th>最近充值金额</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->point}}</td> 
<td>{{$item->point_free}}</td> 
<td>{{$item->update_time?date('Y-m-d H:i:s',$item->update_time):''}}</td> 
<td>{{$item->last_pay_game_id}}</td> 
<td>{{$item->last_pay_channel_id}}</td> 
<td>{{$item->last_pay_money}}</td> 
<td><a href="/autophp/user_point/{{$item->id}}">查看</a> 
					<a href="/autophp/user_point/{{$item->id}}/edit">编辑</a></td>
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