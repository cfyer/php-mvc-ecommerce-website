<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="/">Home</a>
                    <a class="breadcrumb-item" href="#">Products</a>
                    <span class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></span>
                </nav>
            </div>

            <div class="col-12 col-md-5">
                <img src="/<?php echo e($product->image_path); ?>" alt="<?php echo e($product->name); ?>" class="img-fluid rounded">
            </div>

            <div class="col-12 col-md-5">
                <h1><?php echo e($product->name); ?></h1>
                <div><?php echo $product->description; ?></div>
                <div class="mt-3">
                    <strong>$<?php echo e($product->price); ?></strong>
                    <button class="btn btn-success mx-2 btn-sm">Add to cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <h3>Similar Products</h3>
            <?php $__currentLoopData = $similarProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('client.layouts.single_product', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>