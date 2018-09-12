function chgRowColor(obj) {
	obj.bgColor = obj.bgColor =="#ddddff" ? "" : "#ddddff";	
}

var game_server = new Array();
var before_form_data = after_form_data = "";
var thisURL = document.URL;
$(document).ready(function() {
	var count = $("#server_id option").length;
	if(count > 0) {
		var m = 0;
		for(var i=0;i<count;i++) {           
			var name_text = $("#server_id").get(0).options[i].text;
			if(name_text != "请选择") {
				var server_id = $("#server_id").get(0).options[i].value;
				var name_text_arr = name_text.split(":");
				game_server[m] = new Array(server_id,name_text_arr[1],name_text_arr[0]);
				m++;
			}
		}
		var game_id = $("#game_id")?$("#game_id").val():"";
		var server_id = $("#server_id")?$("#server_id").val():"";
		changeselect(game_id,server_id);
	}

	$('#game_id').change(function(){
		changeselect($("#game_id").val());
	})
	
	if(thisURL.indexOf("?") > 0) {
		var tempURL = thisURL.substring(0,thisURL.indexOf("?"));
		var url = thisURL+"&";
	} else {
		tempURL = thisURL;
		var url = thisURL+"?";
	}
	var tmpUPage = tempURL.split( "/" );
	var action = tmpUPage[tmpUPage.length-2];
	var type = tmpUPage[tmpUPage.length-1];

	if(type == "add" || type == "edit") {
		before_form_data = getFormQueryString();
		/*$("#btn_submit").click(function(e){
			after_form_data = getFormQueryString();
			url += "before_data="+before_form_data+"&after_data="+after_form_data;
			$("form").attr("action", url);
		});*/

		$("form").append("<input type='hidden' name='before_data' id='before_data' value='"+before_form_data+"'>");
		$("#btn_submit").click(function(e){
			after_form_data = getFormQueryString();
			if(document.getElementById("after_data")) {
				document.getElementById("after_data").value = after_form_data;
				return false;
			}
			//$("form").append("<input type='hidden' name='after_data' id='after_data' value='"+after_form_data+"'>");
		});
	}

})

function changeselect(game_id, server_id) {
	if(!document.getElementById('server_id')) {
		return;
	}
	document.getElementById('server_id').length = 0;
	document.getElementById('server_id').options[0] = new Option('请选择','');
	for(i=0; i<game_server.length; i++) {
		if(game_server[i][1] == game_id) {
			var selected = 0;
			if(game_server[i][0] == server_id) {
				selected = server_id;
			}
			document.getElementById('server_id').options[document.getElementById('server_id').length] = new Option(game_server[i][2], game_server[i][0]);
		}
	}
	if(server_id) {
		document.getElementById('server_id').value = server_id;
	}
}

function getFormQueryString() {
	var frmID = document.forms[0];
	if(!frmID) {
		return false;
	}
	var item;
	var itemValue;
	var query_array = new Array();
	var m = 0;
	for(var i=0;i<frmID.length;i++) {
		item = frmID[i];
		if(item.name != '' && item.name != "before_data" && item.name != "after_data") {
			if(item.type == 'select-one') {
				//itemValue = item.options[item.selectedIndex].value?item.options[item.selectedIndex].value:'';
				itemValue = item.value?item.value:'';
			} else if(item.type=='checkbox' || item.type=='radio') {
				if(item.checked == false) {
					continue;
				}
				itemValue = item.value;
			} else if(item.type == 'button' || item.type == 'submit' || item.type == 'reset' || item.type == 'image') {
				continue;
			} else {
				itemValue = item.value;
			}
			//itemValue = escape(itemValue);
			//queryString += and + item.name + ':' + itemValue;
			query_array[m] = new Array(item.name,itemValue);
			m++;
			//and="|";
		}
	}
	var query_json = JSON.stringify(query_array);
	return query_json;
}

var ad_tree = {
	'option_html' : '<option> </option>',
	'category_id' : 0,
	'tree_num':0,
	
	'create' : function(tag,json_data){
		this.option_html += this._recursion(json_data,this.tree_num);
		$(tag).html(this.option_html);
	},
	
	'edit' : function(tag,json_data,category_id){
		this.category_id = category_id;
		this.option_html += this._recursion(json_data,this.tree_num);
		$(tag).html(this.option_html);
	},
	
	'_recursion' : function(json_data,tree_num){
		var data = eval(json_data);
		var nbsp = "";
		var option='';
		if(data.length < 1) return '';
		for(var i=0;i<tree_num;i++){nbsp += "&nbsp;&nbsp;&nbsp;";}
		for(var i=0;i<data.length;i++){
			var selected = "";
			if(this.category_id == data[i].meterial_category_id){
				selected = "selected";
			}
			tree_num ++;
			option += "<option value="+data[i].meterial_category_id+" "+selected+">"+nbsp+data[i].meterial_category_name+"&nbsp;</option>";
			if(data[i].children.length > 0){
				var re = this._recursion(JSON.stringify(data[i].children),tree_num);
				option += re;
			}
		}
		return option;
	},
	
	'getmeterial' : function(tag,meterial_category_id){
		$.post("/admin/advertise/getmeterial",{meterial_category_id:meterial_category_id},function(json){
			var data = eval(json);
			var option_html = '';
			for(var i=0; i<data.length;i++){
				option_html += "<option value="+data[i].meterial_id+">"+data[i].meteria_name+"</option>";
			}
			$(tag).html(option_html);
		})
	}
}

