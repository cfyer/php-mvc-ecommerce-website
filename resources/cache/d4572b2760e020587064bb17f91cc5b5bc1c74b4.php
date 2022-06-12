<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Edit <?php echo e($product->name); ?></h1>
    <div class="container mt-5">
        <div class="col-12 col-md-8 col-lg-6 mb-5 mx-auto">
            <?php echo $__env->make('admin.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form action="/admin/products/<?php echo e($product->id); ?>/update/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?php echo e(\App\Core\CSRFToken::_token()); ?>">

                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control mb-3" value="<?php echo e($product->name); ?>">

                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control mb-3" value="<?php echo e($product->price); ?>">

                <label for="description">Description:</label>
                <textarea name="description" class="form-control mb-3" rows="10"><?php echo e($product->description); ?></textarea>

                <label for="category_id">Category:</label>
                <select name="category_id" class="form-control mb-3">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option 
                        <?php if($product->category_id == $category->id): ?>
                            selected
                        <?php endif; ?>
                        value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label for="quantity">Quantity:</label>
                <select name="quantity" class="form-control mb-3">
                    <?php for($i = 1; $i <= 50; $i++): ?>
                        <option 
                        <?php if($product->quantity == $i): ?>
                            selected
                        <?php endif; ?>
                        value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>

                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control mb-3">

                <input type="submit" value="Update" class="btn btn-success ">
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>