@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.about'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['title_en'] }}
        </td>
        <td class="text-center">
            {{ $Model['title_ar'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {{ $Model['desc_en'] }}
        </td>
        <td class="text-center">
            {{ $Model['desc_ar'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {{ $Model['icon'] }}
        </td>
        <td class="text-center">
            <img src="{{ asset($Model['image']) }}" width="100">
        </td>
    </tr>
</table>
<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route(activeGuard().'.about.index') }}" class="main-btn">@lang('trans.back')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <a href="{{ route(activeGuard().'.about.edit', $Model) }}" class="main-btn">@lang('trans.edit')</a>
    </div>
</div>

@endsection
