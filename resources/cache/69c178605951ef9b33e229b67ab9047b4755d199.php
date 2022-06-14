<footer class="p-3 bg-info">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <strong>New Products</strong>
                <ul class="mt-2">
                    <?php $__currentLoopData = \App\Models\Product::footerProducts()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="#" class="text-black"><?php echo e($product->name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="col-12 col-sm-6">
                <strong>Useful links</strong>
                <ul class="mt-2">
                    <li>
                        <a href="#" class="text-black">Home</a>
                    </li>
                    <li>
                        <a href="#" class="text-black">Register</a>
                    </li>
                    <li>
                        <a href="#" class="text-black">Login</a>
                    </li>
                    <li>
                        <a href="#" class="text-black">Github Repository</a>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="col-12">
                <p class="text-center m-0 mb-2">© Copyright Reserved</p>
                <p class="text-center m-0" style="font-size: 14px">
                    Created by <a href="#">Hamireza Safayee</a>
                </p>
            </div>
        </div>
    </div>
</footer>
