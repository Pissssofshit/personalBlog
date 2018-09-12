		@extends('autophp.common.index')
		@section('title')
		cfg
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">cfg</a></li>
					<li class="active">留存标记</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/cfg_subsist_sign">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/cfg_subsist_sign/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：cfg >> 留存标记">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>第n日留存</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->subsist_day}}</td> 
<td><a href="/autophp/cfg_subsist_sign/{{$item->subsist_day}}">查看</a> 
					<a href="/autophp/cfg_subsist_sign/{{$item->subsist_day}}/edit">编辑</a></td>
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