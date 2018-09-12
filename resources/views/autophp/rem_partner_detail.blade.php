		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">平台列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_partner">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_partner/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 平台列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">平台id:</label><span>{{$detail->partner_id}}</span></li><li><label class="display_name">平台名:</label><span>{{$detail->partner_name}}</span></li><li><label class="display_name">账号注册检查链接:</label><span>{{$detail->check_url}}</span></li><li><label class="display_name">账号注册链接:</label><span>{{$detail->reg_url}}</span></li><li><label class="display_name">账号登录链接:</label><span>{{$detail->login_url}}</span></li><li><label class="display_name">账号查询链接:</label><span>{{$detail->search_url}}</span></li><li><label class="display_name">获取服务器列表链接:</label><span>{{$detail->server_url}}</span></li><li><label class="display_name">素材链接:</label><span>{{$detail->cdn_url}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->partner_id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/rem_partner/{{$detail->partner_id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/rem_partner";
			
		});
	}
</script>
			</div>
		</div>
@endsection