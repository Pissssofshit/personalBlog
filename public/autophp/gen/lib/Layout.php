<?php
class Content {
	private $_tableNode;
	private $_pk;
	private $_indexhtml;
	public function __construct($tableNode) {
		$this->_tableNode = $tableNode;

		foreach($this->_tableNode->columns->column as $column) {
			if ($column['extra'] == "auto_increment") {
				$this->_pk = $column['name'];
				break;
			}
		}

		if (!empty($this->_pk)) {
			return;
		}

		foreach($this->_tableNode->keys->key as $key) {
			if ($key['type'] == "pk") {
				$this->_pk = $key->column[0]["name"];
			}
		}

	}

	public function _index() {
		$table_name = $this->_tableNode['name'];
		$code = <<<EOF


EOF;
		$this->_indexhtml = $code;
		return $code;
	}

	public function _add() {
		$input = "<input type='hidden' name='_token' value='{{\$csrf_token}}'>";

		foreach($this->_tableNode->columns->column as $column) {
		    if($column['name'] !=$this->_pk) {
                $input .= $this->_inputHtml($column) . "\n";
            }
		}

		$json = $this->_validJs([$this->_pk]);

		$input .= '<li class="clearfix"></li>';

		$input .= '<li class="ml35"><input class="kbutton" type="submit" value="确 认" id="btn_submit" />';
		$input .= '<input class="kbutton" type="reset" value="重 置" id="btn_reset"/></li>';

		$tablename = $this->_tableNode['name'];

		$form = <<<EOF
<fieldset>
	<legend>添加</legend>
	<form action="/autophp/{$tablename}/" method="post">
		<ul class="list_A">
			$input
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({$json});
</script>
EOF;
		return $form;
	}

	public function _edit() {
		$input .= '<input type="hidden" name="_method" value="PUT"/>';
		$input .= "<input type='hidden' name='_token' value='{{\$csrf_token}}' />";
		foreach($this->_tableNode->columns->column as $column) {
			$input .= $this->_inputHtml($column) . "\n";
		}

		$input .= '<li class="clearfix"></li>';

		$input .= '<li class="ml35"><input class="kbutton"  type="submit" value="确 认" id="btn_submit" />';
		$input .= '<input class="kbutton" type="button" value="取 消" id="btn_reset" onclick="javascript:history.back()"/></li>';

		$tablename = $this->_tableNode['name'];

		$form = <<<EOF
<fieldset>
	<legend>编辑</legend>
	<form action="/autophp/{$tablename}/{{\$detail->{$this->_pk}}}" method="post">
		<ul class="list_A">
			$input
		</ul>
	</form>
</fieldset>

<script type="text/javascript">		
	    $("form").validate({$this->_validJs()});
</script>
EOF;
		return $form;
	}

