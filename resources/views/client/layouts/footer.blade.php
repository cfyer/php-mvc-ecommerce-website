<footer class="p-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <strong>New Products</strong>
                <ul class="mt-2">
                    @foreach (\App\Models\Product::footerProducts()->get() as $product)
                        <li class="my-2">
                            <a href="/products/{{ $product->id }}/" class="text-black">{{ $product->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-sm-6">
                <strong>Useful links</strong>
                <ul class="mt-2">
                    <li class="my-2">
                        <a href="/" class="text-black">Home</a>
                    </li>
                    <li class="my-2">
                        <a href="/register" class="text-black">Register</a> / <a href="/login"
                            class="text-black">Login</a>
                    </li>
                    <li class="my-2">
                        <a href="/products/" class="text-black">Products</a>
                    </li>
                    <li class="my-2">
                        <a href="https://github.com/cfyer/php-mvc-ecommerce-website/"
                            class="text-black">Github Repository</a>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="col-12">
                <p class="text-center m-0 mb-2">© Copyright Reserved</p>
                <p class="text-center m-0" style="font-size: 14px">
                    Created by <a href="https://github.com/cfyer/" target="_blank">Hamidreza Safayee</a>
                </p>
            </div>
        </div>
    </div>
</footer>
