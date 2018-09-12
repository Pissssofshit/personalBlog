<style>
    /* LOADing  样式  */
    .loading_over {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 100%;
        background-color: #f5f5f5;
        opacity:0.5;
        z-index: 10000;
    }

    .loading_layout {
        display: none;
        position: fixed;
        top: 40%;
        left: 40%;
        width: 20%;
        height: 20%;
        z-index: 10001;
        text-align:center;
    }

</style>
<div id="errorTipModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                <h4 class="modal-title" id="errorTipModal_title">提示</h4>

            </div>

            <div class="modal-body">

                <h4 id="errorTipModal_body">内容</h4>
                <input id="url" style="display: none" />
            </div>

            <div class="modal-footer">

                <button data-dismiss="modal" id="errorTipModal_btn" class="btn green">关闭</button>
                <button data-dismiss="modal" id="skip_url_btn"  onclick="skipUrl()" style="display: none" class="btn green">关闭</button>

            </div>

        </div>

    </div>

</div>
<div id="dialogconfirm" class="moadl" title="系统提示">
    <p class="msgcontent" style="text-align: center;">
    </p>
</div>

<div id="show_content_Modal" aria-hidden="true" class="modal fade in" role="basic" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title" id="show_content_Modal_title">信息</h4>
             </div>
             <div class="modal-body">
                 <div class="row-fluid">
                     <div class="row">
                         <h4 class="col-md-12" id="show_content_Modal_content">
                             
                         </h4>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button id='cancel_add_role' class="btn green-haze" type="button" data-dismiss="modal">取消</button>
                 </div>
             </div>
         </div>
     </div>
 </div>

<div class="loading_over"></div>
{{--<div class="loading_layout"><img src="/images/loading.gif" alt="" /></div>--}}
@verbatim
<script>
	function pageLoading(open){
		if(open){
			$(".loading_over").css('display','block'); 
			$(".loading_layout").css('display','block'); 
		}else{
			$(".loading_over").css('display','none'); 
			$(".loading_layout").css('display','none'); 
		}
	}

    function alertErrorTip(content,title){
        if($.trim(title)=="") title = '提示';
        if($.trim(content)=="") content = '';
        document.getElementById("skip_url_btn").style.display = 'none';
        document.getElementById("errorTipModal_btn").style.display = '';

        $("#errorTipModal #errorTipModal_title").html(title);
        $("#errorTipModal #errorTipModal_body").html(content);
        $("#errorTipModal").modal("show");
    }

    function skipTip(content,title,url){
        if($.trim(title)=="") title = '提示';
        if($.trim(content)=="") content = '';
        document.getElementById("skip_url_btn").style.display = '';
        document.getElementById("errorTipModal_btn").style.display = 'none';

        $("#errorTipModal #errorTipModal_title").html(title);
        $("#errorTipModal #errorTipModal_body").html(content);

        $("#errorTipModal #url").val(url);
        $("#errorTipModal").modal("show");
    }

    function skipUrl() {
        var skip_url = $("#errorTipModal #url").val();
        window.location.href=skip_url;
    }

    $("body").on("click",".showMoreContent",function(){
    	
    	var content = $(this).attr("content");
    	$("#show_content_Modal .col-md-12").html(content);
    	$("#show_content_Modal").modal("show");
    });
</script>
@endverbatim