	public function _detail() {
		$tableName = $this->_tableNode['name'];
		foreach($this->_tableNode->columns->column as $column) {
			if ($column['type'] == "boolean") {
				//$li .= "{{assign var=\"{$column['name']}\" value=\$dict_boolean[\$detail.{$column['name']}]}}";
                $li .="<?php \${$column['name']}= isset(\$dict_boolean[\$detail['{$column['name']}']])?\$dict_boolean[\$detail['{$column['name']}']]:'';?>";
				$li .= "<li><label class=\"display_name\">{$column['displayName']}:</label><span>{{\${$column['name']}}}</span></li>";
				continue;
			}

			if ($column['displayType'] == "privilege") {
				$li .= <<<EOF
				<li><label class="display_name">{$column['displayName']}:</label>
				<span>
		        <table style="border:1px solid #CCCCCC; clear:none; width:200px">
	                @if(isset(\$power_list)&&!empty(\$power_list))
				    @foreach(\$power_list as \$key=>\$power)
				    <tr>
				    	<td style="text-align:left;">
					    	@if(isset(\$detail["content"][\$key]))
					    	{{\$power.name}}
					    	@endif
				    	</td>
				    </tr>
				    <tr>
				    	<td style="padding-left:35px; text-align:left ">
			            @if(isset(\$power["sub"])&&!empty(\$power["sub"]))
				        @foreach(\$power.sub as \$action)
					        @if(isset(\$detail["content"][\$key]) && in_array(\$action.url,\$detail["content"][\$key]))
					        {{\$action.name}}<br />
					        @endif
				       @endforeach
				       @endif
				        </td>
				    </tr>			    
		    		@endforeach
		    		@endif
		        </table>			
			</span>
EOF;
				continue;
			}

			if ($column['displayType'] == "textarea") {
				$li .= "<li><label class=\"display_name\">{$column['displayName']}:</label><span style='display: inline-block; vertical-align: top;'><pre>{{\$detail->{$column['name']}}}</pre></span></li>";
				continue;
			}

			$refer_table = $this->_getRefer($column['name']);
			if ($refer_table) {
				if ($column['displayType'] == "checkbox") {
					$li .= <<<EOF

			<li>
				<label class="display_name">{$column['displayName']}:</label>
				<span>
	        @if(isset(\$detail->{$column['name']})&&!empty(\$detail->{$column['name']})
				@foreach(\$detail->{$column['name']} as \$id)
					 <?php \${$column['name']}= isset(\$dict_{$refer_table}[1][\$id])?\$dict_{$refer_table}[1][\$id]:'';?>
					{{\${$column['name']}}}
					@endforeach
	        @endif
				</span>
			</li>
EOF;
					continue;
				}

				//$li .= "{{assign var=\"{$column['name']}\" value=\$dict_{$refer_table}[1][\$detail->{$column['name']}]}}";
                $li .= "<?php \${$column['name']}= isset(\$dict_{$refer_table}[1][\$detail->{$column['name']}])?\$dict_{$refer_table}[1][\$detail->{$column['name']}]:'';?>";
				$li .= "<li><label class=\"display_name\">{$column['displayName']}:</label><span>{{\${$column['name']}}}</span></li>";
			}
			else {
				$li .= "<li><label class=\"display_name\">{$column['displayName']}:</label><span>{{\$detail->{$column['name']}}}</span></li>";
			}
		}
		$li .= '<li class="clearfix"></li>';

		$js_edit = "javascript:location.href='./{{\$detail->{$this->_pk}}}/edit'";
		$js_delete = "javascript:confirm('确认需要删除此记录！！！')? deleteItem('/autophp/{$tableName}/{{\$detail->{$this->_pk}}}', {'_method':'DELETE'}) : null;";

		$li .= '<li class="ml35"><input class="kbutton" type="button" value="编辑" id="btn_edit"  onclick="' . $js_edit . '"/>';
		$li .= '<input class="kbutton" type="button" value="删除" id="btn_delete"  onclick="' . $js_delete . '"/></li>';
		$detail = <<<EOF
<fieldset>
	<legend>详情</legend>
	<form action="" method="post">
		<ul class="list_A">
			$li
		</ul>
	</form>
</fieldset>


<script type="text/javascript">
	function deleteItem(url, params) {
		params._token = "{{\$csrf_token}}" ;
		$.post(url, params, function(data){
			alert(data > 0 ? "删除成功":"删除失败");
			location.href="/autophp/{$tableName}";
			
		});
	}
</script>
EOF;
		return $detail;
	}

	public function _list() {
		foreach($this->_tableNode->columns->column as $column) {
			if (!empty($column['queryType'])) {
				$li .= $this->_inputHtml($column, true) . "\n";
			}
			else if ($column['type'] == "text" || preg_match("/char\(\d{3,}\)/", $column['type'])) {
				continue;
			}

			if (!empty($column['displayName'])) {
				list($display, $desc) = explode(":",$column['displayName'], 2);

				if (empty($desc))
					$th .= "<th>{$column['displayName']}</th> \n";
				else
					$th .= "<th><a href='javascript:' title='{$desc}' >{$display}</a></th>";

				if ($column['type'] == "boolean") {
					//$td .= "<!--{assign var=\"{$column['name']}\" value=\$dict_boolean[\$item->{$column['name']}]}-->";
                    $td .= "<?php \${$column['name']}= isset(\$dict_boolean[\$item->{$column['name']}])?\$dict_boolean[\$item->{$column['name']}]:'';?>";
					$td .= "<td>{{\${$column['name']}}}</td> \n";
					continue;
				}

				$refer_table = $this->_getRefer($column['name']);
				if ($refer_table) {
					//$td .= "{{assign var=\"{$column['name']}\" value=\$dict_{$refer_table}[1][\$item->{$column['name']}]}}";
					$td .= "<?php \${$column['name']}= isset(\$dict_{$refer_table}[1][\$item->{$column['name']}])?\$dict_{$refer_table}[1][\$item->{$column['name']}]:'';?>";
					$td .= "<td>{{\${$column['name']}}}</td> \n";
				}
				else {
					if ($column['displayType'] == "time") {
						$td .= "<td>{{\$item->{$column['name']}?date('Y-m-d H:i:s',\$item->{$column['name']}):''}}</td> \n";
					}else {
						$td .= "<td>{{\$item->{$column['name']}}}</td> \n";
					}
				}
			}

		}

		$th .= "<th>操作</th> \n";
		$tablename = $this->_tableNode['name'];
		$td .= "<td><a href=\"/autophp/{$tablename}/{{\$item->{$this->_pk}}}\" class=\"lookdetail\"></a> 
					<a href=\"/autophp/{$tablename}/{{\$item->{$this->_pk}}}/edit\" class=\"editdetail\"></a></td>";

		if ($li) {
		$search_box = <<<EOF
	<fieldset class="search_canvas">
		<legend>搜索</legend>
		<form method="get" action="{{\$action_url}}" exportaction="{{\$action_url}}/export">
			<ul class="searchlegend searchflow" style="height:32px;overflow: hidden;position:relative;">
			    <a class="showopenicon"></a>
				{$li}
				<a class="showcloseicon"></a>
			</ul>
			<ul class="searchlegend" style="clear:both;">
				<li><input class="kbutton kbutton_A" type="submit" value="搜  索" id="btn_search" /></li>
				<li><input class="kbutton kbutton_A" type="button" value="导  出" id="btn_export" /></li>
			</ul>
		</form>
	</fieldset>
EOF;
		}

		$content = <<<EOF
{$search_box}

	<fieldset>
		<legend>列表</legend>
		<div class="panel panel-default">
			<div class="panel-body" style="padding:2px;">
		<table class="table table-striped withInsideBorder table-hover" style="text-align: center;background-color: #F2F2F2">
			<tr>
				{$th}
			</tr>
            @if(isset(\$list)&&!empty(\$list))
			@foreach(\$list as \$key=>\$item)
			<tr>
				{$td}
			</tr>
			@endforeach
			@endif
		</table>
		</div></div>
		<div class="list_page"> {!!\$page_html!!}</div>
	</fieldset>
EOF;
		return $content;
	}


	public function _tree() {
		if ($this->_tableNode['type'] != "tree" ) {
			return;
		}
		foreach($this->_tableNode->columns->column as $column) {
			if (!empty($column['queryType'])) {
				$li .= $this->_inputHtml($column, true) . "\n";
			}
			else if ($column['type'] == "text" || preg_match("/char\(\d{3,}\)/", $column['type'])) {
				continue;
			}

			$td_append .= "<td></td>";

			if (!empty($column['displayName'])) {
				$th .= "<th>{$column['displayName']}</th> \n";

				if ($column['type'] == "boolean") {
				//	$td .= "<!--{assign var=\"{$column['name']}\" value=\$dict_boolean[\$item->{$column['name']}]}-->";
                    $td .= "<?php \${$column['name']}= isset(\$dict_boolean[\$item->{$column['name']}])?\$dict_boolean[\$item->{$column['name']}]:'';?>";
                    $td .= "<td>{{\${$column['name']}}}</td> \n";
					continue;
				}

				$refer_table = $this->_getRefer($column['name']);
				if ($refer_table) {
					//$td .= "{{assign var=\"{$column['name']}\" value=\$dict_{$refer_table}[1][\$item->{$column['name']}]}}";
                    $td .= "<?php \${$column['name']}= isset(\$dict_{$refer_table}[1][\$item->{$column['name']}])?\$dict_{$refer_table}[1][\$item->{$column['name']}]:'';?>";
					$td .= "<td>{{\${$column['name']}}}</td> \n";
				}
				else {
					if ($column['displayType'] == "time") {
						$td .= "<td>{{\$item->{$column['name']}|date_format:\"%Y-%m-%d %H:%M\"}}</td> \n";
					}else {
						$td .= "<td>{{\$item->{$column['name']}}}</td> \n";
					}
				}
			}

		}

		$th .= "<th>操作</th> \n";
		$td .= "<td><span style='text-align:center'>
		<a href='javascript:void(0)' onclick='append({{\$item->{$this->_pk}}})' style='text-decoration:none;'>+</a>
		<a href='javascript:void(0)' onclick='delete({{\$item->{$this->_pk}}})' style='text-decoration:none;'>-</a>
		</span></td>";

				$content = <<<EOF
	<fieldset>
		<legend>列表</legend>
		<table>
			<tr>
				{$th}
			</tr>
			
			@foreach(\$tree.children as \$item)
			<tr class="lv1" id="tr_{{\$item->{$this->_pk}}}">
				{$td}
			</tr>
				@if(isset(\$item->children)&&!empty(\$item->children))
				@foreach(\$item->children as \$item)
				<tr class="lv2" style="background-color:#eee;font-size:11px" id="tr_{{\$item->{$this->_pk}}}">
					{$td}
				</tr>
					@if(isset(\$item->children)&&!empty(\$item->children))
					@foreach(\$item->children as \$item)
					<tr class="lv3" id="tr_{{\$item->{$this->_pk}}}">
						{$td}
					</tr>
					@endforeach
					@endif
				@endforeach
				@endif
			@endforeach
		</table>
		<div class="list_page">{{\$page_html}}</div>
	</fieldset>

	<script type="text/javascript">
	function append(id) {
		alert("$td_append");
		$("#tr_" + id).after("$td_append");
	}
	</script>
EOF;
		return $content;
	}

	public function _tip() {
		$content = <<<EOF
@if(\$ret)
	<div><span>操作成功！点这里返回列表</span></div>
@else
	<div><span>操作失败！您可以再次尝试操作，如果仍旧失败，请联系管理员</span></div>
@endif
EOF;
		return $content;
	}

	private function _validJs($expectfield=[]) {
        $valid = [];
		foreach($this->_tableNode->columns->column as $column) {
		    if(in_array($column["name"],$expectfield)){continue;}
			preg_match("@([a-zA-Z]+)\(?(\d*)\)?.*@", $column['type'], $matches);
			$len = $matches[2];

			$valid_types = array("text", "textarea", "select", "time", "password");
			if (!in_array($column['displayType'], $valid_types)) {
				continue;
			}

			if ($column['displayType'] == "time") {
				$len = 16;
			}

			$required = false;
			if ($column['nullable'] == "false") {
				$required = true;
			}

			$name = $column['name'];
			$valid['rules']["$name"] = array("required"=>$required, "maxlength"=>$len);
			$valid['messages']["$name"] = array("required"=>"【{$column['displayName']}】不能为空", "maxlength"=>"【{$column['displayName']}】不能超过{$len}个字符");
		}



		return json_encode($valid);
	}

	private function _inputHtml($column, $is_search = false) {
		preg_match("@([a-zA-Z]+)\(?(\d*)\)?.*@", $column['type'], $matches);
		$len = $matches[2];

		if ($column['extra']) {
			$input = "<input type=\"hidden\" maxlength=\"$len\" name=\"{$column['name']}\" id=\"{$column['name']}\" value=\"{{isset(\$detail['{$column['name']}'])?\$detail['{$column['name']}']:''}}\"></input>";
			return $input;
		}



		if (empty($column['displayType']))
			return;
		if (!empty($column['track']) && !$is_search)
			return;



		switch ($column['displayType']) {
			case "password":
				$input = "<input type=\"password\" maxlength=\"$len\" name=\"{$column['name']}\" id=\"{$column['name']}\" value=\"{{isset(\$detail['{$column['name']}'])?\$detail->{$column['name']}:''}}\"></input>";
				break;
			case "textarea":
				$input = "<textarea name=\"{$column['name']}\" id=\"{$column['name']}\" >{{isset(\$detail['{$column['name']}'])?\$detail['{$column['name']}']:''}}}</textarea>";
				break;
			case "select":
				$refer_table = $this->_getRefer($column['name']);
				$input = "<select name=\"{$column['name']}\" id=\"{$column['name']}\">
                            @if(isset(\$dict_{$refer_table}[1])&&!empty(\$dict_{$refer_table}[1])) 
                           @foreach(\$dict_{$refer_table}[1] as \$key=>\$val)
                            <option  @if(\$dict_{$refer_table}[0]==\$key) selected  @endif value={{\$key}}>{{\$val}}</option>
                           @endforeach
                           @endif
                      
                </select>";
				break;
			case "radio":
				if ($column['type'] == "boolean") {
                   $input = "<?php \${$column['name']}= isset(\$detail['{$column['name']}'])?\$detail['{$column['name']}']:{$column['default']};?>";
                  $input .= "
                    @if(isset(\$dict_boolean)&&!empty(\$dict_boolean)) 
                    @foreach(\$dict_boolean as \$key=>\$val)
                    <input type='radio' name=\"{$column['name']}\" @if(\$key==\${$column['name']}) checked @endif value={{\$key}}>{{\$val}}
                    @endforeach
                    @endif
                    ";
                    break;
				}

				$refer_table = $this->_getRefer($column['name']);
			    $input = "@if(isset(\$dict_{$refer_table}[1])&&!empty(\$dict_{$refer_table}[1])) 
                        @foreach(\$dict_{$refer_table}[1] as \$key=>\$val)
                    <input type='radio' name=\"{$column['name']}\" @if(\$key==\$dict_{$refer_table}[0]) checked @endif value={{\$key}}>{{\$val}}
                    @endforeach 
                    @endif
                    ";
				break;
			case "checkbox":
				$refer_table = $this->_getRefer($column['name']);
				$input = "<span class='kk_group_checkbox'>
                    @if(isset(\$dict_{$refer_table}[1])&&!empty(\$dict_{$refer_table}[1])) 
                   @foreach(\$dict_{$refer_table}[1] as \$key=>\$val)
                    <input type='checkbox' name=\"{$column['name']}[]\" @if(\$key==\$dict_{$refer_table}[0]) checked @endif value={{\$key}}>{{\$val}}
                   @endforeach
                   @endif
                   ";
				break;
			case "privilege":
				$input = <<<EOF
		<table style="border:1px solid #CCCCCC; clear:none; width:200px ">
		@if(isset(\$power_list)&&!empty(\$power_list)) 
	    @foreach(\$power_list as \$key=>\$power)
	    <tr>
	    	<td style="text-align:left;">
	        <a style="cursor:pointer"><span onclick="$('#tag_{{\$key}}').toggle();">[+]</span></a>
	        <input type="checkbox" id="box_{{\$key}}" class="box_tag"/>&nbsp;{{\$power.name}}
	        </td>
	    </tr>
	    <tr id="tag_{{\$key}}">
	    	<td style="padding-left:35px; text-align:left ">
	    	@if(isset(\$power["sub"])&&!empty(\$power["sub"])) 
	        @foreach(\$power["sub"] as \$action)
	        <?php \$userkey = isset(\$detail["content"][\$key])?\$detail["content"][\$key]:"";?>
	        <input name="content[{{\$key}}][]" type="checkbox" value="{{\$action.url}}" class="box_{{\$key}}" onclick="subbox_check(this)" @if(\$userkey && in_array(\$action.url,\$userkey)) checked @endif/>&nbsp;{{\$action.name}}<br />
	        @endforeach
	        @endif
	        </td>
	    </tr>			    
   		@endforeach
   		@endif
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
</script>	
EOF;
				break;
			case "time":
				$len = 16;
				if ($is_search && $column['queryType'] == "range") {
					$input = "<input type=\"text\" style='width:100px;' maxlength=\"$len\" name=\"{$column['name']}_start\" id=\"{$column['name']}_start\" onclick=\"WdatePicker({dateFmt:'yyyy-MM-dd'})\" value=\"{{isset(\$detail['{$column['name']}_start'])?\$detail['{$column['name']}_start']:''}}\"></input>";
					$input .= " - <input type=\"text\" style='width:100px;' maxlength=\"$len\" name=\"{$column['name']}_end\" id=\"{$column['name']}_end\" onclick=\"WdatePicker({dateFmt:'yyyy-MM-dd'})\" value=\"{{isset(\$detail['{$column['name']}_end'])?\$detail['{$column['name']}_end']:''}}\"></input>";
				}
				else {
					$input = "<input type=\"text\"  maxlength=\"$len\" name=\"{$column['name']}\" id=\"{$column['name']}\" onclick=\"WdatePicker({dateFmt:'yyyy-MM-dd'})\" value=\"{{isset(\$detail['{$column['name']}'])?\$detail['{$column['name']}']:''}}\"></input>";
				}
				break;
			default:
				if ($is_search && $column['queryType'] == "range") {
					$input = "<input type=\"text\" style='width:100px;' maxlength=\"$len\" name=\"{$column['name']}_start\" id=\"{$column['name']}_start\" value=\"{{isset(\$detail['{$column['name']}_start'])?\$detail['{$column['name']}_start']:''}}\"></input>";
					$input .= " - <input type=\"text\" style='width:100px;' maxlength=\"$len\" name=\"{$column['name']}_end\" id=\"{$column['name']}_end\" value=\"{{isset(\$detail['{$column['name']}_end'])?\$detail['{$column['name']}_end']:''}}\"></input>";
				}
				else {
					$input = "<input type=\"text\" maxlength=\"$len\" name=\"{$column['name']}\" id=\"{$column['name']}\" value=\"{{isset(\$detail['{$column['name']}'])?\$detail['{$column['name']}']:''}}\"></input>";
				}




				break;
		}

		if (!empty($input)) {
			list($display, $desc) = explode(":",$column['displayName'], 2);

				if (empty($desc))
					$li = "<li><label class=\"display_name\">{$display}</label>{$input}</li>";
				else
					$li = "<li><label class=\"display_name\"><a href='javascript:' title='{$desc}' >{$display}</a>:</label>{$input}</li>";
		}
		return $li;
	}

	private function _getRefer($column_name) {
		foreach($this->_tableNode->keys->key as $key) {
			if ($key['type'] != "fk") {
				continue;
			}

			$column = $key->column;
			if (trim($column_name) == trim($column['name'])) {
				return $column['referencedTable'];
			}
		}
	}
}

class Layout {
	public static function html($content, $tableNode = null) {
		$navi_name = $tableNode['comment'];
		$navi_group = $tableNode['group'];
		$table_name = $tableNode['name'];
		$html = <<<EOF
		@extends('autophp.common.index')
		@section('title')
		{$navi_group}
		@endsection
         @section('content')
         <div class="page-bar">
				<ol class="breadcrumb" style="margin: 0px">
					<li><i class="fa fa-home"></i><a href="">{$navi_group}</a></li>
					<li class="active">{$navi_name}</li>
					<ul style="float:right;">
					<li style="float:left;"><a href="/autophp/{$table_name}" class="listshowpng"></a></li>
					<li style="float:left;"><a href="/autophp/{$table_name}/create" class="createshow"></a></li>
					</ul>
				</ol>
		</div>
		<div id="main" class="easyui-panel" title="当前位置：{$navi_group} >> {$navi_name}">
			<div class="easyui-panel" border="false" style="padding:1px">
				$content
			</div>
		</div>
@endsection
EOF;
		return $html;
	}

