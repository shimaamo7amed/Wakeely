@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.lawyer_details'))
@php
    $lang = app()->getLocale();
@endphp
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                   <div class="mb-3">
                            <div class="logo-container mx-auto">
                                <img src="{{ asset($Model->image ?? setting('logo')) }}" 
                                     class="profile-logo" 
                                     alt="Logo">
                            </div>
                    </div>
                    

                    {{-- Name --}}
                    <h5 class="fw-bold text-dark">{{ $Model->first_name . ' ' . $Model->last_name }}</h5>

                    {{-- Status Badge --}}
                    <div class="mb-3">
                        <span class="badge py-2 px-3 {{ $Model->status == 'accepted' ? 'bg-success' : ($Model->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                            <i class="fas fa-circle me-1 small"></i> @lang('trans.' . $Model->status)
                        </span>
                    </div>

                    <hr class="light">

                    {{-- Contact Info --}}
                    <div class="text-start px-3">
                        <p class="mb-2">
                            <small class="text-muted d-block">@lang('trans.phone')</small>
                            <span class="fw-bold text-dark" dir="ltr">{{ $Model->phone_code . $Model->phone }}</span>
                        </p>
                        <p class="mb-2">
                            <small class="text-muted d-block">@lang('trans.email')</small>
                            <span class="fw-bold text-dark">{{ $Model->email ?? '---' }}</span>
                        </p>
                        <p class="mb-0">
                            <small class="text-muted d-block">@lang('trans.country')</small>
                            @if($Model->Country)
                                <img src="{{ asset($Model->Country->flag) }}" width="20" class="me-1 shadow-xs">
                                <span class="fw-bold text-dark">{{ $Model->Country->title() }}</span>
                            @else
                                <span class="fw-bold text-dark">---</span>
                            @endif
                        </p>
                    </div>

                </div>
            </div>

            {{-- Rejection Reasons Card --}}
            @if($Model->status == 'rejected' && $Model->rejectionReasons->count() > 0)
            <div class="card border-start border-danger border-4 shadow mb-4">
                <div class="card-header py-3 bg-danger text-white">
                    <h6 class="m-0 fw-bold">
                        <i class="fas fa-exclamation-triangle me-2"></i> @lang('trans.rejection_reasons')
                    </h6>
                </div>
                <div class="card-body bg-light-danger">
                    <ul class="list-group list-group-flush bg-transparent">
                        @foreach($Model->rejectionReasons as $reason)
                        <li class="list-group-item bg-transparent px-0 border-bottom-0">
                            <div class="d-flex">
                                <i class="fas fa-times-circle text-danger mt-1 me-2"></i>
                                <div>
                                    <span class="fw-bold text-danger d-block">
                                        {{ app()->getLocale() == 'ar' ? $reason->name_ar : $reason->name_en }}
                                    </span>
                                    <small class="text-dark fw-500 italic">{{ $reason->pivot->custom_comment ?? '' }}</small>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

        </div>

        {{-- ======================== --}}
        {{-- COLUMN RIGHT (Details)   --}}
        {{-- ======================== --}}
        <div class="col-xl-8 col-lg-7">
<div class="d-flex justify-content-end mb-3 gap-2">

    {{-- Back to index --}}
    <a href="{{ route(activeGuard().'.lawyers.index') }}" 
       class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>
        @lang('trans.back')
    </a>

    {{-- Edit --}}
    <a href="{{ route(activeGuard().'.lawyers.edit', $Model->id) }}" 
       class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>
        @lang('trans.edit')
    </a>

