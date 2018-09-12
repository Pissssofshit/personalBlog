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
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">游戏名</label><input type="text" maxlength="40" name="game_name" id="game_name" value="{{isset($detail['game_name'])?$detail['game_name']:''}}"></input></li>
<li><label class="display_name">是否启用</label><?php $state= isset($detail['state'])?$detail['state']:0;?>
                    @if(isset($dict_boolean)&&!empty($dict_boolean)) 
                    @foreach($dict_boolean as $key=>$val)
                    <input type='radio' name=\'state\' @if($key==$state) selected @endif value=$key>{{$val}}
                    @endforeach
                    @endif
                    </li>
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
				<th>游戏ID</th> 
<th>平台ID</th> 
<th>游戏名</th> 
<th>是否启用</th> 
<th>类型</th> 
<th>是否最新服</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->game_id}}</td> 
<td>{{$item->partner_id}}</td> 
<td>{{$item->game_name}}</td> 
<?php $state= isset($dict_boolean[$item->state])?$dict_boolean[$item->state]:'';?><td>{{$state}}</td> 
<td>{{$item->category_id}}</td> 
<td>{{$item->new_server}}</td> 
<td><a href="/autophp/rem_game/{{$item->game_id}}">查看</a> 
					<a href="/autophp/rem_game/{{$item->game_id}}/edit">编辑</a></td>
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