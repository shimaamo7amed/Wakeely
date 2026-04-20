@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.faq'))
@section('content')
<form method="POST" action="{{ route(activeGuard().'.faq.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="question_ar">@lang('trans.question_ar')</label>
            <input id="question_ar" type="text" name="title_ar" required placeholder="@lang('trans.question_ar')" class="form-control" value="{{ $Model['question_ar'] }}">
        </div>
        <div class="col-md-6">
            <label for="question_en">@lang('trans.question_en')</label>
            <input id="question_en" type="text" name="title_en" required placeholder="@lang('trans.question_en')" class="form-control" value="{{ $Model['question_en'] }}">
        </div>
        <div class="col-md-6">
            <label for="answer_ar">@lang('trans.answer_ar')</label>
            <input id="answer_ar" type="text" name="answer_ar" required placeholder="@lang('trans.answer_ar')" class="form-control" value="{{ $Model['answer_ar'] }}">
        </div>
        <div class="col-md-6">
            <label for="answer_en">@lang('trans.answer_en')</label>
            <input id="answer_en" type="text" name="answer_en" required placeholder="@lang('trans.answer_en')" class="form-control" value="{{ $Model['answer_en'] }}">
        </div>
      
        
        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
