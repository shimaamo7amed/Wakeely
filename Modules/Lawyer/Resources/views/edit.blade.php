@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.lawyers'))
@php
    $lang = app()->getLocale();
@endphp
@section('content')
<div class="container-fluid py-4">
    <form action="{{ route(activeGuard().'.lawyers.update', $Model->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="logo-container mx-auto">
                                <img src="{{ asset($Model->image ?? setting('logo')) }}" 
                                     class="profile-logo" 
                                     alt="Logo">
                            </div>
                        </div>
                        
                        <h4 class="mb-1 fw-bold">{{ $Model->first_name }} {{ $Model->last_name }}</h4>
                        <p class="text-muted small mb-3">{{ $Model->email }}</p>
                        
                        <span id="currentStatusBadge" class="badge {{ $Model->status == 'accepted' ? 'bg-success' : ($Model->status == 'rejected' ? 'bg-danger' : 'bg-warning') }} px-4 py-2 rounded-pill">
                            {{ ucfirst($Model->status) }}
                        </span>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-user-shield me-2 text-primary"></i>{{ __('trans.actions') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold small text-uppercase text-muted">{{ __('trans.status') }}</label>
                            <select name="status" id="statusSelect" class="form-select border-primary shadow-none" required>
                                <option value="pending" {{ $Model->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $Model->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $Model->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div id="rejectionReasonsWrapper" class="mb-3" style="display: {{ $Model->status == 'rejected' ? 'block' : 'none' }};">
                            <div class="p-3 rounded bg-soft-danger border border-danger border-opacity-10">
                                <h6 class="extra-small fw-bold text-danger text-uppercase mb-3 border-bottom pb-2">حدد الحقل وسبب الرفض:</h6>
                                
                                @php
                                    $reasons = \Modules\RejectReasons\Entities\Model::all(); 
                                @endphp

                                @foreach($reasons as $reason)
                            @php 
                                $pivotData = $Model->rejectionReasons->where('id', $reason->id)->first();
                                $isReasonSelected = !is_null($pivotData);
                                $defaultName = app()->getLocale() == 'ar' ? $reason->name_ar : $reason->name_en;
                            @endphp
                            
                            <div class="reason-item mb-4 border-bottom pb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input reason-checkbox" type="checkbox" 
                                        name="reject_reasons[{{ $reason->id }}][id]" 
                                        value="{{ $reason->id }}" 
                                        id="reason_{{ $reason->id }}"
                                        {{ $isReasonSelected ? 'checked' : '' }}>
                                    
                                    <label class="form-check-label fw-bold text-dark small" for="reason_{{ $reason->id }}">
                                        <i class="fas fa-exclamation-circle me-1 text-danger"></i>
                                        {{ strtoupper(str_replace('_', ' ', $reason->key)) }}
                                    </label>
                                </div>

                                <div class="ms-4 mt-2 comment-container" style="display: {{ $isReasonSelected ? 'block' : 'none' }};">
                                    
                                    <div class="d-flex align-items-center mb-2 p-2 bg-light rounded border shadow-xs">
                                        <div class="flex-grow-1">
                                            <span class="extra-small text-muted d-block">السبب الجاهز (Default):</span>
                                            <span class="small fw-500 text-primary">{{ $defaultName }}</span>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input use-default-check" type="checkbox" 
                                                id="use_default_{{ $reason->id }}" 
                                                {{ empty($pivotData->pivot->custom_comment) ? 'checked' : '' }}>
                                            <label class="extra-small text-muted mb-0" for="use_default_{{ $reason->id }}">استخدام هذا السبب</label>
                                        </div>
                                    </div>

                                    <div class="custom-comment-area {{ empty($pivotData->pivot->custom_comment) && $isReasonSelected ? 'd-none' : '' }}">
                                        <label class="extra-small text-muted mb-1">أو اكتب سبباً مخصصاً هنا:</label>
                                        <input type="text" 
                                            name="reject_reasons[{{ $reason->id }}][comment]" 
                                            class="form-control form-control-sm border-danger border-opacity-25 custom-input" 
                                            placeholder="مثلاً: البيانات غير مطابقة للصورة..."
                                            value="{{ $pivotData->pivot->custom_comment ?? '' }}"
                                            {{ empty($pivotData->pivot->custom_comment) && !$isReasonSelected ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow-sm py-2 fw-bold">
                            <i class="fas fa-save me-1"></i> {{ __('trans.Submit') }}
                        </button>
                    </div>
                </div>
            </div>

<div class="col-lg-8">

    {{-- Personal Information --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 text-primary fw-bold">
                <i class="fas fa-user-circle me-2"></i>{{ __('trans.Personal Information') }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small text-muted">{{ __('trans.phone') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-phone text-muted"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0" 
                               value="{{ $Model->phone }}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label small text-muted">{{ __('trans.email') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-envelope text-muted"></i>
                        </span>
                        <input type="email" class="form-control bg-light border-start-0" 
                               value="{{ $Model->email }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Legal Profile --}}
    @if($Model->legalProfile)
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-primary fw-bold">
                <i class="fas fa-balance-scale me-2"></i>Legal Profile
            </h6>
            <span class="badge bg-soft-info text-info border border-info px-3">
                {{ $Model->legalProfile?->year_of_experiance?->title ?? '---' }} Years Exp.
            </span>
        </div>
        <div class="card-body">
            <div class="row g-3">

                {{-- Bar & Sub Association --}}
                <div class="col-md-6">
                    <label class="form-label small text-muted">@lang('trans.bar_association')</label>
                    <input type="text" class="form-control bg-light" 
                           value="{{ $lang == 'ar' ? $Model->legalProfile->barAssociation->name_ar : $Model->legalProfile->barAssociation->name_en ?? 'N/A' }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label small text-muted">@lang('trans.sub_association')</label>
                    <input type="text" class="form-control bg-light" 
                           value="{{ $lang == 'ar' ? $Model->legalProfile->subAssociation->name_ar : $Model->legalProfile->subAssociation->name_en ?? 'N/A' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label small text-muted">Registration Number</label>
                    <input type="text" class="form-control bg-light" 
                           value="{{ $Model->legalProfile->registration_number }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label small text-muted">Consultation Price</label>
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-end-0" 
                               value="{{ $Model->legalProfile->consultation_price }}" disabled>
                        <span class="input-group-text bg-light border-start-0 small fw-bold">
                            {{ setting('currency') }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label small text-muted">Registration Date</label>
                    <input type="text" class="form-control bg-light" 
                           value="{{ $Model->legalProfile->registration_date }}" disabled>
                </div>

                {{-- Expertises --}}
                <div class="col-md-6">
                    <label class="form-label small text-muted d-block">@lang('trans.expertises')</label>
                    @forelse($Model->legalProfile->expertises as $expertise)
                        <span class="badge bg-soft-primary text-primary border border-primary border-opacity-25 me-1 mb-1">
                            {{ $lang == 'ar' ? $expertise->name_ar : $expertise->name_en ?? 'N/A' }}
                        </span>
                    @empty
                        <span class="text-muted small">---</span>
                    @endforelse
                </div>

                {{-- Work Areas --}}
                <div class="col-md-6">
                    <label class="form-label small text-muted d-block">@lang('trans.work_areas')</label>
                    @forelse($Model->legalProfile->workAreas as $area)
                        <span class="badge bg-soft-info text-info border border-info border-opacity-25 me-1 mb-1">
                            {{ $area->title }}
                        </span>
                    @empty
                        <span class="text-muted small">---</span>
                    @endforelse
                </div>
                {{--Languages --}}
                <div class="col-md-6">
                    <label class="form-label small text-muted d-block">@lang('trans.Languages')</label>
                    @forelse($Model->legalProfile->languages as $languages)
                        <span class="badge bg-soft-info text-info border border-info border-opacity-25 me-1 mb-1">
                            {{$lang == 'ar' ? $languages->name_ar : $languages->name_en ?? 'N/A' }}
                        </span>
                    @empty
                        <span class="text-muted small">---</span>
                    @endforelse
                </div>

                {{-- Bio --}}
                <div class="col-12">
                    <label class="form-label small text-muted">Bio / Summary</label>
                    <div class="p-3 bg-light rounded text-dark" 
                         style="min-height: 80px; border: 1px solid #eee; font-size: 0.9rem;">
                        {{ $Model->legalProfile->summary }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

    {{-- Qualifications Table --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 text-primary fw-bold">
                <i class="fas fa-graduation-cap me-2"></i>@lang('trans.qualifications')
            </h6>
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
                                <td class="ps-4 fw-bold text-dark">
                                    {{$lang == 'ar' ? $qual->degreeType->name_ar : $qual->degreeType->name_en ?? '---' }}
                                </td>
                                <td>{{ $lang == 'ar' ? $qual->university->name_ar : $qual->university->name_en ?? '---' }}</td>
                                <td>
                                    <span class="badge bg-secondary opacity-75">{{ $qual->year }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">
                                    @lang('trans.no_qualifications')
                                </td>
                            </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Documents --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 text-primary fw-bold">
                <i class="fas fa-id-card me-2"></i>@lang('trans.documents')
            </h6>
        </div>
        <div class="card-body">

            {{-- ID Card --}}
            <h6 class="text-muted fw-bold small text-uppercase mb-3">@lang('trans.id_card')</h6>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <div class="document-box text-center p-3 border rounded bg-light">
                        <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.id_card_front')</label>
                        @if($Model->cardId && $Model->cardId->front_id_card)
                            <a href="{{ asset($Model->cardId->front_id_card) }}" target="_blank">
                                <img src="{{ asset($Model->cardId->front_id_card) }}" 
                                     class="img-fluid rounded border shadow-sm hover-zoom" 
                                     style="max-height: 180px;">
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
                                <img src="{{ asset($Model->cardId->back_id_card) }}" 
                                     class="img-fluid rounded border shadow-sm hover-zoom" 
                                     style="max-height: 180px;">
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

            {{-- Legal Card --}}
            <h6 class="text-muted fw-bold small text-uppercase mb-3">@lang('trans.legal_card')</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="document-box text-center p-3 border rounded bg-light">
                        <label class="text-muted small d-block mb-3 fw-bold">@lang('trans.legal_card_front')</label>
                        @if($Model->LegalCardId && $Model->LegalCardId->front_legal_card)
                            <a href="{{ asset($Model->LegalCardId->front_legal_card) }}" target="_blank">
                                <img src="{{ asset($Model->LegalCardId->front_legal_card) }}" 
                                     class="img-fluid rounded border shadow-sm hover-zoom" 
                                     style="max-height: 180px;">
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
                                <img src="{{ asset($Model->LegalCardId->back_legal_card) }}" 
                                     class="img-fluid rounded border shadow-sm hover-zoom" 
                                     style="max-height: 180px;">
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
    </form>
</div>

<style>
    .logo-container { width: 150px; height: 150px; border-radius: 50%; background-color: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .profile-logo { width: 85%; height: 85%; object-fit: contain; }
    .card { border-radius: 15px; border: none; }
    .card-header { border-bottom: 1px solid #f8f9fa; }
    .extra-small { font-size: 0.7rem; }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.08); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.05); }
    .form-control:disabled { background-color: #fcfcfc !important; opacity: 1; border-color: #eee; color: #555; }
    .document-link { display: block; overflow: hidden; border-radius: 8px; }
    .hover-zoom { transition: transform 0.3s ease; height: 120px; width: 100%; object-fit: cover; }
    .hover-zoom:hover { transform: scale(1.05); border-color: #0d6efd !important; }
    .fw-500 { font-weight: 500; }
    .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .comment-container input { font-size: 12px; }
    .border-dashed { border: 2px dashed #e3e6f0 !important; }
.bg-soft-primary { background-color: rgba(78, 115, 223, 0.1) !important; }
.document-box { transition: box-shadow 0.2s; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('statusSelect');
        const rejectionWrapper = document.getElementById('rejectionReasonsWrapper');

        // إظهار/إخفاء قسم الرفض
        statusSelect.addEventListener('change', function () {
            rejectionWrapper.style.display = (this.value === 'rejected') ? 'block' : 'none';
        });

        // عند اختيار الـ Key الأساسي
        document.querySelectorAll('.reason-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const container = this.closest('.reason-item').querySelector('.comment-container');
                const input = container.querySelector('.custom-input');
                if (this.checked) {
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                    input.value = ''; 
                }
            });
        });

        // التبديل بين "السبب الجاهز" و "الكتابة اليدوية"
        document.querySelectorAll('.use-default-check').forEach(check => {
            check.addEventListener('change', function () {
                const customArea = this.closest('.comment-container').querySelector('.custom-comment-area');
                const input = customArea.querySelector('.custom-input');
                
                if (this.checked) {
                    customArea.classList.add('d-none');
                    input.value = '';
                    input.disabled = true;
                } else {
                    customArea.classList.remove('d-none');
                    input.disabled = false;
                    input.focus();
                }
            });
        });
    });
</script>
@endsection