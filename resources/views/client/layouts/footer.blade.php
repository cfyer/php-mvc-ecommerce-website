<footer class="p-3 bg-info">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <strong>New Products</strong>
                <ul class="mt-2">
                    @foreach (\App\Models\Product::footerProducts()->get() as $product)
                        <li>
                            <a href="/products/{{ $product->id }}/" class="text-black">{{ $product->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-sm-6">
                <strong>Useful links</strong>
                <ul class="mt-2">
                    <li>
                        <a href="/" class="text-black">Home</a>
                    </li>
                    <li>
                        <a href="/register" class="text-black">Register</a> / <a href="/login"
                            class="text-black">Login</a>
                    </li>
                    <li>
                        <a href="/products/" class="text-black">Products</a>
                    </li>
                    <li>
                        <a href="https://github.com/hamidrezasfy/php-mvc-ecommerce-website/"
                            class="text-black">Github Repository</a>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="col-12">
                <p class="text-center m-0 mb-2">© Copyright Reserved</p>
                <p class="text-center m-0" style="font-size: 14px">
                    Created by <a href="https://github.com/hamidrezasfy/" target="_blank">Hamireza Safayee</a>
                </p>
            </div>
        </div>
    </div>
</footer>
