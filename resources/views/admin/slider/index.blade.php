@extends('admin.layouts.app')

@section('title', 'Slider Slides')

@section('content')
    <h1 class="text-center mt-2">Slider Slides</h1>
    <div class="container mt-5">
        <div class="row">
            @include('admin.layouts.messages')
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>image</th>
                        <th>link</th>
                        <th>operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slides as $slide)
                        <tr>
                            <td>{{ $slide->image_path }}</td>
                            <td>{{ $slide->link }}</td>
                            <td class="d-flex">
                                <form action="/admin/slider/{{ $slide->id }}/delete/" method="post">
                                    <input onclick="if (! confirm('Are you sure delete this item?')) { return false; }"
                                        type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                                <a href="/admin/slider/{{ $slide->id }}/active/"
                                    class="btn btn-warning mx-1 btn-sm
                                    @if (\App\Models\Slider::countActiveSlides($slide->id)) disabled @endif">
                                    @if ($slide->is_active === 0)
                                        Active
                                    @else
                                        UnAvtive
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
