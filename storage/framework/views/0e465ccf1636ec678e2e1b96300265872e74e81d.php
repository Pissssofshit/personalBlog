<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bro Qiang 后台">
    <meta name="author" content="Bro Qiang<broqiang@qq.com>">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title','标题'); ?> - 后台</title>
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('css'); ?>

</head>

<body>
    <div id="app" class="-page">
        <?php echo $__env->make('admins._admins_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <main class="py-4">




            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('layouts._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- Scripts -->


    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