var ad_server = {
	'server_list' : '',
	'now_server_id' : 0,
	
	'getserver' : function(tag,gameid){
		var option_html = "<option>请选择</option>";
		for(var i=0;i<this.server_list.length;i++){
			var server_str = eval(this.server_list[i]);
			var server_con = server_str.split(':');
			if(server_con[1] == gameid){
				if(this.now_server_id == server_con[2]){
					option_html += "<option value="+server_con[2]+" selected>"+server_con[0]+"</option>"
				}else{
					option_html += "<option value="+server_con[2]+">"+server_con[0]+"</option>"
				}
			}
		}
		$(tag).html(option_html);
	}
	
}

var ad_channel = {
	'default_html' : "【投放渠道】由【投开始时间】和【投放结束时间】确定。如为空或没有出现您需要的渠道，可能存在以下情况<br>1. 渠道未创建; 您需要<a href='/admin/channel'>【渠道管理】</a>中创建您需要的渠道。<br>2. 渠道的计费时间过期; 您需要<a href='/admin/channel'>【渠道管理】</a>中重新设置计费时间，可能需要修改费率。<br>3. 渠道在选中的时间内已被投放占用。<br>4. 【投开始时间】必须大于当前时间。",
	'pricelist' : '',
	'ratename' : '',
	'advertise_id' : 0,
	'ucodes' : '',
	'subucodes':"",
	
	'getucodes' : function(){
		var time_start = $("#time_start").val();
		var time_end = $("#time_end").val();
		var arraychecked = new Array();
		for(var i=0; i<this.ucodes.length; i++){
			arraychecked[this.ucodes[i]] = 'checked';
		}
		if(time_start && time_end){
			$.post("/admin/advertise/getucodes",{time_start:time_start,time_end:time_end,advertise_id:ad_channel.advertise_id},function(json){
				var ucode_html = '';
				if(json != 'null' && json!=''){
					var data = eval("("+json+")");
					var channel_ids = data.toString().split(",");
					for(var i=0; i<channel_ids.length; i++){
						var channels = channel_ids[i].split("|");
						ucode_html += '<label><input type="checkbox" value="'+channels[0]+'" '+arraychecked[channels[0]]+' name="channel_id[]">'+channels[0]+'['+channels[1]+']</label>';
					}
				}else{
					ucode_html = ad_channel.default_html;
				}
				$(".kk_group_checkbox").html(ucode_html);
				$(":checkbox").each(function(){
					ad_channel.setprice(this);
				})
				$(":checkbox").bind("click",function(){
				  	ad_channel.setprice(this);
				});			
			})
		}
	},
	
	'setprice' : function(obj){
		if($(obj).attr("checked")){
	  		var channel_id = obj.value;
	  		var key_channel_id = channel_id * 1;
	  		if(this.ratename[this.pricelist[key_channel_id].channel_rate_type_id] != 'CPS'){
	  			var disabled = 'disabled';
	  		}else{
	  			var disabled = "";
	  		}
	  		$(obj).parent().append("<div>"+this.ratename[this.pricelist[key_channel_id].channel_rate_type_id]+"：<input class='bone' type='text' size=4 name='price_"+channel_id+"' "+disabled+" value='"+this.pricelist[key_channel_id].price+"' onclick='return false;'></div>");
	  	}else{
	  		$(obj).parent().find("div").remove();
	  	}
	},
	
	'subucode' : function(){
		var arraysub = new Array();
		if(this.subucodes){
			var subucodes = eval(this.subucodes);
			for(var i=0; i<subucodes.length; i++){
				arraysub[subucodes[i].channel_id] = subucodes[i].subucode;
			}
		}
		$(":[name='channel_id[]']").each(function(){
			var subucode_val = '';
			if(arraysub[$(this).val()]){
				subucode_val = arraysub[$(this).val()];
			}
			if($(this).attr("checked")){
				var disabled = "";
			}else{
				var disabled = "disabled";
			}
			$(this).parent().append("<div><span class='t_t'></span>添加subucode<br><textarea "+disabled+" name='sub_"+$(this).val()+"' style='width:150px;height:100px' onclick='return false;'>"+subucode_val+"</textarea></div>");
		})
		$(":[name='channel_id[]']").bind('click',function(){
			var subobj = $(this).parent().find(":[name='sub_"+$(this).val()+"']");
			if($(this).attr("checked")){
				subobj.attr("disabled",'');
			}else{
				subobj.attr("disabled","disabled");
			}
		})
	}
}

function ad_url(){
	var is_push = $(":input[name='is_push']").attr("checked");
	var channel_type_id = $("#channel_type_id").val();
	var ucode = $("#partner_id").val() + channel_type_id;
	if(is_push == true){
		var show_url = "<a href='http://pop.ledu.com/show?ucode="+ucode+"&subucode=' target='_blank'>http://pop.ledu.com/show?ucode="+ucode+"&subucode=</a>[合同指定]";
		var url = "http://pop.ledu.com/show?ucode="+ucode+"&subucode=[合同指定]";
	}else{
		var show_url = "<a href='http://pop.ledu.com/show?ucode="+ucode+"&subucode=' target='_blank'>http://pop.ledu.com/show?ucode="+ucode+"&subucode=</a>[合同指定]&uid=[合作商用户ID]&adid=[合作商广告ID]";
		var url = "http://pop.ledu.com/show?ucode="+ucode+"&subucode=[合同指定]&uid=[合作商用户ID]&adid=[合作商广告ID]";
	}
	var show_url_3 = show_url.replace(/ledu/g,"joypush");
	var show_url_3 = show_url_3.replace(/com/g,"cn");
	var show_url_2 = show_url.replace(/ledu/g,"18lehu");
	$("#ad_url_show_2").html(show_url_2);
	$("#ad_url").val(url);
	$("#ad_url_show").html(show_url);
	$("#ad_url_show_3").html(show_url_3);
}

function AllChecked(id,name){
	var style = $("#"+id).attr("checked") == true?true:false;
	$(":checkbox[name='"+name+"']").each(function(){
		$(this).attr("checked",style);
	});
}

var channel_server = new Array();
$(document).ready(function() {
	var count = $("#channel_id option").length;
	if(count > 0) {
		var m = 0;
		for(var i=0;i<count;i++) {           
			var name_text = $("#channel_id").get(0).options[i].text;
			if(name_text != "请选择") {
				var channel_id = $("#channel_id").get(0).options[i].value;
				var name_text_arr = name_text.split(":");
				channel_server[m] = new Array(channel_id,name_text_arr[1],name_text_arr[0]);
				m++;
			}
		}
		var channel_type_id = $("#channel_type_id")?$("#channel_type_id").val():"";
		var channel_id = $("#channel_id")?$("#channel_id").val():"";
		changeselectchannel(channel_type_id,channel_id);
	}

	$('#channel_type_id').change(function(){
		changeselectchannel($("#channel_type_id").val());
	})
})
function changeselectchannel(channel_type_id, channel_id) {
	if(!document.getElementById('channel_id')) {
		return;
	}
	document.getElementById('channel_id').length = 0;
	document.getElementById('channel_id').options[0] = new Option('请选择','');
	for(i=0; i<channel_server.length; i++) {
		if((!in_array(channel_type_id,channel_server[i][1]) && channel_type_id) || channel_server[i][1] == channel_id) {
			var selected = 0;
			if(channel_server[i][0] == channel_id) {
				selected = channel_id;
			}
			document.getElementById('channel_id').options[document.getElementById('channel_id').length] = new Option(channel_server[i][2], channel_server[i][0]);
		}
	}
	if(channel_id)
		$("#channel_id").val(channel_id);
}

function in_array(str,id){
	if(str == '')
		return true;
	if(id == 0)
		return false;
	var arr_str = str.split(",");
	for(var i=0; i<arr_str.length; i++){
		if(arr_str[i] == id){
			return false;
		}
	}
	return true;
}
function out_array(str,id){
	var newstr = '';
	var arr_str = str.split(",");
	for(var i=0; i<arr_str.length; i++){
		if(arr_str[i] != id && arr_str[i]!=''){
			newstr +=  arr_str[i] + ',';
		}
	}
	return newstr;
}
	
function date_format(date_val){
	var date_arr = date_val.split('-');
	var year = date_arr[0];
	var month = date_arr[1];
	var first = new Date(year,month,1);
	var last = (new Date(first.getTime()-1000*60*60*24)).getDate();
	var date_first = year + '-' + month + '-' + '01';
	var date_last = year + '-' + month + '-' + last;
	
	var myDate = new Date();
	var myYear = myDate.getFullYear();
	var myMonth = myDate.getMonth() + 1;
	var myDay = myDate.getDate();  
	if(String(myMonth).length < 2){
		myMonth = '0' + myMonth;
	}
	if(date_val == myYear + '-' + myMonth){
		date_first = myYear + '-' + myMonth + '-' + '01';
		date_last = myYear + '-' + myMonth + '-' + myDay;
	}
	
	$("#time_start").val(date_first);
	$("#time_end").val(date_last);
}

function set_positoin(obj){
	var position = $("#channel_type_id").position();
	$("#server_select").css("position","absolute");
	$("#server_select").css("top",position.top + 20 + "px");
	$("#server_select").css("left",position.left + "px");
}

$(document).ready(function(){
	$("body table tr").mousemove(function(){
        $(this).addClass("tableListLine");
    });
     $("body table tr").mouseout(function(){
        $(this).removeClass("tableListLine");
    });
})