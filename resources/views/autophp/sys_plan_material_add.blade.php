		@extends('autophp.common.index')
		@section('title')
		sys
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">sys</a></li>
					<li class="active">计划素材关联</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/sys_plan_material">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/sys_plan_material/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：sys >> 计划素材关联">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/sys_plan_material/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">素材id</label><input type="text" maxlength="10" name="material_id" id="material_id" value="{{isset($detail['material_id'])?$detail['material_id']:''}}"></input></li>
<li><label class="display_name">权重</label><input type="text" maxlength="10" name="weight" id="weight" value="{{isset($detail['weight'])?$detail['weight']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"plan_id":{"required":true,"maxlength":"10"},"material_id":{"required":true,"maxlength":"10"},"weight":{"required":true,"maxlength":"10"}},"messages":{"plan_id":{"required":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"material_id":{"required":"\u3010\u7d20\u6750id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7d20\u6750id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"weight":{"required":"\u3010\u6743\u91cd\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6743\u91cd\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection