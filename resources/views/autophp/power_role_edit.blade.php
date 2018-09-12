		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">角色管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_role">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_role/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 角色管理">
			<div class="easyui-panel" border="false" style="padding:1px">
				<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/power_role/{{$detail->power_role_id}}" method="post">
		<ul class="list_A">
			<input type="hidden" name="_method" value="PUT"/><input type='hidden' name='_token' value='{{$csrf_token}}' /><input type="hidden" maxlength="10" name="power_role_id" id="power_role_id" value="{{isset($detail['power_role_id'])?$detail['power_role_id']:''}}"></input>
<li><label class="display_name">角色名称</label><input type="text" maxlength="30" name="power_role_name" id="power_role_name" value="{{isset($detail['power_role_name'])?$detail['power_role_name']:''}}"></input></li>
<li><label class="display_name">角色权限内容</label>		<table style="border:1px solid #CCCCCC; clear:none; width:200px ">
	    @foreach($power_list as $key=>$power)
	    <tr>
	    	<td style="text-align:left;">
	        <a style="cursor:pointer"><span onclick="$('#tag_{{$key}}').toggle();">[+]</span></a>
	        <input type="checkbox" id="box_{{$key}}" class="box_tag"/>&nbsp;{{$power.name}}
	        </td>
	    </tr>
	    <tr id="tag_{{$key}}">
	    	<td style="padding-left:35px; text-align:left ">
	        @foreach($power.sub as $action)
	        <input name="content[{{$key}}][]" type="checkbox" value="{{$action.url}}" class="box_{{$key}}" onclick="subbox_check(this)" <!--{if isset($detail.content.$key) && in_array($action.url,$detail.content.$key)}-->checked<!--{/if}-->/>&nbsp;{{$action.name}}<br />
	        @endforeach
	        </td>
	    </tr>			    
   		@endforeach
       </table>
<script type="text/javascript">
    $(".box_tag").bind('click',function(){
    	class_name = $(this).attr("id");
		if($(this).attr("checked") == true){
			$("."+class_name).attr("checked",true);
		}else{
			$("."+class_name).attr("checked",false);
		}
    })
	$("#AddForm").validate({
	     rules: { name:{required: true} },
		 messages: { truename:{required: "角色名称不能为空。" } }
	});
	function subbox_check(obj){
		class_name = $(obj).attr("class");
		flag = true;
		$("."+class_name).each(function(){
				if($(this).attr("checked") == false){
					flag = false;
				}
			})
	    $("#"+class_name).attr("checked",flag);
	}
</script>	</li>

<li class="clearfix"></li><li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" /><input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({"rules":{"power_role_name":{"required":true,"maxlength":"30"},"created_time":{"required":false,"maxlength":16}},"messages":{"power_role_name":{"required":"\u3010\u89d2\u8272\u540d\u79f0\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u89d2\u8272\u540d\u79f0\u3011\u4e0d\u80fd\u8d85\u8fc730\u4e2a\u5b57\u7b26"},"created_time":{"required":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u4e3a\u7a7a","maxlength":"\u3010\u521b\u5efa\u65f6\u95f4\u3011\u4e0d\u80fd\u8d85\u8fc716\u4e2a\u5b57\u7b26"}}});
</script>
			</div>
		</div>
@endsection