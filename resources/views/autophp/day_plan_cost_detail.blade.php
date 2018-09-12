		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">成本提交表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/day_plan_cost">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/day_plan_cost/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 成本提交表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">没用的主键:</label><span>{{$detail->id}}</span></li><li><label class="display_name">成本所属时间戳:</label><span>{{$detail->day_time}}</span></li><li><label class="display_name">成本所属日期:</label><span>{{$detail->day_date}}</span></li><li><label class="display_name">计划id:</label><span>{{$detail->plan_id}}</span></li><li><label class="display_name">账号id:</label><span>{{$detail->account_id}}</span></li><li><label class="display_name">游戏id:</label><span>{{$detail->game_id}}</span></li><li><label class="display_name">站点id:</label><span>{{$detail->site_id}}</span></li><li><label class="display_name">游戏币成本:</label><span>{{$detail->cost}}</span></li><li><label class="display_name">人民币成本:</label><span>{{$detail->rmb_cost}}</span></li><li><label class="display_name">币单价:</label><span>{{$detail->rate}}</span></li><li><label class="display_name">提交者:</label><span>{{$detail->create_by}}</span></li><li><label class="display_name">通过者:</label><span>{{$detail->pass_by}}</span></li><li><label class="display_name">是否已经通过:</label><span>{{$detail->is_passed}}</span></li><li><label class="display_name">创建时间:</label><span>{{$detail->created_time}}</span></li><li><label class="display_name">通过时间:</label><span>{{$detail->pass_time}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/day_plan_cost/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/day_plan_cost";
			
		});
	}
</script>
			</div>
		</div>
@endsection