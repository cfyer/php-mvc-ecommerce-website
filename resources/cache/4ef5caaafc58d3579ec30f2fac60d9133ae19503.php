<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Home Page Here ...</h1>
    </div>
    <hr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>