@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.terms'))

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary"><i class="fas fa-file-contract me-2"></i> {{ __('trans.term_details') }}</h5>
            <a href="{{ route(activeGuard().'.terms.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-right"></i> {{ __('trans.back') }}
            </a>
        </div>
        
        <div class="card-body">
            <ul class="nav nav-pills mb-4 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-ar-tab" data-bs-toggle="pill" data-bs-target="#pills-ar" type="button" role="tab">العربية</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-en-tab" data-bs-toggle="pill" data-bs-target="#pills-en" type="button" role="tab">English</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-ar" role="tabpanel" dir="rtl">
                    <div class="p-3 border rounded bg-light">
                        <h4 class="mb-3 border-bottom pb-2 text-dark">{{ $Model->title_ar }}</h4>
                        <div class="content-text" style="line-height: 1.8; color: #444;">
                            {!! $Model->content_ar !!}
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-en" role="tabpanel" dir="ltr">
                    <div class="p-3 border rounded bg-light text-start">
                        <h4 class="mb-3 border-bottom pb-2 text-dark">{{ $Model->title_en }}</h4>
                        <div class="content-text" style="line-height: 1.8; color: #444;">
                            {!! $Model->content_en !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white text-muted small">
            <i class="fas fa-sort-numeric-down me-1"></i> {{ __('trans.arrangement') }}: {{ $Model->arrangement }}
        </div>
    </div>
</div>

<style>
    /* تنسيق خاص للقوائم عشان تظهر بشكل احترافي داخل الـ Card */
    .content-text ul {
        list-style: disc;
        padding-right: 25px;
        margin-top: 15px;
    }
    .content-text li {
        margin-bottom: 8px;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd; /* غيري اللون حسب هوية وكيلي */
    }
    .nav-pills .nav-link {
        color: #666;
        border: 1px solid #dee2e6;
        margin: 0 5px;
    }
</style>
@endsection