		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏开关</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game_config_switch">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game_config_switch/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏开关">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/game_config_switch/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">游戏id</label><input type="text" maxlength="11" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='1开启;2关闭' >广告统计app开关</a>:</label><input type="text" maxlength="2" name="ad_stat_switch" id="ad_stat_switch" value="{{isset($detail['ad_stat_switch'])?$detail['ad_stat_switch']:''}}"></input></li>
<li><label class="display_name">广告统计参数</label><input type="text" maxlength="255" name="ad_stat_key" id="ad_stat_key" value="{{isset($detail['ad_stat_key'])?$detail['ad_stat_key']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='1开启;2关闭' >微信开关</a>:</label><input type="text" maxlength="2" name="weixin_switch" id="weixin_switch" value="{{isset($detail['weixin_switch'])?$detail['weixin_switch']:''}}"></input></li>
<li><label class="display_name">app id</label><input type="text" maxlength="255" name="weixin_app_id" id="weixin_app_id" value="{{isset($detail['weixin_app_id'])?$detail['weixin_app_id']:''}}"></input></li>
<li><label class="display_name">app key</label><input type="text" maxlength="255" name="weixin_app_key" id="weixin_app_key" value="{{isset($detail['weixin_app_key'])?$detail['weixin_app_key']:''}}"></input></li>
<li><label class="display_name">app secret</label><input type="text" maxlength="255" name="weixin_app_secret" id="weixin_app_secret" value="{{isset($detail['weixin_app_secret'])?$detail['weixin_app_secret']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='游戏启动动画是否播放平台logo' >平台闪屏开关</a>:</label><input type="text" maxlength="2" name="show_platform_switch" id="show_platform_switch" value="{{isset($detail['show_platform_switch'])?$detail['show_platform_switch']:''}}"></input></li>
<li><label class="display_name">充值邦定手机提示</label><input type="text" maxlength="2" name="bind_mobile_when_pay_switch" id="bind_mobile_when_pay_switch" value="{{isset($detail['bind_mobile_when_pay_switch'])?$detail['bind_mobile_when_pay_switch']:''}}"></input></li>
<li><label class="display_name">一键注册开关</label><input type="text" maxlength="2" name="one_key_registe_switch" id="one_key_registe_switch" value="{{isset($detail['one_key_registe_switch'])?$detail['one_key_registe_switch']:''}}"></input></li>
<li><label class="display_name">创建时间戳</label><input type="text"  maxlength="16" name="create_time" id="create_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['create_time'])?$detail['create_time']:''}}"></input></li>
<li><label class="display_name">更新时间戳</label><input type="text"  maxlength="16" name="update_time" id="update_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['update_time'])?$detail['update_time']:''}}"></input></li>
<li><label class="display_name">创建者</label><input type="text" maxlength="255" name="create_by" id="create_by" value="{{isset($detail['create_by'])?$detail['create_by']:''}}"></input></li>
<li><label class="display_name">更新者</label><input type="text" maxlength="255" name="update_by" id="update_by" value="{{isset($detail['update_by'])?$detail['update_by']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"game_id":{"required":true,"maxlength":"11"},"ad_stat_switch":{"required":true,"maxlength":"2"},"ad_stat_key":{"required":true,"maxlength":"255"},"weixin_switch":{"required":true,"maxlength":"2"},"weixin_app_id":{"required":true,"maxlength":"255"},"weixin_app_key":{"required":true,"maxlength":"255"},"weixin_app_secret":{"required":true,"maxlength":"255"},"show_platform_switch":{"required":true,"maxlength":"2"},"bind_mobile_when_pay_switch":{"required":true,"maxlength":"2"},"one_key_registe_switch":{"required":true,"maxlength":"2"},"create_time":{"required":true,"maxlength":16},"update_time":{"required":true,"maxlength":16},"create_by":{"required":true,"maxlength":"255"},"update_by":{"required":true,"maxlength":"255"}},"messages":{"game_id":{"required":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620fid\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"ad_stat_switch":{"required":"\u3010\u5e7f\u544a\u7edf\u8ba1app\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e7f\u544a\u7edf\u8ba1app\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"ad_stat_key":{"required":"\u3010\u5e7f\u544a\u7edf\u8ba1\u53c2\u6570\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e7f\u544a\u7edf\u8ba1\u53c2\u6570\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"weixin_switch":{"required":"\u3010\u5fae\u4fe1\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5fae\u4fe1\u5f00\u5173:1\u5f00\u542f;2\u5173\u95ed\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"weixin_app_id":{"required":"\u3010app id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010app id\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"weixin_app_key":{"required":"\u3010app key\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010app key\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"weixin_app_secret":{"required":"\u3010app secret\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010app secret\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"show_platform_switch":{"required":"\u3010\u5e73\u53f0\u95ea\u5c4f\u5f00\u5173:\u6e38\u620f\u542f\u52a8\u52a8\u753b\u662f\u5426\u64ad\u653e\u5e73\u53f0logo\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5e73\u53f0\u95ea\u5c4f\u5f00\u5173:\u6e38\u620f\u542f\u52a8\u52a8\u753b\u662f\u5426\u64ad\u653e\u5e73\u53f0logo\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"bind_mobile_when_pay_switch":{"required":"\u3010\u5145\u503c\u90a6\u5b9a\u624b\u673a\u63d0\u793a\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5145\u503c\u90a6\u5b9a\u624b\u673a\u63d0\u793a\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"one_key_registe_switch":{"required":"\u3010\u4e00\u952e\u6ce8\u518c\u5f00\u5173\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4e00\u952e\u6ce8\u518c\u5f00\u5173\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"create_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"update_time":{"required":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"create_by":{"required":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"update_by":{"required":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection