		@extends('autophp.common.index')
		@section('title')
		权限管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">权限管理</a></li>
					<li class="active">用户管理</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/power_user">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/power_user/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：权限管理 >> 用户管理">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">用户帐号</label><input type="text" maxlength="30" name="power_user_name" id="power_user_name" value="{{isset($detail['power_user_name'])?$detail['power_user_name']:''}}"></input></li>
<li><label class="display_name">角色类型</label><select name="power_role_id" id="power_role_id">
                            @if(isset($dict_power_role[1])&&!empty($dict_power_role[1])) 
                           @foreach($dict_power_role[1] as $key=>$val)
                            <option value={{$key}} @if($dict_power_role[0]==$key) selected  @endif>{{$val}}</option>
                           @endforeach
                           @endif
                      
                </select></li>

				<li><input class="kbutton kbutton_A" type="submit" value="搜  索" id="btn_search" /></li>
				<li><input class="kbutton kbutton_A" value=" 导  出 " id="btn_export" /></li>
			</ul>
		</form>
	</fieldset>

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID编号</th> 
<th>用户帐号</th> 
<th>真实姓名</th> 
<th>密码</th> 
<th>角色类型</th> 
<th>创建时间</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->power_user_id}}</td> 
<td>{{$item->power_user_name}}</td> 
<td>{{$item->truename}}</td> 
<td>{{$item->password}}</td> 
<?php $power_role_id= isset($dict_power_role[1][$item->power_role_id])?$dict_power_role[1][$item->power_role_id]:'';?><td>{{$power_role_id}}</td> 
<td>{{$item->created_time?date('Y-m-d H:i:s',$item->created_time):''}}</td> 
<td><a href="/autophp/power_user/{{$item->power_user_id}}">查看</a> 
					<a href="/autophp/power_user/{{$item->power_user_id}}/edit">编辑</a></td>
			</tr>
			@endforeach
			@endif
		</table>
		</div></div>
		<div class="list_page"> {!!$page_html!!}</div>
	</fieldset>
			</div>
		</div>
@endsection