<?php $__env->startSection('title', '评论管理'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">

            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">评论管理</div>
            </div>
        </div>
        <?php if(isset($comments) && count($comments)): ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">评论内容</th>
                                <th scope="col">所属文章</th>
                                <th scope="col">评论用户</th>
                                <th scope="col">评论时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($comment->id); ?></th>
                                    <td class="text-truncate" style="max-width: 150px;" title="<?php echo e($comment->content); ?>"><?php echo e($comment->content); ?></td>
                                    <td class="text-truncate" style="max-width: 150px;" title="<?php echo e($comment->title); ?>">
                                        <a class="text-info" href="" target="_blank">
                                            <?php echo e($comment->title); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <i class="fa fa-user mr-1 text-info"></i>
                                        <a class="text-info" href="">
                                            <?php echo e($comment->name); ?>

                                        </a>
                                    </td>
                                    <td title="<?php echo e($comment->created_at); ?>"><?php echo e($comment->created_at); ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm m-1" href="<?php echo e(url('/admins/comments/'.$comment->id.'/edit')); ?>">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <a class="btn btn-info btn-sm m-1" href="<?php echo e(url('/admins/comments/delete/'.$comment->id)); ?>">
                                            <i class="fa fa-edit"></i> 删除
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <?php echo e($comments->links()); ?>

            </div>
        <?php else: ?>
            <div class="card-body">
                <p class="text-muted">
                    没有任何分类 ～
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