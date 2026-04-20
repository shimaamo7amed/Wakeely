@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.countries'))
@section('content')

<table class="table dataTable  data-table" >
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.name_ar')</th>
            <th>@lang('trans.name_en')</th>
            <th>@lang('trans.flag')</th>
            <th>@lang('trans.code')</th>
            <th>@lang('trans.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Countries as $Country)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a  href="{{ route(activeGuard().'.countries.show', $Country) }}">{{ $Country->name_ar }}</a></td>
            <td><a  href="{{ route(activeGuard().'.countries.show', $Country) }}">{{ $Country->name_en }}</a></td>
            <td><img src="{{ asset($Country->flag) }}" style="max-width: 80px"></td>
            <td><a  href="{{ route(activeGuard().'.countries.show', $Country) }}">{{ $Country->code }}</a></td>
            <td>
                <a href="{{ route(activeGuard().'.countries.edit', $Country) }}"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
