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
