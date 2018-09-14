@extends('autophp.common.index')
@section('content')
	<div class="page-bar">
		<ol class="breadcrumb" style="margin: 0px">
			<li><i class="fa fa-home"></i><a href="">rem</a></li>
			<li class="active">公司列表</li>
			<ul style="float:right;">
				<li style="float:left;"><a href="/autophp/{{$tip_info["module"]}}" class="listshowpng"></a></li>
				<li style="float:left;"><a href="/autophp/{{$tip_info["module"]}}/create" class="createshow"></a></li>
			</ul>
		</ol>
	</div>
		<div class="easyui-panel" border="false" style="padding:1px">

			<fieldset>
				<legend>提示信息</legend>
				@if($tip_info["status"])
					<div class="op_tip">
						<li class="op_tip_success">{{$tip_info["action"]}}操作成功！</li>

						@if($tip_info["action"]!="删除")
							<li class="op_tip_suggest">您可以点击<a href="javascript:void(0)" onclick="javascript:history.back()">这里</a>继续{{$tip_info["action"]}}</li>
						@endif
				@else
							<div class="op_tip ">
								<li class="op_tip_failed">
									{{$tip_info["action"]}}失败！

									@if($tip_info["action"] == "更新")
										<span class="op_tip_suggest">注意：更新操作没有作任何修改，也会提示“失败”</span>
									@endif
								</li>
								<li class="op_tip_suggest">您可以点击<a href="javascript:void(0)" onclick="javascript:history.back()">这里</a>返回，再次尝试操作，如果仍旧失败，请联系系统管理员</li>

								@if(isset($tip_info["detail"])&&$tip_info["detail"])
									<li class="op_tip_failed">Message: {{$tip_info["detail"]}}</li>
								@endif
							</div>
				@endif
			</fieldset>
		</div>
@endsection
