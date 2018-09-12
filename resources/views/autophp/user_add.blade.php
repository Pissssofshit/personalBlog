		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">用户表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 用户表">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/user/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="uid" id="uid" value="{{isset($detail['uid'])?$detail['uid']:''}}"></input></li>
<li><label class="display_name">平台账号名</label><input type="text" maxlength="40" name="passport" id="passport" value="{{isset($detail['passport'])?$detail['passport']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">计划id</label><input type="text" maxlength="10" name="plan_id" id="plan_id" value="{{isset($detail['plan_id'])?$detail['plan_id']:''}}"></input></li>
<li><label class="display_name">账号id</label><input type="text" maxlength="10" name="account_id" id="account_id" value="{{isset($detail['account_id'])?$detail['account_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">素材id</label><input type="text" maxlength="10" name="material_id" id="material_id" value="{{isset($detail['material_id'])?$detail['material_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">是否创角</label><?php $is_role= isset($detail['is_role'])?$detail['is_role']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'is_role\' @if($key==$is_role) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">是否新注册用户(滚游戏)</label><?php $is_reg= isset($detail['is_reg'])?$detail['is_reg']:1;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'is_reg\' @if($key==$is_reg) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
<li><label class="display_name">注册时间</label><input type="text"  maxlength="16" name="reg_time" id="reg_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time'])?$detail['reg_time']:''}}"></input></li>
<li><label class="display_name">留存标记</label><input type="text" maxlength="100" name="subsist_sign" id="subsist_sign" value="{{isset($detail['subsist_sign'])?$detail['subsist_sign']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"uid":{"required":true,"maxlength":"10"},"passport":{"required":true,"maxlength":"40"},"partner_id":{"required":true,"maxlength":"10"},"plan_id":{"required":true,"maxlength":"10"},"account_id":{"required":true,"maxlength":"10"},"game_id":{"required":true,"maxlength":"10"},"material_id":{"required":true,"maxlength":"10"},"site_id":{"required":true,"maxlength":"10"},"reg_time":{"required":true,"maxlength":16},"subsist_sign":{"required":true,"maxlength":"100"},"category_id":{"required":true,"maxlength":"4"}},"messages":{"uid":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"passport":{"required":"\u3010\u5e73\u53f0\u8d26\u53f7\u540d\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u8d26\u53f7\u540d\u3011\u4e0d\u80fd\u8d85\u8fc740\u4e2a\u5b57\u7b26"},"partner_id":{"required":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0ID\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"plan_id":{"required":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8ba1\u5212id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"account_id":{"required":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u8d26\u53f7id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"material_id":{"required":"\u3010\u7d20\u6750id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7d20\u6750id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"site_id":{"required":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7ad9\u70b9id\u3011\u4e0d\u80fd\u8d85\u8fc710\u4e2a\u5b57\u7b26"},"reg_time":{"required":"\u3010\u6ce8\u518c\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6ce8\u518c\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"subsist_sign":{"required":"\u3010\u7559\u5b58\u6807\u8bb0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7559\u5b58\u6807\u8bb0\u3011\u4e0d\u80fd\u8d85\u8fc7100\u4e2a\u5b57\u7b26"},"category_id":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc74\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection