		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">渠道类型列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_channel_type">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_channel_type/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 渠道类型列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				
			</div>
		</div>
@endsection