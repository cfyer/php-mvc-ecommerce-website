<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Home Page Here ...</h1>
    <hr>
    <div class="container">
        <?php echo $__env->make('client.layouts.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="/form/" method="post">
            <input type="hidden" name="csrf" value="<?php echo e(\App\Core\CSRFToken::_token()); ?>">
            <input type="text" name="name" placeholder="name:"><br>
            <input type="text" name="email" placeholder="email:"><br>
            <button type="submit">Go</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>