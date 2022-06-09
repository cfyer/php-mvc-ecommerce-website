<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Categories</h1>
    <div class="container mt-5">
        <?php echo $__env->make('admin.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-12 col-md-8 col-lg-5 mb-5 mx-auto">
            <form action="/admin/categories/store/" method="post">
                <div class="d-flex">
                    <input type="hidden" name="csrf" value="<?php echo e(\App\Core\CSRFToken::_token()); ?>">
                    <input type="text" name="name" placeholder="Category name:" class="form-control rounded-0">
                    <input type="submit" value="Go" class="btn btn-success rounded-0">
                </div>
            </form>
        </div>
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>name</th>
                    <th>slug</th>
                    <th>operation</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($category->name); ?></td>
                        <td><?php echo e($category->slug); ?></td>
                        <td class="d-flex">
                            <a href="/admin/categories/<?php echo e($category->id); ?>/edit/" class="btn btn-info btn-sm mx-1">edit</a>
                            <form action="/admin/categories/<?php echo e($category->id); ?>/delete/" method="post">
                                <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                    type="submit" value="delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>