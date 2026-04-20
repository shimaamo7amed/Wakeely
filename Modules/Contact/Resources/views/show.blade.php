@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.contact'))
@section('content')
    <div class="row">
        <div class="col-2">
            @lang('trans.name')
        </div>
        <div class="col-10">
            {{ $Model['name'] }}
        </div>

        <div class="col-2">
            @lang('trans.phone')
        </div>
        <div class="col-10">
            {{ $Model['phone'] }}
        </div>

        <div class="col-2">
            @lang('trans.email')
        </div>
        <div class="col-10">
            {{ $Model['email'] }}
        </div>

        <div class="col-2">
            @lang('trans.message')
        </div>
        <div class="col-10">
            <p> {{ $Model['message'] }}</p>
        </div>
    </div>

@endsection
