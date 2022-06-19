<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
    <div class="card mb-4">
        <img class="card-img-top" src="/{{ $product->image_path }}" alt="product">
        <div class="card-body">
            <h4 class="card-title">
                <a href="/products/{{ $product->id }}" class="text-dark">{{ $product->name }}</a>
            </h4>
            <p class="card-text">$ {{ $product->price }}</p>
        </div>
        <div class="card-footer d-flex">
            <a href="/products/{{ $product->id }}" class="btn btn-primary btn-sm">See More</a>
            <button class="btn btn-success btn-sm mx-2 addCart" data-productId="{{ $product->id }}">
                Add to Cart
            </button>
            <input type="hidden" name="quantity" id="quantity" value="1">
        </div>
    </div>
</div>
