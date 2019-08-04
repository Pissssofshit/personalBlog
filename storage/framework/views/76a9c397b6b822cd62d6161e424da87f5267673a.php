<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a id="logo" class="navbar-brand mr-0 mr-md-2" href="<?php echo e(url('/')); ?>">
            <img src="https://image.broqiang.com//broqiang/logo320.png" class="img-responsive" width="36px" height="36px" alt="logo">
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">













            </ul>
            <!-- Right Side Of Navbar -->
            <?php echo $__env->make('layouts._header_right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</nav>
