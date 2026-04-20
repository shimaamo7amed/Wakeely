
@use('Illuminate\Support\Facades\Route')

<li class="nav-item @if(str_contains(Route::currentRouteName(), 'faq')) active @endif">
    <a href="{{ route(activeGuard().'.faq.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-question-circle mx-2"></i>
        </span>
        <span class="text">{{ __('trans.faq') }}</span>
    </a>
</li>