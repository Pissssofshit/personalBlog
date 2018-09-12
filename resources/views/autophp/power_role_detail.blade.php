		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">角色管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_role">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_role/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 角色管理">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID编号:</label><span>{{$detail->power_role_id}}</span></li><li><label class="display_name">角色名称:</label><span>{{$detail->power_role_name}}</span></li>				<li><label class="display_name">角色权限内容:</label>
				<span>
		        <table style="border:1px solid #CCCCCC; clear:none; width:200px">
	
				    @foreach($power_list as $key=>$power)
				    <tr>
				    	<td style="text-align:left;">
					    	@if(isset($detail.content.$key))
					    	{{$power.name}}
					    	@endif
				    	</td>
				    </tr>
				    <tr>
				    	<td style="padding-left:35px; text-align:left ">
			
				        @foreach($power.sub as $action)
					        @if(isset($detail.content.$key) && in_array($action.url,$detail.content.$key))
					        {{$action.name}}<br />
					        @endif
				       @endforeach
				        </td>
				    </tr>			    
		    		@endforeach
		        </table>			
			</span><li><label class="display_name">创建时间:</label><span>{{$detail->created_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->power_role_id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/power_role/{{$detail->power_role_id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/power_role";
			
		});
	}
</script>
			</div>
		</div>
@endsection