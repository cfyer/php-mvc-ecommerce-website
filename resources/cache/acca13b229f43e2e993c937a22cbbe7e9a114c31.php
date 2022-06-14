<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/front.css">
    <link rel="stylesheet" href="/assets/fonts/icofont/icofont.min.css">
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>

<body>
    <?php echo $__env->make('client.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('client.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
