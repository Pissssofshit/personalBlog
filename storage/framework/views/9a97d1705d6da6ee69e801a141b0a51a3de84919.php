<?php $__env->startSection('title', '用户列表'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">

            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">用户列表</div>
            </div>
        </div>
        <?php if(isset($users) && count($users)): ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">姓名</th>
                                <th scope="col">邮箱</th>
                                <th scope="col">头像</th>


                                <th scope="col">创建时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($user->id); ?></th>
                                    <td class="text-truncate" style="max-width: 150px;" title="<?php echo e($user->name); ?>">
                                        <a class="text-info" href="" target="_blank">
                                            <?php echo e($user->name); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><img src="<?php echo e($user->avatar); ?>" alt="头像" width="32"></td>


                                    <td title="<?php echo e($user->created_at); ?>"><?php echo e($user->created_at); ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm m-1 js-btn-del" data-id="12">
                                            <i class="fa fa-trash-o"></i> 删除
                                            <form class="d-none" action="" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <?php echo e($users->links()); ?>

            </div>
        <?php else: ?>
            <div class="card-body">
                <p class="text-muted">
                    没有任何文章 ～
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $('.js-btn-del').on('click',function(){
        var oForm = $(this).children('form');
        swal_delete(function(){
            oForm.submit();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admins.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>