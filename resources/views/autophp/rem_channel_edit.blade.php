		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">渠道列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_channel">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_channel/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 渠道列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/rem_channel/{{$detail->channel_id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="channel_id" id="channel_id" value="{{isset($detail['channel_id'])?$detail['channel_id']:''}}"></input>
<li><label class="display_name">渠道名</label><input type="text" maxlength="40" name="channel_name" id="channel_name" value="{{isset($detail['channel_name'])?$detail['channel_name']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">是否启用</label><?php $state= isset($detail['state'])?$detail['state']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'state\' @if($key==$state) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">回调地址</label><input type="text" maxlength="255" name="callback_url" id="callback_url" value="{{isset($detail['callback_url'])?$detail['callback_url']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"channel_name":{"required":true,"maxlength":"40"},"category_id":{"required":true,"maxlength":"4"},"callback_url":{"required":true,"maxlength":"255"}},"messages":{"channel_name":{"required":"\u3010\u6e20\u9053\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"callback_url":{"required":"\u3010\u56de\u8c03\u5730\u5740\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56de\u8c03\u5730\u5740\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection