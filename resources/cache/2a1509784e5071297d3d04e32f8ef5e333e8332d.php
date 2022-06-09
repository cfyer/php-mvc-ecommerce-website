<?php $__env->startSection('title' , 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-center mt-2">Dashboard</h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card mb-4 bg-warning border-0">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="icofont icofont-slack"></i>
                            Categories
                        </h4>
                        <h5 class="card-text">8</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card mb-4 bg-info border-0">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="icofont icofont-food-basket"></i>
                            Products
                        </h4>
                        <h5 class="card-text">80</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card mb-4 bg-light border-0">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="icofont icofont-users"></i>
                            Users
                        </h4>
                        <h5 class="card-text">34</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card mb-4 bg-success bg-opacity-25 border-0">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="icofont icofont-basket"></i>
                            Orders
                        </h4>
                        <h5 class="card-text">8</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>