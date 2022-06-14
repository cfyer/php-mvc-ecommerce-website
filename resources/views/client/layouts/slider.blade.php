<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">
            <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel1">
                <div class="carousel-inner rounded box-shadow">
                    @foreach ($slides as $slide)
                        <div class="carousel-item
                        @if ($slide->is_active == 1)
                            active
                        @endif
                        ">
                            <a href="#"><img src="/{{ $slide->image_path }}" class="d-block w-100" alt="..."></a>
                        </div>
                    @endforeach

                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
