@extends(ucfirst(activeGuard()).'.layout')

@section('pagetitle', __('trans.faq'))

@section('content')

<form method="POST" action="{{ route(activeGuard().'.faq.store') }}">
    @csrf

    <div class="row">

        {{-- question_ar --}}
        <div class="col-md-6">
            <label for="question_ar">@lang('trans.question_ar')</label>
            <input
                id="question_ar"
                type="text"
                name="question_ar"
                required
                placeholder="@lang('trans.question_ar')"
                class="form-control"
            >
        </div>

        {{-- question_en --}}
        <div class="col-md-6">
            <label for="question_en">@lang('trans.question_en')</label>
            <input
                id="question_en"
                type="text"
                name="question_en"
                required
                placeholder="@lang('trans.question_en')"
                class="form-control"
            >
        </div>
        {{-- answer_ar --}}
        <div class="col-md-6">
            <label for="answer_ar">@lang('trans.answer_ar')</label>
            <input
                id="answer_ar"
                type="text"
                name="answer_ar"
                required
                placeholder="@lang('trans.answer_ar')"
                class="form-control"
            >
        </div>

        {{-- answer_en --}}
        <div class="col-md-6">
            <label for="answer_en">@lang('trans.answer_en')</label>
            <input
                id="answer_en"
                type="text"
                name="answer_en"
                required
                placeholder="@lang('trans.answer_en')"
                class="form-control"
            >
        </div>


        {{-- buttons --}}
        <div class="col-sm-12 my-4">
            <div class="text-center p-20">

                <button type="submit" class="main-btn">
                    {{ __('trans.add') }}
                </button>

                <button type="reset" class="btn btn-secondary">
                    {{ __('trans.cancel') }}
                </button>

            </div>
        </div>

    </div>

</form>

@endsection