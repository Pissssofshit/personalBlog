		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">渠道列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_channel">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_channel/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 渠道列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">渠道ID:</label><span>{{$detail->channel_id}}</span></li><li><label class="display_name">渠道名:</label><span>{{$detail->channel_name}}</span></li><li><label class="display_name">类型:</label><span>{{$detail->category_id}}</span></li><?php $state= isset($dict_boolean[$detail.state])?$dict_boolean[$detail.state]:'';?><li><label class="display_name">是否启用:</label><span>{{$state}}</span></li><li><label class="display_name">回调地址:</label><span>{{$detail->callback_url}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->channel_id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/rem_channel/{{$detail->channel_id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/rem_channel";
			
		});
	}
</script>
			</div>
		</div>
@endsection