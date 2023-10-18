<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
    <div class="card product-card border-0 mb-4">
        <img class="card-img-top" src="/{{ $product->image_path }}" alt="product">
        <div class="card-body">
            <h4 class="card-title">
                <a href="/products/{{ $product->id }}" class="text-dark">{{ $product->name }}</a>
            </h4>
            <p class="card-text">$ {{ $product->price }}</p>
        </div>
        <div class="card-footer border-0 d-flex">
            <a href="/products/{{ $product->id }}" class="btn mx-auto btn-sm">See Details</a>
        </div>
    </div>
</div>
