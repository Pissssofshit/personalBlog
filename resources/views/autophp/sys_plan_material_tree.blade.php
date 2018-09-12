		@extends('autophp.common.index')
		@section('title')
		sys
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">sys</a></li>
					<li class="active">计划素材关联</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/sys_plan_material">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/sys_plan_material/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：sys >> 计划素材关联">
			<div class="easyui-panel" border="false" style="padding:1px">
				
			</div>
		</div>
@endsection