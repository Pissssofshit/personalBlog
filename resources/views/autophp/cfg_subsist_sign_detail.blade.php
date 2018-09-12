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
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">第n日留存:</label><span>{{$detail->subsist_day}}</span></li><li><label class="display_name">对应标记:</label><span>{{$detail->subsist_num}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->subsist_day}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/cfg_subsist_sign/{{$detail->subsist_day}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/cfg_subsist_sign";
			
		});
	}
</script>
			</div>
		</div>
@endsection