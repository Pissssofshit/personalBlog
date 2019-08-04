<?php $__env->startSection('app_content'); ?>
    <header>
        <?php echo $__env->make('partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('partials.sidenav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>

    <main class="grey lighten-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('partials.fab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>