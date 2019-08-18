<div class="card my-3">
    <div class="card-header bg-white">
        <h5 class="card-title text-muted">评论</h5>
    </div>
    <div class="card-body">
        <?php if(!empty($post) && count($post->comments)): ?>
            <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card my-3">
                    <div class="card-header">
                        <img class="rounded" src="" alt="" height="22">
                        <a href="" class="text-info font-weight-light font-italic mx-2">
                                <?php echo e($comment->name); ?>

                        </a>
                        <small class="text-info font-weight-light pull-right">
                            <i class="fa fa-clock-o"></i>
                            <?php echo e($comment->time); ?>


                        </small>
                    </div>
                    <div class="card-body text-muted">
                        <?php echo e(($comment->content)); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="text-muted">还没有人评论 ～</p>
        <?php endif; ?>
    </div>
</div>
