@extends(ucfirst(activeGuard()).'.layout')
@section('pagetitle', __('trans.admins'))

@section('content')

<form action="{{ route(activeGuard().'.admins.update',$Model) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="text-center">
        <img src="{{ asset($Model->image ?? setting('logo')) }}" class="rounded mx-auto text-center"  id="image" style="max-width: 100%;max-height: 200px"   >
    </div>
    <div class="row">
        <div class="col-md-6 ">
            <label for="name">{{ __('trans.name') }}</label>
            <input type="text" name="name" value="{{ old('name',$Model->name) }}" required id="name" class="form-control">
        </div>
        <div class="col-md-6 ">
            <label for="short_name">{{ __('trans.short_name') }}</label>
            <input type="text" name="short_name" value="{{ old('short_name',$Model->short_name) }}" id="short_name" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="phone">{{ __('trans.phone') }}</label>
            @include('phone-select',['country_code'=>$Model->country_code])
        </div>
        <div class="col-md-6">
            <label for="email">{{ __('trans.email') }}</label>
            <input  class="form-control w-100" type="text" name="email" value="{{ old('email',$Model->email) }}">
        </div>
        <div class="col-md-6">
            <label for="client_password">{{ __('trans.password') }}</label>
            <input  class="form-control w-100" type="password" name="password">
        </div>
        <div class="col-md-6">
            <label for="password_confirmation">{{ __('trans.confirmPassword') }}</label>
            <input  class="form-control w-100" type="password" name="password_confirmation">
        </div>
        <div class="col-md-6 ">
            <label for="cpr">{{ __('trans.cpr') }}</label>
            <input type="text" value="{{ old('cpr',$Model->cpr) }}" name="cpr" id="cpr" class="form-control">
        </div>
        <div class="col-md-6 ">
            <label for="accent">{{ __('trans.accent') }}</label>
            <input type="text" value="{{ old('accent',$Model->accent) }}" name="accent" id="accent" class="form-control">
        </div>
        <div class="col-md-6 ">
            <label for="birthdate">{{ __('trans.birthdate') }}</label>
            <input type="date" value="{{ old('birthdate',$Model->birthdate) }}" name="birthdate" id="birthdate" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="gender">@lang('trans.gender')</label>
            <select class="form-control" id="gender" name="gender">
                <option selected hidden disabled>-------</option>
                <option @selected($Model->gender == 'M') value="M">@lang('trans.male')</option>
                <option @selected($Model->gender == 'F') value="F">@lang('trans.female')</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="image">{{ __('trans.image') }}</label>
            <input class="form-control w-100" id="image" type="file" name="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="col-md-6">
            <label for="visibility">@lang('trans.visibility')</label>
            <select class="form-control" id="visibility" name="status">
                <option @selected($Model->status == '1') selected value="1">@lang('trans.visible')</option>
                <option @selected($Model->status == '0') value="0">@lang('trans.hidden')</option>
            </select>
        </div>
        <div class="col-md-6 ">
            <label for="bio">{{ __('trans.bio') }}</label>
            <textarea name="bio" id="" cols="5" rows="5" class="form-control">{{ old('bio',$Model->cpr) }}</textarea>
        </div>
       
        <div class="col-12 my-4">
            <div class="button-group my-4 text-center">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
