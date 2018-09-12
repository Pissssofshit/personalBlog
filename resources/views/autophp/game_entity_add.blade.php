		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_entity">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_entity/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/game_entity/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">游戏主体名称</label><input type="text" maxlength="250" name="name" id="name" value="{{isset($detail['name'])?$detail['name']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='1启用2禁用' >状态</a>:</label><input type="text" maxlength="2" name="enable" id="enable" value="{{isset($detail['enable'])?$detail['enable']:''}}"></input></li>
<li><label class="display_name">创建时间戳</label><input type="text"  maxlength="16" name="create_time" id="create_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['create_time'])?$detail['create_time']:''}}"></input></li>
<li><label class="display_name">更新时间戳</label><input type="text"  maxlength="16" name="update_time" id="update_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['update_time'])?$detail['update_time']:''}}"></input></li>
<li><label class="display_name">创建者</label><input type="text" maxlength="250" name="create_by" id="create_by" value="{{isset($detail['create_by'])?$detail['create_by']:''}}"></input></li>
<li><label class="display_name">更新者</label><input type="text" maxlength="250" name="update_by" id="update_by" value="{{isset($detail['update_by'])?$detail['update_by']:''}}"></input></li>
<li><label class="display_name">代充折扣</label><input type="text" maxlength="10" name="discount" id="discount" value="{{isset($detail['discount'])?$detail['discount']:''}}"></input></li>
<li><label class="display_name">充值返点</label><input type="text" maxlength="10" name="back_pay" id="back_pay" value="{{isset($detail['back_pay'])?$detail['back_pay']:''}}"></input></li>
<li><label class="display_name">上架状态</label><input type="text" maxlength="2" name="status" id="status" value="{{isset($detail['status'])?$detail['status']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"name":{"required":true,"maxlength":"250"},"enable":{"required":true,"maxlength":"2"},"create_time":{"required":true,"maxlength":16},"update_time":{"required":true,"maxlength":16},"create_by":{"required":true,"maxlength":"250"},"update_by":{"required":true,"maxlength":"250"},"discount":{"required":true,"maxlength":"10"},"back_pay":{"required":true,"maxlength":"10"},"status":{"required":true,"maxlength":"2"}},"messages":{"name":{"required":"\u3010\u6e38\u620f\u4e3b\u4f53\u540d\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620f\u4e3b\u4f53\u540d\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"enable":{"required":"\u3010\u72b6\u6001:1\u542f\u75282\u7981\u7528\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u72b6\u6001:1\u542f\u75282\u7981\u7528\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"create_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"update_time":{"required":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"create_by":{"required":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"update_by":{"required":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"discount":{"required":"\u3010\u4ee3\u5145\u6298\u6263\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4ee3\u5145\u6298\u6263\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"back_pay":{"required":"\u3010\u5145\u503c\u8fd4\u70b9\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5145\u503c\u8fd4\u70b9\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"status":{"required":"\u3010\u4e0a\u67b6\u72b6\u6001\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4e0a\u67b6\u72b6\u6001\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection