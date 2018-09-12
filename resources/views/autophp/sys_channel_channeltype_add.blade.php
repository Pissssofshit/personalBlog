		@extends('autophp.common.index')
		@section('title')
		sys
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">sys</a></li>
					<li class="active">渠道类型关联</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/sys_channel_channeltype">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/sys_channel_channeltype/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：sys >> 渠道类型关联">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/sys_channel_channeltype/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">渠道id</label><input type="text" maxlength="10" name="channel_id" id="channel_id" value="{{isset($detail['channel_id'])?$detail['channel_id']:''}}"></input></li>
<li><label class="display_name">类型id</label><input type="text" maxlength="10" name="channel_type_id" id="channel_type_id" value="{{isset($detail['channel_type_id'])?$detail['channel_type_id']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"channel_id":{"required":true,"maxlength":"10"},"channel_type_id":{"required":true,"maxlength":"10"}},"messages":{"channel_id":{"required":"\u3010\u6e20\u9053id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"channel_type_id":{"required":"\u3010\u7c7b\u578bid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578bid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection