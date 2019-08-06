<div class="card mb-3 border-info">
    <div class="card-header bg-transparent border-info">
        <h5 class="text-muted text-center">公告</h5>
    </div>
    <div class="card-body">
        <article class="text-muted">
            这是我的个人博客

        </article>
    </div>
</div>

<div class="card border-info mb-3">



    <?php if(count($archives)): ?>
        <ul class="list-group list-group-flush">
            <?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item <?php if(request()->has('year') && request()->year == $archive->year): ?> bg-light <?php endif; ?>">
                    <a href=""
                        class="text-center text-info font-weight-bold">
                        <center><?php echo e($archive->year); ?> ( <?php echo e($archive->total); ?> )</center>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
