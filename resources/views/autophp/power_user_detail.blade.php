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
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID编号:</label><span>{{$detail->power_user_id}}</span></li><li><label class="display_name">用户帐号:</label><span>{{$detail->power_user_name}}</span></li><li><label class="display_name">真实姓名:</label><span>{{$detail->truename}}</span></li><li><label class="display_name">密码:</label><span>{{$detail->password}}</span></li><?php $power_role_id= isset($dict_power_role[1][$detail->power_role_id])?$dict_power_role[1][$detail->power_role_id]:'';?><li><label class="display_name">角色类型:</label><span>{{$power_role_id}}</span></li><li><label class="display_name">创建时间:</label><span>{{$detail->created_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->power_user_id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/power_user/{{$detail->power_user_id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/power_user";
			
		});
	}
</script>
			</div>
		</div>
@endsection