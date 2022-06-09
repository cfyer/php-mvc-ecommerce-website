<?php if(\App\Core\Session::has('invalids')): ?>
    <div class="alert alert-danger" role="alert">
        <?php $__currentLoopData = \App\Core\Session::get('invalids'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <strong><?php echo e($item); ?></strong><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php
        \App\Core\Session::remove('invalids');
    ?>
<?php endif; ?>


<?php if(\App\Core\Session::has('message')): ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?php echo e(\App\Core\Session::get('message')); ?></strong><br>
    </div>
    <?php
        \App\Core\Session::remove('message');
    ?>
<?php endif; ?>

