<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Products</h1>
    <div class="container mt-5">
        <div class="row">
            <?php echo $__env->make('admin.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->price); ?></td>
                            <td><?php echo e($product->quantity); ?></td>
                            <td class="d-flex">
                                <a href="/admin/products/<?php echo e($product->id); ?>/edit/"
                                    class="btn btn-info btn-sm mx-1">edit</a>
                                <form action="/admin/products/<?php echo e($product->id); ?>/delete/" method="post">
                                    <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                        type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <?php echo $links; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>