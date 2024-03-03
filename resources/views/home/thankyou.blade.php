@extends('template',['title'=>'Thank You'])
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('js/intl-tel-input-13.0.0/build/css/intlTelInput.min.css')}}">
@endpush
@section('main')
<div class="container p-0">
	<div class="row inner-row">
		<div class="col-4 text-center">
			<h1 class="mb-0"><span>{{trans('messages.home.find')}}</span> {{trans('messages.home.perfect')}}</h1>
		</div>
		<div class="col-8 mt-5 mb-5">
			<div class="d-flex w-100 justify-content-between  mb-5">
				<a aria-label="logo" href="{{ url('/') }}">
					<img src="{{URL::to('images/BoxaTravelLogo.svg')}}" alt="logo" class="img-fluid">
				</a>
				<div class="d-flex align-items-center">
					<span class="already">{{trans('messages.home.already')}}</span>
					<a href="{{URL::to('/')}}/login" class="btn btn-secondary ml-2" onClick="disconnectWallet()">{{trans('messages.header.login')}}</a>
				</div>
			</div>
			<div class="login_form thankyou">
				<h3 class="text-success mb-4">{{trans('messages.success.thankyou')}}</h3>	
				<div class="height-space"></div>			
				<hr class="mt-3 mb-3"/>
				<div class="text-center fs-6">
					{{trans('messages.home.rights')}}. <br>Copyright – 2023 Boxa Travel LLC.
				</div>
			</div>
		</div>
	</div>
</div>
@stop

