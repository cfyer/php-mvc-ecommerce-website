<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Edit <?php echo e($category->name); ?></h1>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-5 mb-5 mx-auto">
            <?php echo $__env->make('admin.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="/admin/categories/<?php echo e($category->id); ?>/update/" method="post">
                <input type="hidden" name="csrf" value="<?php echo e(\App\Core\CSRFToken::_token()); ?>">

                <label for="name">Category name:</label>
                <input type="text" name="name" value="<?php echo e($category->name); ?>" class="form-control rounded-0 mb-4">

                <input type="submit" value="Go" class="btn btn-success rounded-0">
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>