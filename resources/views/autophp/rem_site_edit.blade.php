		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">站点列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_site">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_site/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 站点列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/rem_site/{{$detail->site_id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input>
<li><label class="display_name">渠道ID</label><input type="text" maxlength="10" name="channel_id" id="channel_id" value="{{isset($detail['channel_id'])?$detail['channel_id']:''}}"></input></li>
<li><label class="display_name">站点名</label><input type="text" maxlength="40" name="site_name" id="site_name" value="{{isset($detail['site_name'])?$detail['site_name']:''}}"></input></li>
<li><label class="display_name">是否启用</label><?php $state= isset($detail['state'])?$detail['state']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'state\' @if($key==$state) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">结算方式</label><input type="text" maxlength="4" name="pay_way_id" id="pay_way_id" value="{{isset($detail['pay_way_id'])?$detail['pay_way_id']:''}}"></input></li>
<li><label class="display_name">具体描述</label><input type="text" maxlength="100" name="describe" id="describe" value="{{isset($detail['describe'])?$detail['describe']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"channel_id":{"required":true,"maxlength":"10"},"site_name":{"required":true,"maxlength":"40"},"category_id":{"required":true,"maxlength":"4"},"pay_way_id":{"required":true,"maxlength":"4"},"describe":{"required":true,"maxlength":"100"}},"messages":{"channel_id":{"required":"\u3010\u6e20\u9053ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e20\u9053ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_name":{"required":"\u3010\u7ad9\u70b9\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"pay_way_id":{"required":"\u3010\u7ed3\u7b97\u65b9\u5f0f\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ed3\u7b97\u65b9\u5f0f\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"describe":{"required":"\u3010\u5177\u4f53\u63cf\u8ff0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5177\u4f53\u63cf\u8ff0\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection