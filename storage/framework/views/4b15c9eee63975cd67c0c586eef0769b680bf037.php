@import  'bootstrap/scss/bootstrap
<link rel="stylesheet" href="<?php echo e(URL::asset('sass/navbar.scss')); ?>">

<div class="navbar-fixed">
    <nav id="nav-bar" class="z-depth-0">
        <div class="nav-wrapper container" id="nav-main-bar">
            
            <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-med-and-down menu-on-large"><i class="material-icons">menu</i></a>

            
            <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>

            <a href="/" class="brand-logo"><i class="material-icons hide-on-small-and-down">home</i></a>
            <ul class="right hide-on-med-and-down">

                <li>
                    <!-- Search bar -->
                    <form action="">
                        <div class="input-field">
                            <input id="search" type="search" name="q" required>
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </li>

                <!-- Dropdown Trigger -->
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="cate-dropdown">
                        <?php echo app('translator')->getFromJson('menus.categories'); ?>
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>

                <li><a class="waves-effect waves-light" href="<?php echo e(url('ttt')); ?>"><?php echo app('translator')->getFromJson('menus.about'); ?></a></li>
            </ul>

            
            <ul class="right hide-on-large-only">
                <li>
                    <i class="material-icons mobile-search">search</i>
                </li>
            </ul>

        </div>

        
        <div class="nav-wrapper hide" id="nav-search-bar">
            <form action="">
                <div class="input-field">
                    <input id="mobile-search-input" type="search" name="q" required>
                    <label class="label-icon" for="mobile-search-input"><i class="material-icons">search</i></label>
                    <i class="material-icons mobile-search-close">close</i>
                </div>
            </form>
        </div>

    </nav>
</div>

<!-- Dropdown Structure -->
<ul id="cate-dropdown" class="dropdown-content">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a class="waves-effect waves-teal" href="<?php echo e(url('categories.show', $category->slug)); ?>"><?php echo e($category->name); ?></a></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
