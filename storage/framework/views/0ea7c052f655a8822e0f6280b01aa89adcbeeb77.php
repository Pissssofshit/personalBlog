<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a id="logo" class="navbar-brand mr-0 mr-md-2 text-info" href="">
            后台
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="mx-2 ">
                    <a class="nav-link" href="<?php echo e(url('/admin/articlemanager')); ?>">文章管理</a>
                </li>
                <li class="mx-2 ">
                    <a class="nav-link" href="<?php echo e(url('/admin/usermanager')); ?>">人员管理</a>
                </li>
                <li class="mx-2 ">
                    <a class="nav-link" href="<?php echo e(url('/admins/create_article')); ?>">发布博文</a>
                </li>
                <li class="mx-2 ">
                    <a class="nav-link" href="<?php echo e(url('/admin/commentmanager')); ?>">留言管理</a>
                </li>














































            </ul>
            <!-- Right Side Of Navbar -->
            <?php echo $__env->make('layouts._header_right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
</nav>
