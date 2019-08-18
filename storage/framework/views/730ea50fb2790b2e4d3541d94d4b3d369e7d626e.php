<div class="card mb-5">
    <div class="card-header bg-white">
        <center>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-success disable">登录后可以关注</a>
            <?php else: ?>
                <button class="btn btn-outline-success" onclick="event.preventDefault();document.getElementById('post-follow-form').submit();">
                    @whether_follow($post->follows)
                        取消关注
                        <form action="<?php echo e(route('posts.unfollow', $post->id)); ?>" id="post-follow-form" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php else: ?>
                        关注
                        <form action="<?php echo e(route('posts.follow', $post->id)); ?>" id="post-follow-form" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    @endwhether_follow
                </button>
            <?php endif; ?>
        </center>
    </div>
    <?php if(count($post->follows)): ?>
        <div class="card-body">
            <?php $__currentLoopData = $post->follows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge badge-pill badge-light">
                    <a href="<?php echo e(route('users.show',$user->id)); ?>">
                    <img src="<?php echo e($user->avatar ?: 'https://image.broqiang.com//broqiang/empty-white.png'); ?>" width="33px" height="33px">
                    </a>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
    
    <?php endif; ?>
</div>