		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">角色管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_role">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_role/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 角色管理">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">可浏览公司</label><input type="text" maxlength="500" name="company_ids" id="company_ids" value="{{isset($detail['company_ids'])?$detail['company_ids']:''}}"></input></li>

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
				<th>ID编号</th> 
<th>角色名称</th> 
<th>可浏览公司</th> 
<th>创建时间</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->power_role_id}}</td> 
<td>{{$item->power_role_name}}</td> 
<td>{{$item->company_ids}}</td> 
<td>{{$item->created_time?date('Y-m-d H:i:s',$item->created_time):''}}</td> 
<td><a href="/autophp/power_role/{{$item->power_role_id}}">查看</a> 
					<a href="/autophp/power_role/{{$item->power_role_id}}/edit">编辑</a></td>
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