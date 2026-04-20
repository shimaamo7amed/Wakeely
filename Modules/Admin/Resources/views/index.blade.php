@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.admins'))
@section('content')

<div class="row">
    <div class="my-2 col-6">
        <a href="{{ route(activeGuard().'.admins.create') }}" class="main-btn btn-hover text-center px-5">@lang('trans.add_new') <i class="fa-solid fa-plus mx-1"></i></a>
    </div>
</div>
<table class="table table-bordered data-table text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.Name')</th>
            <th>@lang('trans.Phone')</th>
            <th>@lang('trans.visibility')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Models as $Model)
        <tr Role="row" class="odd">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->name }}</td>
            <td>{{ $Model->phone }}</td>
            <td>
                <input class="toggle" type="checkbox" onclick="toggleswitch({{ $Model->id }},'admins')" @if ($Model->status) checked @endif>
            </td>
            <td>
                <a href="{{ route(activeGuard().'.admins.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                @if ($Model->id > 1)    
                <form class="formDelete" method="POST" action="{{ route(activeGuard().'.admins.destroy', $Model) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
