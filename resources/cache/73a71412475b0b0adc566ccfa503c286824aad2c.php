<?php $__env->startSection('title', 'Slider Slides'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Slider Slides</h1>
    <div class="container mt-5">
        <div class="row">
            <?php echo $__env->make('admin.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>image</th>
                        <th>link</th>
                        <th>operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($slide->image_path); ?></td>
                            <td><?php echo e($slide->link); ?></td>
                            <td class="d-flex">
                                <form action="/admin/slider/<?php echo e($slide->id); ?>/delete/" method="post">
                                    <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                        type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                                <a href="/admin/slider/<?php echo e($slide->id); ?>/active/"
                                    class="btn btn-warning mx-1 btn-sm
                                    <?php if(\App\Models\Slider::countActiveSlides($slide->id)): ?> disabled <?php endif; ?>">
                                    <?php if($slide->is_active === 0): ?>
                                        Active
                                    <?php else: ?>
                                        UnAvtive
                                    <?php endif; ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>