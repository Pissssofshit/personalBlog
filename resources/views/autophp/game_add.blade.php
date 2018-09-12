		@extends('autophp.common.index')
		@section('title')
		游戏管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">游戏管理</a></li>
					<li class="active">游戏渠道包</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/game">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/game/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：游戏管理 >> 游戏渠道包">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>添加</legend>
	<form action="/autophp/game/" method="post">
		<ul class="list_A">
			<input type='hidden' name='_token' value='{{$csrf_token}}'><li><label class="display_name">主体id</label><input type="text" maxlength="11" name="entity_id" id="entity_id" value="{{isset($detail['entity_id'])?$detail['entity_id']:''}}"></input></li>
<li><label class="display_name">游戏名称</label><input type="text" maxlength="250" name="name" id="name" value="{{isset($detail['name'])?$detail['name']:''}}"></input></li>
<li><label class="display_name">拼音简写</label><input type="text" maxlength="250" name="name_en" id="name_en" value="{{isset($detail['name_en'])?$detail['name_en']:''}}"></input></li>
<li><label class="display_name">图标</label><input type="text" maxlength="250" name="icon" id="icon" value="{{isset($detail['icon'])?$detail['icon']:''}}"></input></li>
<li><label class="display_name">描述</label><input type="text" maxlength="" name="desc" id="desc" value="{{isset($detail['desc'])?$detail['desc']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="250" name="category" id="category" value="{{isset($detail['category'])?$detail['category']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='ABC3类' >分级</a>:</label><input type="text" maxlength="250" name="rank" id="rank" value="{{isset($detail['rank'])?$detail['rank']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='默认为1android' >系统类别</a>:</label><input type="text" maxlength="2" name="os" id="os" value="{{isset($detail['os'])?$detail['os']:''}}"></input></li>
<li><label class="display_name">普通签名key</label><input type="text" maxlength="250" name="common_sign_key" id="common_sign_key" value="{{isset($detail['common_sign_key'])?$detail['common_sign_key']:''}}"></input></li>
<li><label class="display_name">确认接口签名key</label><input type="text" maxlength="255" name="confirm_sign_key" id="confirm_sign_key" value="{{isset($detail['confirm_sign_key'])?$detail['confirm_sign_key']:''}}"></input></li>
<li><label class="display_name">冲值签名key</label><input type="text" maxlength="255" name="pay_sign_key" id="pay_sign_key" value="{{isset($detail['pay_sign_key'])?$detail['pay_sign_key']:''}}"></input></li>
<li><label class="display_name">冲值回调url</label><input type="text" maxlength="255" name="pay_callback" id="pay_callback" value="{{isset($detail['pay_callback'])?$detail['pay_callback']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='如钻石' >游戏币名称</a>:</label><input type="text" maxlength="255" name="coin_unit" id="coin_unit" value="{{isset($detail['coin_unit'])?$detail['coin_unit']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='1元人民币兑换多少游戏币' >兑换率</a>:</label><input type="text" maxlength="11" name="coin_rate" id="coin_rate" value="{{isset($detail['coin_rate'])?$detail['coin_rate']:''}}"></input></li>
<li><label class="display_name"><a href='javascript:' title='对应渠道标记为0' >原始ucode</a>:</label><input type="text" maxlength="11" name="ucode" id="ucode" value="{{isset($detail['ucode'])?$detail['ucode']:''}}"></input></li>
<li><label class="display_name">版本</label><input type="text" maxlength="255" name="version" id="version" value="{{isset($detail['version'])?$detail['version']:''}}"></input></li>
<li><label class="display_name">包地址</label><input type="text" maxlength="255" name="package_url" id="package_url" value="{{isset($detail['package_url'])?$detail['package_url']:''}}"></input></li>
<li><label class="display_name">创建时间戳</label><input type="text"  maxlength="16" name="create_time" id="create_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['create_time'])?$detail['create_time']:''}}"></input></li>
<li><label class="display_name">更新时间戳</label><input type="text"  maxlength="16" name="update_time" id="update_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['update_time'])?$detail['update_time']:''}}"></input></li>
<li><label class="display_name">创建者</label><input type="text" maxlength="255" name="create_by" id="create_by" value="{{isset($detail['create_by'])?$detail['create_by']:''}}"></input></li>
<li><label class="display_name">更新者</label><input type="text" maxlength="255" name="update_by" id="update_by" value="{{isset($detail['update_by'])?$detail['update_by']:''}}"></input></li>
<li class="clearfix"></li><li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"entity_id":{"required":true,"maxlength":"11"},"name":{"required":true,"maxlength":"250"},"name_en":{"required":true,"maxlength":"250"},"icon":{"required":true,"maxlength":"250"},"desc":{"required":true,"maxlength":""},"category":{"required":true,"maxlength":"250"},"rank":{"required":true,"maxlength":"250"},"os":{"required":true,"maxlength":"2"},"common_sign_key":{"required":true,"maxlength":"250"},"confirm_sign_key":{"required":true,"maxlength":"255"},"pay_sign_key":{"required":true,"maxlength":"255"},"pay_callback":{"required":true,"maxlength":"255"},"coin_unit":{"required":true,"maxlength":"255"},"coin_rate":{"required":true,"maxlength":"11"},"ucode":{"required":true,"maxlength":"11"},"version":{"required":true,"maxlength":"255"},"package_url":{"required":true,"maxlength":"255"},"create_time":{"required":true,"maxlength":16},"update_time":{"required":true,"maxlength":16},"create_by":{"required":true,"maxlength":"255"},"update_by":{"required":true,"maxlength":"255"}},"messages":{"entity_id":{"required":"\u3010\u4e3b\u4f53id\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u4e3b\u4f53id\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"name":{"required":"\u3010\u6e38\u620f\u540d\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620f\u540d\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"name_en":{"required":"\u3010\u62fc\u97f3\u7b80\u5199\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u62fc\u97f3\u7b80\u5199\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"icon":{"required":"\u3010\u56fe\u6807\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u56fe\u6807\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"desc":{"required":"\u3010\u63cf\u8ff0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u63cf\u8ff0\u3011\u4e0d\u80fd\u8d85\u8fc7\u4e2a\u5b57\u7b26"},"category":{"required":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7c7b\u578b\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"rank":{"required":"\u3010\u5206\u7ea7:ABC3\u7c7b\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5206\u7ea7:ABC3\u7c7b\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"os":{"required":"\u3010\u7cfb\u7edf\u7c7b\u522b:\u9ed8\u8ba4\u4e3a1android\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7cfb\u7edf\u7c7b\u522b:\u9ed8\u8ba4\u4e3a1android\u3011\u4e0d\u80fd\u8d85\u8fc72\u4e2a\u5b57\u7b26"},"common_sign_key":{"required":"\u3010\u666e\u901a\u7b7e\u540dkey\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u666e\u901a\u7b7e\u540dkey\u3011\u4e0d\u80fd\u8d85\u8fc7250\u4e2a\u5b57\u7b26"},"confirm_sign_key":{"required":"\u3010\u786e\u8ba4\u63a5\u53e3\u7b7e\u540dkey\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u786e\u8ba4\u63a5\u53e3\u7b7e\u540dkey\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"pay_sign_key":{"required":"\u3010\u51b2\u503c\u7b7e\u540dkey\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u51b2\u503c\u7b7e\u540dkey\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"pay_callback":{"required":"\u3010\u51b2\u503c\u56de\u8c03url\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u51b2\u503c\u56de\u8c03url\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"coin_unit":{"required":"\u3010\u6e38\u620f\u5e01\u540d\u79f0:\u5982\u94bb\u77f3\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u6e38\u620f\u5e01\u540d\u79f0:\u5982\u94bb\u77f3\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"coin_rate":{"required":"\u3010\u5151\u6362\u7387:1\u5143\u4eba\u6c11\u5e01\u5151\u6362\u591a\u5c11\u6e38\u620f\u5e01\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5151\u6362\u7387:1\u5143\u4eba\u6c11\u5e01\u5151\u6362\u591a\u5c11\u6e38\u620f\u5e01\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"ucode":{"required":"\u3010\u539f\u59cbucode:\u5bf9\u5e94\u6e20\u9053\u6807\u8bb0\u4e3a0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u539f\u59cbucode:\u5bf9\u5e94\u6e20\u9053\u6807\u8bb0\u4e3a0\u3011\u4e0d\u80fd\u8d85\u8fc711\u4e2a\u5b57\u7b26"},"version":{"required":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u7248\u672c\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"package_url":{"required":"\u3010\u5305\u5730\u5740\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u5305\u5730\u5740\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"create_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"update_time":{"required":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u65f6\u95f4\u6233\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"},"create_by":{"required":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"},"update_by":{"required":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u66f4\u65b0\u8005\u3011\u4e0d\u80fd\u8d85\u8fc7255\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection