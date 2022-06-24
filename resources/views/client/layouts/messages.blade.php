@if (\App\Core\Session::has('invalids'))
    <div class="alert alert-danger" role="alert">
        @foreach (\App\Core\Session::get('invalids') as $item)
            <strong>{{ $item }}</strong><br>
        @endforeach
    </div>
    @php
        \App\Core\Session::remove('invalids');
    @endphp
@endif


@if (\App\Core\Session::has('message'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ \App\Core\Session::get('message') }}</strong><br>
    </div>
    @php
        \App\Core\Session::remove('message');
    @endphp
@endif

@if (\App\Core\Session::has('payment'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ \App\Core\Session::get('payment') }}</strong><br>
    </div>
    @php
        \App\Core\Session::remove('payment');
    @endphp
@endif
