<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    <?php if(auth()->guard()->guest()): ?>
    <li><a class="nav-link" href="">登录</a></li>
    <li><a class="nav-link" href="">注册</a></li>
    <?php else: ?>

    <li class="mr-3">
        <a class="nav-link" href="">
            <span class="badge badge-light <?php echo e(Auth::user()->notification_count > 0 ? 'text-danger' : 'text-muted'); ?>" title="消息通知提醒">
                <i class="fa fa-bell"></i>
                <?php echo e(Auth::user()->notification_count); ?>

            </span>
        </a>
    </li>

    <li class="nav-item dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
            <span class="mr-1">

            </span>
            <span>

            </span>
            <span class="caret">
            </span>
        </a>
        <div aria-labelledby="navbarDropdown" class="dropdown-menu">

                <a class="dropdown-item" href="<?php echo e(url('admin/index')); ?>">
                    <i class="fa fa-cog fa-fw mr-1"></i>
                    后台管理
                </a>


            <a class="dropdown-item" href="<?php echo e(url('user/show/'.Auth::id())); ?>">
                <i class="fa fa-user fa-fw mr-1"></i>
                个人中心
            </a>
             <a class="dropdown-item" href="">
                <i class="fa fa-edit fa-fw mr-1"></i>
                编辑资料
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-fw mr-1"></i>
                退出
            </a>
            <form action="" id="logout-form" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </li>
    <?php endif; ?>
</ul>
