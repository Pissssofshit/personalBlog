<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title><?php echo $__env->yieldContent('title',""); ?></title>
    <?php echo $__env->make('autophp.common.bootstrapheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('autophp.common.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body class="easyui-layout page-header-fixed page-quick-sidebar-over-content page-quick-sidebar-open page-sidebar-closed-hide-logo">
<div class="page-header navbar">
    <?php echo $__env->make('autophp.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="page-container" style="margin-top:0;overflow:scroll;">
    <?php echo $__env->make('autophp.common.bootstrapleftbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="page-content-wrapper"   >
        <div class="page-content" >
            <div class="row">
                <div class="col-md-12">
                    <?php echo $__env->yieldContent('content',"welcome!!"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('autophp.common.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('autophp.common.public_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script>
        jQuery(document).ready(function() {
            //ComponentsDropdowns.init();
            initSideBar();
        });
        function initSideBar(){
            $(".backend_menu_list").removeClass('active').removeClass('open');
            $("a.backend_menu.active").parent().addClass('active').addClass('open');
            $("a.backend_menu.active").parents(".backend_menu_list").addClass('active').addClass('open');
        }
    </script>

</body>
</html>