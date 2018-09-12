		@extends('autophp.common.index')
		@section('title')
		用户管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">用户管理</a></li>
					<li class="active">第三方用户</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/third_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/third_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：用户管理 >> 第三方用户">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">UID:user表用户id:</label><span>{{$detail->user_id}}</span></li><li><label class="display_name">开放平台标示:如weixin:</label><span>{{$detail->app_type}}</span></li><li><label class="display_name">开放平台用户标示:</label><span>{{$detail->openid}}</span></li><li><label class="display_name">开放平台访问令牌:</label><span>{{$detail->access_token}}</span></li><li><label class="display_name">令牌实效时间:</label><span>{{$detail->token_expire_time}}</span></li><li><label class="display_name">刷新令牌:</label><span>{{$detail->refresh_token}}</span></li><li><label class="display_name">开放平台返回的用户信息:</label><span>{{$detail->user_info}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/third_user/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/third_user";
			
		});
	}
</script>
			</div>
		</div>
@endsection