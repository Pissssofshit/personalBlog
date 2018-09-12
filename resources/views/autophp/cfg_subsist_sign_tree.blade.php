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
				
			</div>
		</div>
@endsection