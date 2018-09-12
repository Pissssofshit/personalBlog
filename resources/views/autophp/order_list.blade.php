		@extends('autophp.common.index')
		@section('title')
		充值管理
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">充值管理</a></li>
					<li class="active">订单</li>
				</ol>
		</div>
		<ul class="clearfix">
				<li class="admin_tab"><a href="/autophp/order">列  表</a></li>
				<li class="admin_tab"><a href="/autophp/order/create">添  加</a></li>
		</ul>
		<div id="main" class="easyui-panel" title="当前位置：充值管理 >> 订单">
			<div class="easyui-panel" border="false" style="padding:1px">
				

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				<th>ID</th> 
<th>平台用户id</th> 
<th>游戏id</th> 
<th>渠道标示</th> 
<th>游戏币数量</th> 
<th>订单金额</th> 
<th><a href='javascript:' title='0-平台币;pay_channel里的id' >支付方式</a></th><th>支付平台币数量</th> 
<th>支付的平台赠送平台币数量</th> 
<th>实际支付金额</th> 
<th>支付的虚拟货币</th> 
<th>创建时间戳</th> 
<th>更新时间戳</th> 
<th><a href='javascript:' title='1-已创建；2-已提交第三方；3-第三方充值成功；4-调用游戏后台接口下发游戏币成功；5-等待继续支付；6-支付超时；7-支付失败' >订单状态</a></th><th>操作</th> 

			</tr>
            @if(isset($list)&&!empty($list))
			@foreach($list as $key=>$item)
			<tr>
				<td>{{$item->id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->game_id}}</td> 
<td>{{$item->ucode}}</td> 
<td>{{$item->order_coin}}</td> 
<td>{{$item->order_money}}</td> 
<td>{{$item->pay_channel_id}}</td> 
<td>{{$item->pay_point}}</td> 
<td>{{$item->pay_point_free}}</td> 
<td>{{$item->pay_money}}</td> 
<td>{{$item->pay_virtual_point}}</td> 
<td>{{$item->create_time?date('Y-m-d H:i:s',$item->create_time):''}}</td> 
<td>{{$item->update_time?date('Y-m-d H:i:s',$item->update_time):''}}</td> 
<td>{{$item->status}}</td> 
<td><a href="/autophp/order/{{$item->id}}">查看</a> 
					<a href="/autophp/order/{{$item->id}}/edit">编辑</a></td>
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