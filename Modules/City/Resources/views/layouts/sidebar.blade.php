
@use('Illuminate\Support\Facades\Route')
<li class="nav-item @if(str_contains(Route::currentRouteName(), 'cities')) active @endif">
    <a class="collapsed" href="{{ route(activeGuard().'.cities.index') }}" class="" >
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-earth-asia mx-2"></i>
        </span>
        <span class="text">{{ __('trans.cities') }}</span>
    </a>
</li>