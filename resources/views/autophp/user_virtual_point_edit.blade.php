		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">限定币</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user_virtual_point">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user_virtual_point/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 限定币">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/user_virtual_point/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="11" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">用户id</label><input type="text" maxlength="11" name="user_id" id="user_id" value="{{isset($detail['user_id'])?$detail['user_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="11" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="2" name="type" id="type" value="{{isset($detail['type'])?$detail['type']:''}}"></input></li>
<li><label class="display_name">余额</label><input type="text" maxlength="11" name="point" id="point" value="{{isset($detail['point'])?$detail['point']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"id":{"required":true,"maxlength":"11"},"user_id":{"required":true,"maxlength":"11"},"game_id":{"required":true,"maxlength":"11"},"type":{"required":true,"maxlength":"2"},"point":{"required":true,"maxlength":"11"}},"messages":{"id":{"required":"\u3010ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010ID\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"user_id":{"required":"\u3010\u7528\u6237id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7528\u6237id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"type":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"point":{"required":"\u3010\u4f59\u989d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4f59\u989d\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection