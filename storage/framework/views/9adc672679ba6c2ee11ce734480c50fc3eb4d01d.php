<div class="card mb-2">
    <div align="center">
        <img class="rounded img-thumbnail my-5 mx-auto" src="<?php echo e($user->avatar ?: 'https://image.broqiang.com//broqiang/empty-white.png'); ?>" alt="avatar">
    </div>

    <div class="card-body">
        <div class="dropdown-divider mb-5"></div>
        <h4 class="card-title">
            <i class="fa fa-user text-success"></i>
            <?php echo e($user->name); ?> <small class="text-secondary"><?php echo e($user->email); ?></small>
        </h4>
        <h6 class="card-title">
            <span><i class="fa fa-clock-o"></i> 注册于:</span>
            <span><?php echo e($user->created_at); ?></span>
        </h6>
        <h6 class="card-title">
            <span><i class="fa fa-clock-o"></i> 活跃:</span>
            <span><?php echo e($user->updated_at); ?></span>
        </h6>

        <div class="dropdown-divider  my-5"></div>
        <p class="card-text"><?php echo e($user->introduction); ?></p>

        <div class="my-5"></div>

        <?php if($user->github): ?>
            <a href="<?php echo e($user->github); ?>" class="btn btn-secondary mb-3" target="_blank">
                <i class="fa fa-github"></i> Github
            </a>
        <?php endif; ?>
        <?php if($user->homepage): ?>
            <a href="<?php echo e($user->homepage); ?>" class="btn btn-secondary mb-3"  target="_blank">
                <i class="fa fa-paper-plane"></i> 个人主页
            </a>
        <?php endif; ?>
        <?php if($user->qq): ?>
            <a href="<?php echo e($user->qq); ?>" class="btn btn-secondary mb-3"  target="_blank">
                <i class="fa fa-weibo"></i> qq
            </a>
        <?php endif; ?>
    </div>
</div>
