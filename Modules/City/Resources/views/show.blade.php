@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.show') . ' - ' . $City->name)

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">@lang('trans.city_details')</h5>
                <a href="{{ route(activeGuard().'.cities.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-arrow-left mx-1"></i> @lang('trans.back')
                </a>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    {{-- عرض صورة الدولة (العلم) --}}
                    <div class="col-md-2 text-center">
                        @if($City->governorate && $City->governorate->country && $City->governorate->country->image)
                            <img src="{{ asset($City->governorate->country->image) }}" 
                                 alt="{{ $City->governorate->country->title() }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 100px;">
                        @else
                            <i class="fa-solid fa-flag fa-4x text-muted"></i>
                        @endif
                    </div>

                    <div class="col-md-10">
                        <div class="row">
                            {{-- اسم المدينة --}}
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">@lang('trans.city')</p>
                                <h5 class="fw-bold">{{ $City->name }}</h5>
                            </div>

                            {{-- اسم المحافظة --}}
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">@lang('trans.governorate')</p>
                                <h5 class="fw-bold text-primary">
                                    {{ $City->governorate ? $City->governorate->name: '--' }}
                                </h5>
                            </div>

                            {{-- اسم الدولة --}}
                            <div class="col-md-4">
                                <p class="mb-1 text-muted">@lang('trans.country')</p>
                                <h5 class="fw-bold text-success">
                                    {{ $City->governorate->country ? $City->governorate->country->title() : '--' }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection