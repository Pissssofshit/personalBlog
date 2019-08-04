<?php if(count($posts)>0): ?>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card my-3">
            <div class="card-body">
                <h3 class="card-title">
                    <a class="text-muted" href=""><?php echo e($post->title); ?></a>
                </h3>
                <h5 class="card-subtitle my-4">
                    <a href="" class="font-italic text-info">

                    </a>
                    <small class="font-italic text-muted mx-3" title="发布时间">
                        <i class="fa fa-clock-o"></i>

                    </small>
                </h5>
                <hr>
                <p class="card-text font-weight-light "><?php echo $post->excerpt; ?></p>
                <a href="" class="btn btn-success pull-right font-italic">
                    阅读 &#x2022; &#x2022; &#x2022;
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">没有任何数据</h5>
        </div>
    </div>
<?php endif; ?>
