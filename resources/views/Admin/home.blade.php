@extends('Admin.layout')
@section('pagetitle',__('trans.dashboardTitle'))

@section('content')

<div class="">
	<div class="row">
    		<div class="col-lg-3 col-md-4 col-sm-6" style="margin-top: 20px">
    			<div class="card border-rosy">
    				<div class="card-body bg-rosy text-white">
    					<div class="row">
    						<div class="col-3 justify-content-center align-items-center d-flex">
    							<i class="fa-solid fa-user-gear fa-2x"></i>
    						</div>
    						<div class="col-9 text-right text-white">
    							<h1>{{ $adminsCount }}</h1>
    							<h4>@lang('trans.admins')</h4>
    						</div>
    					</div>
    				</div>
    				<a href="{{ route(activeGuard() . '.admins.index') }}">
    					<div class="card-footer bg-light text-dark">
    						<span class="float-left">@lang('trans.View Details')</span>
    						<span class="float-right"><i class="fa fa-arrow-circle-{{ lang('en') ? 'right' : 'left' }}"></i></span>
    					</div>
    				</a>
    			</div>
    		</div>
	</div>
</div>

                
@endsection

@push('css')
    <style>
        .text-white h1,
        .text-white h4{
            color: white;
        }
        
        .border-rosy{
            border-color: #8b1531 !important;
            height: 100%;
        }
        .bg-rosy {
            background-color: #8b1531 !important;
        }
        
        .border-goldenrod{
            border-color: #f3e662 !important;
            height: 100%;
        }
        .bg-goldenrod {
            background-color: #f3e662 !important;
        }
        
        .border-skyblue{
            border-color: #60c3cd !important;
            height: 100%;
        }
        .bg-skyblue {
            background-color: #60c3cd !important;
        }
    </style>
@endpush



