<div class="card mb-5">
    <div class="card-header bg-white">
        <a href="<?php echo e(route('users.follows', $user->id)); ?>" class="btn btn-info btn-sm pull-right">查看全部</a>
        <h4 class="text-muted">关注的文章</h4>
    </div>
    <?php if(count($user->follows)): ?>
        <ul class="list-group">
            <?php $__currentLoopData = $user->follows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item ">
                    <span class="pull-left">
                        <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="text-info" title="阅读文章"><?php echo e($post->title); ?></a>
                    </span>
                    <span class="pull-right">
                        <a href="<?php echo e(route('skills.show', $post->skill->id)); ?>" class="text-muted" title="所属技能"><?php echo e($post->skill->name); ?></a>
                        <span class="text-muted" title="发表时间">
                            &#x2022; <?php echo e($post->created_at->diffForHumans()); ?>

                        </span>
                    </span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <div class="card-body">
            <p class="text-muted">还没有关注任何文章，快去阅读吧 ~ </p>
        </div>
    <?php endif; ?>
</div>