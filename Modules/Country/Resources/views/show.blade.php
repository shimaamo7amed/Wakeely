@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.show') . ' - ' . $Country->title)

@section('content')

<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            
            {{-- Header --}}
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-secondary">
                    <i class="fa-solid fa-flag text-primary me-2"></i> @lang('trans.country_details')
                </h5>
                <a href="{{ route(activeGuard().'.countries.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> @lang('trans.back')
                </a>
            </div>

            {{-- Body --}}
            <div class="card-body">
                <div class="row align-items-center">

                    {{-- صورة العلم --}}
                    <div class="col-md-3 text-center border-end">
                        @if($Country->flag)
                            <img src="{{ asset($Country->flag) }}" 
                                 alt="{{ $Country->title() }}" 
                                 class="img-fluid rounded border shadow-sm" 
                                 style="max-height: 90px; object-fit: contain;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                                <i class="fa-solid fa-flag fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>

                    {{-- التفاصيل --}}
                    <div class="col-md-9 ps-md-4">
                        <div class="row">

                            {{-- الاسم --}}
                            <div class="col-md-7 mb-3 mb-md-0">
                                <label class="text-muted small d-block">@lang('trans.name')</label>
                                <span class="h4 fw-bold text-dark">{{ $Country->title }}</span>
                            </div>

                            {{-- code --}}
                            <div class="col-md-5">
                                <label class="text-muted small d-block">@lang('trans.code')</label>
                                <span class="h4 fw-bold text-dark">{{ $Country->code }}</span>
                            </div>

                            

                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer bg-light border-0 py-3 d-flex justify-content-end gap-2">
                
                {{-- Edit --}}
                <a href="{{ route(activeGuard().'.countries.edit', $Country->id) }}" 
                   class="btn btn-sm btn-primary px-3 rounded-pill">
                    <i class="fa-solid fa-pen-to-square me-1"></i> @lang('trans.edit')
                </a>

                {{-- Delete --}}
                <form action="{{ route(activeGuard().'.countries.destroy', $Country->id) }}" method="POST" class="formDelete d-inline">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger px-3 rounded-pill show_confirm">
                        <i class="fa-solid fa-trash-can me-1"></i> @lang('trans.delete')
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #dee2e6;
    border-radius: 50px;
    transition: 0.3s;
}

.slider::before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    left: 4px;
    top: 3px;
    background-color: white;
    border-radius: 50%;
    transition: 0.3s;
}

.switch input:checked + .slider {
    background-color: #198754;
}

.switch input:checked + .slider::before {
    transform: translateX(24px);
}

.switch input:focus + .slider {
    box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.25);
}
</style>

@endsection