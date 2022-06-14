<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">
            <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel1">
                <div class="carousel-inner rounded box-shadow">
                    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item
                        <?php if($slide->is_active == 1): ?>
                            active
                        <?php endif; ?>
                        ">
                            <a href="#"><img src="/<?php echo e($slide->image_path); ?>" class="d-block w-100" alt="..."></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
