<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title',isset($post) ? $post['title'] : '博客'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mb-3 text-muted">
                <div class="card-body">
                    <h3 class="card-title"><?php echo e($post['title']); ?></h3>
                    <h5 class="card-subtitle my-4">
                        <a href="" class=" font-italic text-info">

                        </a>
                        <small class="font-italic text-muted mx-3" title="发布时间：<?php echo e($post['time']); ?>">
                            <i class="fa fa-clock-o"></i>

                        </small>
                        <small class="pull-right">
                            访问：<span class="badge badge-light text-muted mr-3"></span>
                            评论：<span class="badge badge-light text-muted"></span>
                            关注：<span class="badge badge-light text-muted"></span>
                        </small>
                    </h5>
                    <hr>
                    <article class="markdown-body">
                        <?php echo $post->content; ?>

                    </article>
                </div>
            </div>

            <?php echo $__env->make('posts._comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('posts._post_comment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-3">
            <?php echo $__env->make('posts._sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>