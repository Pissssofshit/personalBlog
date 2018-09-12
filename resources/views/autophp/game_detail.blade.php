		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏渠道包</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏渠道包">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			<li><label class="display_name">ID:</label><span>{{$detail->id}}</span></li><li><label class="display_name">主体id:</label><span>{{$detail->entity_id}}</span></li><li><label class="display_name">游戏名称:</label><span>{{$detail->name}}</span></li><li><label class="display_name">拼音简写:</label><span>{{$detail->name_en}}</span></li><li><label class="display_name">图标:</label><span>{{$detail->icon}}</span></li><li><label class="display_name">描述:</label><span>{{$detail->desc}}</span></li><li><label class="display_name">类型:</label><span>{{$detail->category}}</span></li><li><label class="display_name">分级:ABC3类:</label><span>{{$detail->rank}}</span></li><li><label class="display_name">系统类别:默认为1android:</label><span>{{$detail->os}}</span></li><li><label class="display_name">普通签名key:</label><span>{{$detail->common_sign_key}}</span></li><li><label class="display_name">确认接口签名key:</label><span>{{$detail->confirm_sign_key}}</span></li><li><label class="display_name">冲值签名key:</label><span>{{$detail->pay_sign_key}}</span></li><li><label class="display_name">冲值回调url:</label><span>{{$detail->pay_callback}}</span></li><li><label class="display_name">游戏币名称:如钻石:</label><span>{{$detail->coin_unit}}</span></li><li><label class="display_name">兑换率:1元人民币兑换多少游戏币:</label><span>{{$detail->coin_rate}}</span></li><li><label class="display_name">原始ucode:对应渠道标记为0:</label><span>{{$detail->ucode}}</span></li><li><label class="display_name">版本:</label><span>{{$detail->version}}</span></li><li><label class="display_name">包地址:</label><span>{{$detail->package_url}}</span></li><li><label class="display_name">创建时间戳:</label><span>{{$detail->create_time}}</span></li><li><label class="display_name">更新时间戳:</label><span>{{$detail->update_time}}</span></li><li><label class="display_name">创建者:</label><span>{{$detail->create_by}}</span></li><li><label class="display_name">更新者:</label><span>{{$detail->update_by}}</span></li><li class="clearfix"></li><li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="javascript:location.href='./{{$detail->id}}/edit'"/><input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/game/{{$detail->id}}', {'_method':'DELETE'}) : null;"/></li>
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/game";
			
		});
	}
</script>
			</div>
		</div>
@endsection