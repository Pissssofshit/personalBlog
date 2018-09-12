		@extends('autophp.common.index')
		@section('title')
		sys
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">sys</a></li>
					<li class="active">渠道类型关联</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/sys_channel_channeltype">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/sys_channel_channeltype/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：sys >> 渠道类型关联">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">渠道id</label><input type="text" maxlength="10" name="channel_id" id="channel_id" value="{{isset($detail['channel_id'])?$detail['channel_id']:''}}"></input></li>
<li><label class="display_name">类型id</label><input type="text" maxlength="10" name="channel_type_id" id="channel_type_id" value="{{isset($detail['channel_type_id'])?$detail['channel_type_id']:''}}"></input></li>

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
<th>渠道id</th> 
<th>类型id</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->channel_id}}</td> 
<td>{{$item->channel_type_id}}</td> 
<td><a href="/autophp/sys_channel_channeltype/{{$item->id}}">查看</a> 
					<a href="/autophp/sys_channel_channeltype/{{$item->id}}/edit">编辑</a></td>
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