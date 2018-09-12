

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>


<![endif]-->
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo e($project['common']['cdn']); ?>/assets/global/plugins/respond.min.js"></script>
<script>
    $(".backend_menu_list").each(function(){
        var lis = $(this).find("ul").find("li");
        if(lis.length<1){
            $(this).remove();
        }
    })
    //分页
    $(".ajaxpage_").live('click',function(){
        if(!$(this).parent('li').hasClass('disabled')){
            var page = $(this).attr("p");
            var request_function = $("#request_function").val();
            if($("#change_page")){
                var perpage = $("#change_page").val();
                window[request_function](page,perpage);
            }else{
                window[request_function](page);
            }
        }
    });
    $("#change_page").live('change',function(){
        var page = 1;
        var request_function = $("#request_function").val();
        var perpage = $(this).val();
        window[request_function](page,perpage);
    });
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    //    ComponentsDropdowns.init();
    $("#btn_export").click(function(){
        var form = $(this).parents("form");
        var url = form.attr("exportaction");
        var utrpath = form.serialize();
        download_file(url+"?"+utrpath);
    })

    //导出数据
    function download_file(url) {
        if (typeof (download_file.iframe) == "undefined") {
            var iframe = document.createElement("iframe");
            download_file.iframe = iframe;
            document.body.appendChild(download_file.iframe);
        }
        //alert(download_file.iframe);
        download_file.iframe.src = url;
        download_file.iframe.style.display = "none";
    }
    function joinstr(str) {
        var lenth = str.length;
        var strend = "";
        $.each(str, function (key, value) {
            if (value !== "") {
                strend += strend ? "&" + key + "=" + value : key + "=" + value;
            }
        });
        return strend;
    }


    function mustreflush(){
        var nowurl = window.location.href;
        var serachna =  window.location.search;
        var trueurl = nowurl.replace(serachna,"")
        var pram = Math.random();
        window.location.href = trueurl+"?"+pram;
    }
    function sidebarisshow(){
        var alltitleshow = $(".page-sidebar").find(".backend_menu_list");
        alltitleshow.each(function(){
            var downli = $(this).find(".sub-menu").find("li");
            var len = downli.length;
            if(len>0){
                $(this).css("display","block");
            }
        })
    }
    $(document).ready(function() {
        sidebarisshow();
    })
</script>
