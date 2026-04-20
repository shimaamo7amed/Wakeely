@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.governorates'))
@section('content')
<form method="POST" action="{{ route(activeGuard().'.governorates.update',$Governorate->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="name_en">@lang('trans.name_en')</label>
            <input type="text" name="name_en" id="name_en" class="form-control" required value="{{ $Governorate->name_en }}">
        </div>
        <div class="col-md-6">
            <label for="name_ar">@lang('trans.name_ar')</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" required value="{{ $Governorate->name_ar }}">
        </div>
        <div class="col-md-6">
            <label for="country_id">@lang('trans.country')</label>
            <select class="form-control" required id="country_id" name="country_id">
                @foreach ($countries as $country)
                    <option {{ $Governorate->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->title }}</option>
                @endforeach
            </select>
        </div>
        
       
        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
