<?php $__env->startSection('title',isset($skills) ? $skills->name : '博客列表'); ?>


<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-default text-muted">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs navbar-dark">
                        <li class="nav-item">

                        </li>
                        <li class="nav-item">

                        </li>
                    </ul>
                    <div class="input-group my-3">
                        <input type="text" id="posts_search" class="form-control" placeholder="输入要搜索的内容" >
                        <div class="input-group-append">
                            <div class="input-group-text text-info bg-white">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('posts._post_list',$posts, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="card-footer bg-white">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php echo $__env->make('posts._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    <?php echo $__env->make('posts._search_posts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>