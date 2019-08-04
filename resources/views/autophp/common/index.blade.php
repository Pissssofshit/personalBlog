<!DOCTYPE html>
<!--[if IE 8]> <html lang_bakup="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang_bakup="en" class="ie9"> <![endif]-->
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
            $(".showopenicon").css("display","inline-block");
        }
        function showanimate(searchflow,searchflow,visible,height){
            $("."+searchflow).animate(
                { height:height},
                { duration: 1000,
                    queue: false,
                    easing: 'easeOutExpo',

                    step: function() {
                        var nowheit = $(".searchflow").prop("clientHeight");
//                        var nowheitadd = (nowheit+16)+"px";
//                        $("."+searchflow).css("height",nowheitadd);
//                        $("."+searchflow).css("overflow",visible);
                    },

                    complete: function() {
                        $("."+searchflow).css("overflow",visible);
                    }
                }
            );
        }
        $(".search_canvas").on("click",".showopenicon",function(){
            var heihtu = $(".searchflow").prop("scrollHeight");
          // $(".searchflow").css("overflow","visible");
           $(this).removeClass("showopenicon").addClass("showcloseicon");
           $(this).text("收起");
            showanimate("searchflow","searchflow","visible",heihtu+5);
        })
//
        $(".search_canvas").on("click",".showcloseicon",function(){
          //  $(".searchflow").css("overflow","hidden");
            $(this).removeClass("showcloseicon").addClass("showopenicon");
            $(this).text("展开");
            showanimate("searchflow","searchflow","hidden",32);
        })
    </script>
@endverbatim
</body>
</html>
