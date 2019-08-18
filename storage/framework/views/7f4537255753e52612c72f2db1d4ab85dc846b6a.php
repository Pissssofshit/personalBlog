<?php $__env->startSection('title', '编辑评论'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <p class="text-muted">
                编辑评论
            </p>
        </div>
        <div class="card-body p-4 text-muted">




            <form method="POST" action="<?php echo e(url('/admins/comments/update/'.$comment->id)); ?>">

                <?php echo csrf_field(); ?>
                <?php if(isset($comment)): ?>
                    <input type="hidden" name="_method" value="PUT">
                <?php endif; ?>

                <div class="form-group">
                    <label for="content">评论内容</label>

                    <textarea  class="form-control <?php echo e($errors->has('content') ? ' is-invalid' : ''); ?>" name="content" rows="5" required><?php echo e(old('content', isset($comment) ? $comment->content : '')); ?></textarea>

                    <?php if($errors->has('content')): ?>
                        <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('content')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group my-3">
                    <button type="submit" class="btn btn-success pull-right">
                        <i class="fa fa-save mr-2"></i>保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $('.js-btn-del').on('click',function(){
        var obj = $(this).children('form');
        swal_delete(function(){
            console.log(obj);
            obj.submit();
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admins.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>