	public static function head() {
		$head = <<<EOF
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>@yield('title','')</title>
		<link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
        <link rel="stylesheet" href="/autophp/css/global.css" type="text/css" />
        <link rel="stylesheet" href="/autophp/css/style.css" type="text/css" />
		<script src="/autophp/js/My97DatePicker/WdatePicker.js" type="text/javascript" language="javascript"></script>
		<script src="/autophp/js/common.js" type="text/javascript" language="javascript"></script>
		<script src="/autophp/js/jquery.js" type="text/javascript" language="javascript"></script>


EOF;

		return $head;
	}
}

class ViewFile {
	private $_path;
	public function __construct($view_path) {
		$this->_path = $view_path;
	}

	public function code($tableNode) {
		$view_types = array("_list", "_add", "_edit", "_detail", "_tree");//"_index",

		$this->_save(Layout::head(), $this->_path . "/head.inc");
		$content = new Content($tableNode);
		foreach ($view_types as $type) {
			$code = Layout::html($content->$type(), $tableNode);
			$file_name = $this->_path . "/{$tableNode['name']}{$type}.blade.php";
			$this->_save($code, $file_name);
		}
	}



	private function _save($file_content, $file_name) {
		/*
		if (empty($this->_dst_path)) {
			die("DST_PATH must setting");
		}

		$path = $this->_dst_path;
		if (!file_exists($path)) {
			die("DST_PATH is not exist! \n");
		}*/

		$file_path = $path . $file_name;
		$dir = dirname($file_path);
			if (!file_exists($dir)) {
				echo "Create dir: $dir";
				shell_exec("mkdir -p $dir");
			}
		//echo $file_path;
		if (!$fh = fopen($file_path, "w")) {
			die("ERROR: Open file '$file_path' failed \n");
		}

		if(fwrite($fh, $file_content) === FALSE){
			die("ERROR: Write file '$file_path' failed \n");
		}

		fclose($fh);
	}
}
