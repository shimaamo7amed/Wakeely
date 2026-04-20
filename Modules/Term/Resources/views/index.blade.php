@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.terms'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route(activeGuard().'.terms.create') }}" class="main-btn">@lang('trans.add_new')</a>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Slug</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($Models as $Model)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->slug }}</td>

            <td>{{ $Model->sections_ar[0]['title'] ?? '-' }}</td>
            <td>{{ $Model->sections_en[0]['title'] ?? '-' }}</td>

            <td>
                <a href="{{ route(activeGuard().'.terms.show', $Model) }}"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route(activeGuard().'.terms.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>

                <form method="POST" action="{{ route(activeGuard().'.terms.destroy', $Model) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection