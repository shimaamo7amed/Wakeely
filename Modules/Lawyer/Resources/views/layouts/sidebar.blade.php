@use('Illuminate\Support\Facades\Route')
<li class="nav-item @if(str_contains(Route::currentRouteName(), 'lawyers')) active @endif">
    <a href="{{ route(activeGuard().'.lawyers.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-user-tie mx-2"></i>
        </span>
        <span class="text">{{ __('trans.lawyers') }}</span>
    </a>
</li>