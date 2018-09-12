		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">限定币变更日志</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_virtual_point_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 限定币变更日志">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/user_virtual_point_log/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="11" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">平台用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="11" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">变更前虚拟币</label><input type="text" maxlength="11" name="before_point" id="before_point" value="{{isset($detail['before_point'])?$detail['before_point']:''}}"></input></li>
<li><label class="display_name">变更的虚拟币</label><input type="text" maxlength="11" name="point" id="point" value="{{isset($detail['point'])?$detail['point']:''}}"></input></li>
<li><label class="display_name">变更后的虚拟币</label><input type="text" maxlength="11" name="after_point" id="after_point" value="{{isset($detail['after_point'])?$detail['after_point']:''}}"></input></li>
<li><label class="display_name">变更类型</label><input type="text" maxlength="255" name="type" id="type" value="{{isset($detail['type'])?$detail['type']:''}}"></input></li>
<li><label class="display_name">变更说明</label><input type="text" maxlength="255" name="desc" id="desc" value="{{isset($detail['desc'])?$detail['desc']:''}}"></input></li>
<li><label class="display_name">变更时间戳</label><input type="text"  maxlength="16" name="create_time" id="create_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['create_time'])?$detail['create_time']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"id":{"required":true,"maxlength":"11"},"user_id":{"required":true,"maxlength":"11"},"game_id":{"required":true,"maxlength":"11"},"before_point":{"required":true,"maxlength":"11"},"point":{"required":true,"maxlength":"11"},"after_point":{"required":true,"maxlength":"11"},"type":{"required":true,"maxlength":"255"},"desc":{"required":true,"maxlength":"255"},"create_time":{"required":true,"maxlength":16}},"messages":{"id":{"required":"\u3010ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ID\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_id":{"required":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"before_point":{"required":"\u3010\u53d8\u66f4\u524d\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u524d\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"point":{"required":"\u3010\u53d8\u66f4\u7684\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u7684\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"after_point":{"required":"\u3010\u53d8\u66f4\u540e\u7684\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u540e\u7684\u865a\u62df\u5e01\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"type":{"required":"\u3010\u53d8\u66f4\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"desc":{"required":"\u3010\u53d8\u66f4\u8bf4\u660e\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u8bf4\u660e\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"create_time":{"required":"\u3010\u53d8\u66f4\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u53d8\u66f4\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection