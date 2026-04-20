<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ setting('title_'.lang()) }}</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta name="DT_Lang" value="{{ DT_Lang() }}" content="{{ DT_Lang() }}"/>
    <link rel="icon" href="{{ asset(setting('logo')) }}" type="image/x-icon">
@use('Illuminate\Support\Facades\Route')
    
    <link href="https://fonts.cdnfonts.com/css/tajawal" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                
    <style>
        :root {
            --main--color: {{ setting('main_color') }};
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item a::before {
            @if (lang('ar'))
            right: 0 !important;
            @else
            left: 0 !important;
            @endif
        }
        
        
        body, h1,h2,h3,h4,h5,h6,p,span,div,ul,li{
            font-family: 'Tajawal', sans-serif;                                          
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @yield('css')
    @stack('css')
    @if (lang('ar'))
        <link rel="stylesheet" href="{{ asset('css/ar.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/en.css') }}">
    @endif
</head>

<body>
    <aside class="sidebar-nav-wrapper active">
        <div class="navbar-logo">
            <a href="{{ route('admin.home') }}">
                <img src="{{ asset(setting('logo')) }}" alt="logo" style="max-width: 100%" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>

                <hr>
                    <li class="nav-item @if(str_contains(Route::currentRouteName(), 'home')) active @endif">
                        <a href="{{ route('admin.home') }}">
                            <span class="icon text-center">
                                <i style="width: 20px;" class="fa-solid fa-chart-simple mx-2"></i>
                            </span>
                            <span class="text">{{ __('trans.dashboardTitle') }}</span>
                        </a>
                    </li>
                    <hr>
                    @include('client::layouts.sidebar')
                    @include('lawyer::layouts.sidebar')
                <hr class="sidebar-divider">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLocations"
                            aria-expanded="false" aria-controls="collapseLocations">
                            <i class="fa-solid fa-earth-americas me-2"></i>
                            <span>@lang('trans.countries_and_regions')</span>
                        </a>
                        <div id="collapseLocations" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('*countries*') ? 'active' : '' }}" href="{{ route('admin.countries.index') }}">
                                    <i class="fa-solid fa-flag me-3"></i> @lang('trans.countries')
                                </a>
                                <a class="collapse-item {{ request()->is('*governorates*') ? 'active' : '' }}" href="{{ route('admin.governorates.index') }}">
                                    <i class="fa-solid fa-map me-3"></i> @lang('trans.governorates')
                                </a>
                                {{-- <a class="collapse-item {{ request()->is('*cities*') ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">
                                    <i class="fa-solid fa-city me-3"></i> @lang('trans.cities')
                                </a> --}}
                            </div>
                        </div>
                    </li>

                    <hr class="sidebar-divider">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings"
                            aria-expanded="false" aria-controls="collapseSettings">
                            <i class="fa-solid fa-gear me-2"></i>
                            <span>@lang('trans.system_settings')</span>
                        </a>
                        <div id="collapseSettings" class="collapse" aria-labelledby="headingPages" data-bs-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item {{ request()->is('*settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                    <i class="fa-solid fa-sliders me-3"></i> @lang('trans.general_settings')
                                </a>
                                <a class="collapse-item {{ request()->is('*about*') ? 'active' : '' }}" href="{{ route('admin.about.index') }}">
                                    <i class="fa-solid fa-circle-info me-3"></i> @lang('trans.about_us')
                                </a>
                                <a class="collapse-item {{ request()->is('*terms*') ? 'active' : '' }}" href="{{ route('admin.terms.index') }}">
                                    <i class="fa-solid fa-file-contract me-3"></i> @lang('trans.terms_conditions')
                                </a>
                                <a class="collapse-item {{ request()->is('*contact*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                                    <i class="fa-solid fa-envelope-open-text me-3"></i> @lang('trans.contact_us')
                                </a>
                            </div>
                        </div>
                    </li>

                <hr class="sidebar-divider">

                @include('faq::layouts.sidebar')
                <hr>
                @if (lang('ar'))
                    <li class="nav-item">
                        <a href="{{ route('lang', 'en') }}">
                            <span class="icon text-center">
                                <img src="{{ asset('lang.png') }}" style="border-radius: 50%;width: 20px;" class="mx-2">
                            </span>
                            <span class="text">English</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('lang', 'ar') }}">
                            <span class="icon text-center">
                                <img src="{{ asset('lang.png') }}" style="width: 20px;" class="mx-2">
                            </span>
                            <span class="text">العربية</span>
                        </a>
                    </li>
                @endif
                
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <span class="icon text-center">
                                <i style="width: 20px;" class="fa-solid fa-right-from-bracket mx-2"></i>
                            </span>
                            <span class="text">@lang('trans.logout')</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
    

    <main class="main-wrapper active">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6" style="z-index: 100">
                        <div class="header-left">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn main-btn btn-hover">
                                    <i class="lni lni-menu"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ auth()->user()->name }}</h6>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="{{ route('admin.profile.show') }}"> <i class="lni lni-user"></i> {{ __('trans.myProfile') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <span class="icon text-center">
                                                    <i style="width: 20px;" class="fa-solid fa-right-from-bracket mx-2"></i>
                                                </span>
                                                <span class="text">@lang('trans.logout')</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <style>
            .breadcrumbs li + li::before {
                content: "\{{lang('ar') ? 'f053' : 'f054' }}";
            }
        </style>
        
        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="breadcrumbs">
                           <div class="">
                                <ul class="breadcrumbs__list">
                                    <li>
                                        <a href="{{ route('admin.home') }}">@lang('trans.home')</a>
                                    </li>
                                    @hasSection('href')
                                    <li><a href="@yield('href')">@yield('href-title')</a></li>
                                    @endif

                                    @if(str_contains(Route::currentRouteName(), 'create'))
                                    
                                        @hasSection('href')
                                            <li><a href="@yield('href')">@yield('href-title')</a></li>
                                        @endif

                                        <li><a href="{{ route(str_replace("create", "index", Route::currentRouteName())) }}">@yield('pagetitle')</a></li>
                                        <li><a>@lang('trans.add')</a></li>
                                    @elseif(str_contains(Route::currentRouteName(), 'edit'))

                                        @hasSection('href')
                                            <li><a href="@yield('href')">@yield('href-title')</a></li>
                                        @endif

                                        <li><a href="{{ route(str_replace("edit", "index", Route::currentRouteName())) }}">@yield('pagetitle')</a></li>
                                        <li><a>@lang('trans.edit')</a></li>
                                    @else
                                        <li><a>@yield('pagetitle')</a></li>
                                    @endif

                                </ul>
                           </div>
                        </div>
                    </div>
                </div>

                <div class="card-styles">
                    @yield('content')
                </div>
            </div>
        </section>

    </main>



    @include('sweetalert::alert')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    {{-- datatables  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>



    @yield('js')
    @stack('js')
</body>
</html>
