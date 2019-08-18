<?php $__env->startSection('title', '写文章'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <p class="text-muted">
                <?php if(isset($post)): ?>
                    编辑文章
                <?php else: ?>
                    写文章
                <?php endif; ?>
            </p>
        </div>
        <div class="card-body p-4 text-muted">
            <form method="POST" action="<?php echo e(isset($post) ? url('/admins/posts/update', $post->id) : url('/admins/posts/store')); ?>">
                <?php echo csrf_field(); ?>

                <?php if(isset($post)): ?>
                    <input type="hidden" name="_method" value="PUT">
                <?php endif; ?>

                <div class="form-group">
                    <label for="title">文章标题</label>

                    <input type="text" class="form-control <?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" name="title" value="<?php echo e(old('title', isset($post) ? $post->title : '')); ?>" required autofocus placeholder="输入标题">

                    <?php if($errors->has('title')): ?>
                        <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('title')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

















                <div class="form-group">
                    <label for="excerpt">简介</label>
                    <textarea class="form-control" name="jianjie" rows="5"></textarea>








                </div>

                <div class="form-group">
                    <label for="body">内容</label>
                    <div id="editormd_id">


                        <textarea class="form-control" name="body" rows="10"></textarea>
                    </div>

                    <?php if($errors->has('body')): ?>
                        <span class="invalid-feedback">
                            <strong><?php echo e($errors->first('body')); ?></strong>
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