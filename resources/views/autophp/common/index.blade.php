<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>@yield('title',"")</title>
    @include('autophp.common.bootstrapheader')
    @include('autophp.common.head')
</head>
<body class="easyui-layout page-header-fixed page-quick-sidebar-over-content page-quick-sidebar-open page-sidebar-closed-hide-logo">
<div class="page-header navbar">
    @include('autophp.common.header')
</div>
<div class="page-container" style="margin-top:0;">
    @include('autophp.common.bootstrapleftbar')
    <div class="page-content-wrapper" >
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    @yield('content',"welcome!!")
                </div>
            </div>
        </div>
    </div>
</div>
@include('autophp.common.script')
@include('autophp.common.public_modal')
@verbatim
    <script>
        if($(".searchflow").prop("scrollHeight")-$(".searchflow").prop("clientHeight")>20){
            $(".searchflow").addClass("showopenicon");
        }
        $(".showopenicon").click(function(){
            $(this).css("overflow","visible");
            $(this).removeClass("showopenicon");
        })
    </script>
@endverbatim
</body>
</html>