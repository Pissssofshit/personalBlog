		@extends('autophp.common.index')
		@section('title')
		cfg
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">cfg</a></li>
					<li class="active">留存标记</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/cfg_subsist_sign">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/cfg_subsist_sign/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：cfg >> 留存标记">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/cfg_subsist_sign/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">对应标记</label><input type="text" maxlength="100" name="subsist_num" id="subsist_num" value="{{isset($detail['subsist_num'])?$detail['subsist_num']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"subsist_num":{"required":true,"maxlength":"100"}},"messages":{"subsist_num":{"required":"\u3010\u5bf9\u5e94\u6807\u8bb0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5bf9\u5e94\u6807\u8bb0\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection