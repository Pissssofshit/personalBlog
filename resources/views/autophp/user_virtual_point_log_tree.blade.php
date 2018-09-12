		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">限定币变更日志</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 限定币变更日志">
			<div class="easyui-panel" border="false" style="padding:1px">
				
			</div>
		</div>
@endsection