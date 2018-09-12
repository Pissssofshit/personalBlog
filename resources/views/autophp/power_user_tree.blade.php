		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">用户管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 用户管理">
			<div class="easyui-panel" border="false" style="padding:1px">
				
			</div>
		</div>
@endsection