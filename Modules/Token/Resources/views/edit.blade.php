@extends(ucfirst(activeGuard()).'.'.layout())
@section('pagetitle',  __('trans.clients'))
@section('content')

<form action="{{ route(activeGuard().'.clients.update',$Model) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="text-center">
        <img src="{{ asset($Model->image ?? setting('logo')) }}" class="rounded mx-auto text-center"  id="image"  height="200px">
    </div>
    <div class="row">
        <div class="col-12"></div>
        <div class="col-md-6 ">
            <label for="name">{{ __('trans.name') }}</label>
            <input value="{{ $Model->name }}" type="text" name="name" id="name" parsley-trigger="change" required value="" class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="email">{{ __('trans.email') }}</label>
            <input value="{{ $Model->email }}" type="email" name="email" parsley-trigger="change" value="" required class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="phone">{{ __('trans.phone') }}</label>
            <input type="hidden" class="phone_code" name="phone_code" id="phone_code" name="phone_code" value="{{ $Model->phone_code }}">
            <input type="hidden" class="country_code" name="country_code" id="country_code" name="country_code" value="{{ $Model->country_code }}">
            <input type="tel" class="form-control border-0 border-bottom rounded-0 phone" name="phone" id="phone" required value="{{ $Model->phone }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="password">{{ __('trans.password') }}</label>
            <input type="password" name="password" id="password" parsley-trigger="change" class="form-control" data-parsley-id="10">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="file">{{ __('trans.image') }}</label>
            <input class="form-control w-100" id="file" type="file" name="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
        </div>
        
        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>

@include('phone',['country_code'=>$Model->country_code])
@endsection
