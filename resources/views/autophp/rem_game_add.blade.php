		@extends('autophp.common.index')
		@section('title')
		rem
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">rem</a></li>
					<li class="active">游戏列表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/rem_game">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/rem_game/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：rem >> 游戏列表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/rem_game/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">游戏名</label><input type="text" maxlength="40" name="game_name" id="game_name" value="{{isset($detail['game_name'])?$detail['game_name']:''}}"></input></li>
<li><label class="display_name">是否启用</label><?php $state= isset($detail['state'])?$detail['state']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'state\' @if($key==$state) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li><label class="display_name">官网地址/包地址</label><input type="text" maxlength="255" name="game_url" id="game_url" value="{{isset($detail['game_url'])?$detail['game_url']:''}}"></input></li>
<li><label class="display_name">是否最新服</label><input type="text" maxlength="4" name="new_server" id="new_server" value="{{isset($detail['new_server'])?$detail['new_server']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"partner_id":{"required":true,"maxlength":"10"},"game_name":{"required":true,"maxlength":"40"},"category_id":{"required":true,"maxlength":"4"},"game_url":{"required":true,"maxlength":"255"},"new_server":{"required":true,"maxlength":"4"}},"messages":{"partner_id":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_name":{"required":"\u3010\u6e38\u620f\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620f\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"},"game_url":{"required":"\u3010\u5b98\u7f51\u5730\u5740\/\u5305\u5730\u5740\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5b98\u7f51\u5730\u5740\/\u5305\u5730\u5740\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"new_server":{"required":"\u3010\u662f\u5426\u6700\u65b0\u670d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u662f\u5426\u6700\u65b0\u670d\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection