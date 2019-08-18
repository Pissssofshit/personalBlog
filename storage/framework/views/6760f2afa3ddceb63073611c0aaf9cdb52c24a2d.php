<?php $__env->startSection('title','首页'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <?php if(isset($list) && count($list)): ?>
            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 my-3">
                    <div class="card border-info text-muted">
                        <div class="card-header bg-info text-light">
                            <?php echo e($item['name']); ?>统计
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                文章数量：
                                <a href="" class="text-info" target="_blank"></a>
                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">
                                评论：
                                <a href="" class="text-info" target="_blank"></a>
                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">

                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">

                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admins.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>