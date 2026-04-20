@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.governorates'))
@section('content')

<div class="row">
        <div class="my-2 col-6 text-sm-start">
            <a href="{{ route(activeGuard().'.governorates.create') }}" class="main-btn">@lang('trans.add_new')</a>
        </div>
</div>


<table class="table dataTable  data-table" >
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.name_ar')</th>
            <th>@lang('trans.name_en')</th>
            <th>@lang('trans.country')</th>
            <th>@lang('trans.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Governorates as $Governorate)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a  href="{{ route(activeGuard().'.governorates.show', $Governorate) }}">{{ $Governorate->name_ar }}</a></td>
            <td><a  href="{{ route(activeGuard().'.governorates.show', $Governorate) }}">{{ $Governorate->name_en }}</a></td>
                <td>
                    <a href="{{ route(activeGuard().'.countries.show', $Governorate->country->id) }}">
                        {{ $Governorate->country->title }}
                    </a>
                </td>            <td>
                <a href="{{ route(activeGuard().'.governorates.edit', $Governorate) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route(activeGuard().'.governorates.destroy', $Governorate) }}">
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
