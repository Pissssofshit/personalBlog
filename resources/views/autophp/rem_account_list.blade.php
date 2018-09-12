		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">账号列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_account">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_account/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 账号列表">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">账号名称</label><input type="text" maxlength="40" name="account_name" id="account_name" value="{{isset($detail['account_name'])?$detail['account_name']:''}}"></input></li>
<li><label class="display_name">公司id</label><input type="text" maxlength="10" name="company_id" id="company_id" value="{{isset($detail['company_id'])?$detail['company_id']:''}}"></input></li>

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
				<th>账号ID</th> 
<th>账号名称</th> 
<th>公司id</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->account_id}}</td> 
<td>{{$item->account_name}}</td> 
<td>{{$item->company_id}}</td> 
<td><a href="/autophp/rem_account/{{$item->account_id}}">查看</a> 
					<a href="/autophp/rem_account/{{$item->account_id}}/edit">编辑</a></td>
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