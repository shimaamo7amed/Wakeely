@php
    $sidePagesTypes = ['theme'];
@endphp
@use('Illuminate\Support\Facades\Route')
<li class="nav-item @if(str_contains(Route::currentRouteName(), 'publicSettings')) active @endif">

    <a href="{{ route(activeGuard().'.settings.index',['type'=>'publicSettings']) }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-gears mx-2"></i>
        </span>
        <span class="text">{{ __('trans.settings') }}</span>
    </a>
</li>
@foreach (Settings()->whereNotIn('type',['publicSettings'])->unique('type') as $item)
<li class="nav-item @if(str_contains(Route::currentRouteName(), $item->type)) active @endif">

    <a href="{{ route(activeGuard().'.settings.index',['type'=>$item->type]) }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-gears mx-2"></i>
        </span>
        <span class="text">{{ __('trans.'.$item->type) }}</span>
    </a>
</li>
@endforeach