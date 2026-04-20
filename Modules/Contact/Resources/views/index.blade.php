@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.contact'))
@section('content')

<div class="my-2 text-sm-end">
    <button type="button" id="DeleteSelected" onclick="DeleteSelected('contacts')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
</div>
<table class="table table-bordered data-table" >
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>#</th>
            <th>@lang('trans.name')</th>
            <th>@lang('trans.phone')</th>
            <th>@lang('trans.email')</th>
           <th>@lang('trans.message')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Models as $Model)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->name }}</td>
            <td>{{ $Model->email }}</td>
            <td>{{ $Model->phone }}</td>
           <td>{{ $Model->message }}</td>
            <td>
                <a href="{{ route(activeGuard().'.contacts.show',  $Model) }}"><i class="fas fa-eye"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
