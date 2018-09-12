		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">渠道类型列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_channel_type">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_channel_type/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 渠道类型列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/rem_channel_type/{{$detail->id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="id" id="id" value="{{isset($detail['id'])?$detail['id']:''}}"></input>
<li><label class="display_name">类型名</label><input type="text" maxlength="40" name="name" id="name" value="{{isset($detail['name'])?$detail['name']:''}}"></input></li>
<li><label class="display_name">是否启用</label><?php $state= isset($detail['state'])?$detail['state']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'state\' @if($key==$state) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">具体描述</label><input type="text" maxlength="100" name="describe" id="describe" value="{{isset($detail['describe'])?$detail['describe']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"name":{"required":true,"maxlength":"40"},"describe":{"required":true,"maxlength":"100"}},"messages":{"name":{"required":"\u3010\u7c7b\u578b\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"describe":{"required":"\u3010\u5177\u4f53\u63cf\u8ff0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5177\u4f53\u63cf\u8ff0\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection