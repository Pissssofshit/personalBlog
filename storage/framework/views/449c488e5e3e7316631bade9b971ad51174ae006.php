<div class="card my-3">
    <div class="card-body">
        <form action="<?php echo e(url('article/'.$post->id.'/postComment')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <textarea class="form-control" name="content" rows="5" required
                placeholder="<?php echo e(Auth::check() ? '发表评论' : '请先登录再发表评论'); ?>"></textarea>
            </div>

            <?php if(auth()->guard()->guest()): ?>
                <div class="form-group">
                    <a class="btn btn-warning pull-right" href="<?php echo e(route('login')); ?>">登录</a>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right">提交</button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
