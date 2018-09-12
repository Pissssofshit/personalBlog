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
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="uid" id="uid" value="{{isset($detail['uid'])?$detail['uid']:''}}"></input></li>
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
<li><label class="display_name">注册时间</label><input type="text" style='width:100px;' maxlength="16" name="reg_time_start" id="reg_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time_start'])?$detail['reg_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="reg_time_end" id="reg_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time_end'])?$detail['reg_time_end']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="4" name="category_id" id="category_id" value="{{isset($detail['category_id'])?$detail['category_id']:''}}"></input></li>

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
				<th>没用的主键</th> 
<th>平台ID</th> 
<th>平台账号名</th> 
<th>平台ID</th> 
<th>计划id</th> 
<th>账号id</th> 
<th>游戏id</th> 
<th>素材id</th> 
<th>站点id</th> 
<th>是否创角</th> 
<th>是否新注册用户(滚游戏)</th> 
<th>注册时间</th> 
<th>类型</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->uid}}</td> 
<td>{{$item->passport}}</td> 
<td>{{$item->partner_id}}</td> 
<td>{{$item->plan_id}}</td> 
<td>{{$item->account_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->material_id}}</td> 
<td>{{$item->site_id}}</td> 
<?php $is_role= isset($dict_boolean[$item->is_role])?$dict_boolean[$item->is_role]:'';?><td>{{$is_role}}</td> 
<?php $is_reg= isset($dict_boolean[$item->is_reg])?$dict_boolean[$item->is_reg]:'';?><td>{{$is_reg}}</td> 
<td>{{$item->reg_time?date('Y-m-d H:i:s',$item->reg_time):''}}</td> 
<td>{{$item->category_id}}</td> 
<td><a href="/autophp/user/{{$item->id}}">查看</a> 
					<a href="/autophp/user/{{$item->id}}/edit">编辑</a></td>
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