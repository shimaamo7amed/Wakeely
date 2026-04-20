@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.show') . ' - ' . ($Governorate->title ?? ''))

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">

                {{-- Header --}}
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fa-solid fa-location-dot text-primary me-2"></i>
                        @lang('trans.governorate_details')
                    </h5>

                    <a href="{{ route(activeGuard().'.governorates.index') }}"
                       class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i>
                        @lang('trans.back')
                    </a>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- Governorate Name --}}
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <small class="text-muted d-block mb-1">
                                    @lang('trans.name')
                                </small>

                                <div class="fw-bold fs-5 text-dark">
                                    {{ $Governorate->title ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Country --}}
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light h-100">
                                <small class="text-muted d-block mb-1">
                                    @lang('trans.country')
                                </small>

                                <div class="fw-bold fs-5 text-primary">
                                    {{ $Governorate->country->title ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- flag --}}
                        <div class="col-md-12">
                            <div class="p-3 border rounded-3 text-center">
                                <img src="{{ $Governorate->country->flag ?? '' }}" class="img-fluid" alt="flag">
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection