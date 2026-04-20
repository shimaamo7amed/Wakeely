@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.cities'))
@section('content')

<form method="POST" action="{{ route(activeGuard().'.cities.update', $City->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        {{-- الاسم بالإنجليزية --}}
        <div class="col-md-6">
            <label for="name_en">@lang('trans.name_en')</label>
            <input type="text" name="name_en" id="name_en" class="form-control" required value="{{ old('name_en', $City->name_en) }}">
        </div>

        {{-- الاسم بالعربية --}}
        <div class="col-md-6">
            <label for="name_ar">@lang('trans.name_ar')</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" required value="{{ old('name_ar', $City->name_ar) }}">
        </div>

        {{-- اختيار المحافظة --}}
        <div class="col-md-6">
            <label for="governorate_id">@lang('trans.governorate')</label>
            <select class="form-control" required id="governorate_id" name="governorate_id">
                @foreach ($governorates as $governorate)
                    <option value="{{ $governorate->id }}" {{ $governorate->id == $City->governorate_id ? 'selected' : '' }}>
                        {{ $governorate->name }}
                    </option>
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