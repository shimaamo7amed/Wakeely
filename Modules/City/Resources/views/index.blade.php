@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.cities'))
@section('content')

<div class="row">
        <div class="my-2 col-6 text-sm-start">
            <a href="{{ route(activeGuard().'.cities.create') }}" class="main-btn">@lang('trans.add_new')</a>
        </div>
</div>

<table class="table dataTable  data-table" >
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.name_en')</th>
            <th>@lang('trans.name_ar')</th>
            <th>@lang('trans.governorate')</th>
            <th>@lang('trans.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a  href="{{ route(activeGuard().'.cities.show', $city) }}">{{ $city->name_en }}</a></td>
            <td><a  href="{{ route(activeGuard().'.cities.show', $city) }}">{{ $city->name_ar }}</a></td>
            <td><a  href="{{ route(activeGuard().'.governorates.show', $city->governorate) }}">{{ $city->governorate->name }}</a></td>

            <td>
                <a href="{{ route(activeGuard().'.cities.edit', $city) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route(activeGuard().'.cities.destroy', $city) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
