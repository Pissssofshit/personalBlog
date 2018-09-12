		@extends('autophp.common.index')
		@section('title')
		data
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">data</a></li>
					<li class="active">充值订单表</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/pay_log">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/pay_log/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：data >> 充值订单表">
			<div class="easyui-panel" border="false" style="padding:1px">
					<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{$action_url}}" exportaction="{{$action_url}}/export">
			<ul class="searchlegend">
				<li><label class="display_name">订单号</label><input type="text" maxlength="32" name="order_id" id="order_id" value="{{isset($detail['order_id'])?$detail['order_id']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="uid" id="uid" value="{{isset($detail['uid'])?$detail['uid']:''}}"></input></li>
<li><label class="display_name">平台ID</label><input type="text" maxlength="10" name="partner_id" id="partner_id" value="{{isset($detail['partner_id'])?$detail['partner_id']:''}}"></input></li>
<li><label class="display_name">游戏id</label><input type="text" maxlength="10" name="game_id" id="game_id" value="{{isset($detail['game_id'])?$detail['game_id']:''}}"></input></li>
<li><label class="display_name">服id</label><input type="text" maxlength="10" name="server_id" id="server_id" value="{{isset($detail['server_id'])?$detail['server_id']:''}}"></input></li>
<li><label class="display_name">站点id</label><input type="text" maxlength="10" name="site_id" id="site_id" value="{{isset($detail['site_id'])?$detail['site_id']:''}}"></input></li>
<li><label class="display_name">注册时间</label><input type="text" style='width:100px;' maxlength="16" name="reg_time_start" id="reg_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time_start'])?$detail['reg_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="reg_time_end" id="reg_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['reg_time_end'])?$detail['reg_time_end']:''}}"></input></li>
<li><label class="display_name">充值时间</label><input type="text" style='width:100px;' maxlength="16" name="pay_time_start" id="pay_time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['pay_time_start'])?$detail['pay_time_start']:''}}"></input> - <input type="text" style='width:100px;' maxlength="16" name="pay_time_end" id="pay_time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{isset($detail['pay_time_end'])?$detail['pay_time_end']:''}}"></input></li>
<li><label class="display_name">类型</label><input type="text" maxlength="10" name="pay_money" id="pay_money" value="{{isset($detail['pay_money'])?$detail['pay_money']:''}}"></input></li>

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
<th>订单号</th> 
<th>平台ID</th> 
<th>平台ID</th> 
<th>游戏id</th> 
<th>服id</th> 
<th>站点id</th> 
<th>注册时间</th> 
<th>充值时间</th> 
<th>类型</th> 
<th>首充</th> 
<th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->order_id}}</td> 
<td>{{$item->uid}}</td> 
<td>{{$item->partner_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->server_id}}</td> 
<td>{{$item->site_id}}</td> 
<td>{{$item->reg_time?date('Y-m-d H:i:s',$item->reg_time):''}}</td> 
<td>{{$item->pay_time?date('Y-m-d H:i:s',$item->pay_time):''}}</td> 
<td>{{$item->pay_money}}</td> 
<td>{{$item->is_1st_pay}}</td> 
<td><a href="/autophp/pay_log/{{$item->id}}">查看</a> 
					<a href="/autophp/pay_log/{{$item->id}}/edit">编辑</a></td>
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