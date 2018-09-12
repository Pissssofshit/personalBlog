		@extends('autophp.common.index')
		@section('title')
		cfg
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">cfg</a></li>
					<li class="active">结算方式定义</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/cfg_pay_way">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/cfg_pay_way/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：cfg >> 结算方式定义">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">结算方式</label><input type="text" maxlength="30" name="name" id="name" value="{{isset($detail['name'])?$detail['name']:''}}"></input></li>

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
				<th>结算方式ID</th> 
<th>结算方式</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->name}}</td> 
<td><a href="/autophp/cfg_pay_way/{{$item->id}}">查看</a> 
					<a href="/autophp/cfg_pay_way/{{$item->id}}/edit">编辑</a></td>
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