</div>
            {{-- Professional Info Card --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white border-bottom">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-briefcase me-2"></i> @lang('trans.professional_info')
                    </h6>
                </div>
                <div class="card-body">
                    @if($Model->legalProfile)
                        <div class="row mb-4">
                            <div class="col-md-6 border-end">
                                <label class="text-muted small d-block">@lang('trans.bar_association')</label>
                                <p class="fw-bold text-dark">{{ $lang == 'ar' ? $Model->legalProfile->barAssociation->name_ar : $Model->legalProfile->barAssociation->name_en ?? '---' }}</p>
                            </div>
                            <div class="col-md-6 px-4">
                                <label class="text-muted small d-block">@lang('trans.sub_association')</label>
                                <p class="fw-bold text-dark">{{ $lang == 'ar' ? $Model->legalProfile->subAssociation->name_ar : $Model->legalProfile->subAssociation->name_en ?? '---' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block mb-2">@lang('trans.expertises')</label>
                                @forelse($Model->legalProfile->expertises as $expertise)
                                    <span class="badge bg-soft-primary text-primary border border-primary border-opacity-25 me-1 mb-1">{{$lang == 'ar' ? $expertise->name_ar : $expertise->name_en ?? '---' }}</span>
                                @empty
                                    <span class="text-muted small">---</span>
                                @endforelse
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block mb-2">@lang('trans.work_areas')</label>
                                @forelse($Model->legalProfile->workAreas as $area)
                                    <span class="badge bg-soft-info text-info border border-info border-opacity-25 me-1 mb-1">{{ $lang == 'ar' ? $area->name_ar : $area->name_en ?? '---' }}</span>
                                @empty
                                    <span class="text-muted small">---</span>
                                @endforelse
                            </div>
                            {{--Languages --}}
                            <div class="col-md-6">
                                <label class="form-label small text-muted d-block">@lang('trans.Languages')</label>
                                @forelse($Model->legalProfile->languages as $languages)
                                    <span class="badge bg-soft-info text-info border border-info border-opacity-25 me-1 mb-1">
                                        {{ $lang == 'ar' ? $languages->name_ar : $languages->name_en ?? '---' }}
                                    </span>
                                @empty
                                    <span class="text-muted small">---</span>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted small">@lang('trans.no_profile_data')</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Qualifications Table Card --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white border-bottom text-primary">
                    <h6 class="m-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i> @lang('trans.qualifications')</h6>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light small">
                                <tr>
                                    <th class="ps-4">@lang('trans.degree')</th>
                                    <th>@lang('trans.university')</th>
                                    <th>@lang('trans.graduation_year')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($Model->legalProfile)
                                    @forelse($Model->legalProfile->qualifications as $qual)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">{{ $lang == 'ar' ? $qual->degreeType->name_ar : $qual->degreeType->name_en ?? '---' }}</td>
                                        <td>{{$lang == 'ar' ? $qual->university->name_ar : $qual->university->name_en ?? '---' }}</td>
                                        <td><span class="badge bg-secondary opacity-75">{{ $qual->year }}</span></td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center py-3 text-muted">@lang('trans.no_qualifications')</td></tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           {{-- Documents (Images Section) --}}
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white border-bottom text-primary">
        <h6 class="m-0 fw-bold"><i class="fas fa-id-card me-2"></i> @lang('trans.documents')</h6>
    </div>
    <div class="card-body">

        {{-- صورة الهوية --}}
        <h6 class="text-muted fw-bold small text-uppercase mb-3">@lang('trans.id_card')</h6>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="document-box text-center p-3 border rounded bg-light">
                    <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.id_card_front')</label>
                    @if($Model->cardId && $Model->cardId->front_id_card)
                        <a href="{{ asset($Model->cardId->front_id_card) }}" target="_blank">
                            <img src="{{ asset($Model->cardId->front_id_card) }}" class="img-fluid rounded border shadow-sm hover-zoom" style="max-height: 180px;">
                        </a>
                    @else
                        <div class="py-5 border-dashed rounded bg-white">
                            <i class="fas fa-image fa-2x text-light d-block mb-2"></i>
                            <span class="text-muted small">@lang('trans.no_image_uploaded')</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="document-box text-center p-3 border rounded bg-light">
                    <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.id_card_back')</label>
                    @if($Model->cardId && $Model->cardId->back_id_card)
                        <a href="{{ asset($Model->cardId->back_id_card) }}" target="_blank">
                            <img src="{{ asset($Model->cardId->back_id_card) }}" class="img-fluid rounded border shadow-sm hover-zoom" style="max-height: 180px;">
                        </a>
                    @else
                        <div class="py-5 border-dashed rounded bg-white">
                            <i class="fas fa-image fa-2x text-light d-block mb-2"></i>
                            <span class="text-muted small">@lang('trans.no_image_uploaded')</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <hr class="mb-4">

        {{-- صورة كارنيه النقابة --}}
        <h6 class="text-muted fw-bold small text-uppercase mb-3">@lang('trans.legal_card')</h6>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="document-box text-center p-3 border rounded bg-light">
                    <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.legal_card_front')</label>
                    @if($Model->LegalCardId && $Model->LegalCardId->front_legal_card)
                        <a href="{{ asset($Model->LegalCardId->front_legal_card) }}" target="_blank">
                            <img src="{{ asset($Model->LegalCardId->front_legal_card) }}" class="img-fluid rounded border shadow-sm hover-zoom" style="max-height: 180px;">
                        </a>
                    @else
                        <div class="py-5 border-dashed rounded bg-white">
                            <i class="fas fa-image fa-2x text-light d-block mb-2"></i>
                            <span class="text-muted small">@lang('trans.no_image_uploaded')</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="document-box text-center p-3 border rounded bg-light">
                    <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.legal_card_back')</label>
                    @if($Model->LegalCardId && $Model->LegalCardId->back_legal_card)
                        <a href="{{ asset($Model->LegalCardId->back_legal_card) }}" target="_blank">
                            <img src="{{ asset($Model->LegalCardId->back_legal_card) }}" class="img-fluid rounded border shadow-sm hover-zoom" style="max-height: 180px;">
                        </a>
                    @else
                        <div class="py-5 border-dashed rounded bg-white">
                            <i class="fas fa-image fa-2x text-light d-block mb-2"></i>
                            <span class="text-muted small">@lang('trans.no_image_uploaded')</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

        </div>
    </div>
</div>

<style>
    .fw-500 { font-weight: 500; }
    .fw-bold { font-weight: 700 !important; }
    .bg-soft-primary { background-color: rgba(78, 115, 223, 0.1) !important; }
    .bg-soft-info { background-color: rgba(54, 185, 204, 0.1) !important; }
    .bg-light-danger { background-color: #fff5f5 !important; }
    .shadow-xs { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; }
    .italic { font-style: italic; font-size: 0.85rem; }
    .hover-zoom:hover { transform: scale(1.03); transition: 0.3s; cursor: zoom-in; }
    .border-dashed { border: 2px dashed #e3e6f0; }
    .badge { font-weight: 600; letter-spacing: 0.3px; }
    
    .profile-logo { width: 85%; height: 85%; object-fit: contain; }
</style>
@endsection