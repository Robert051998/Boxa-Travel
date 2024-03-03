@extends('template')
@section('main')
<main>
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
			<div class="container-fluid inner-content">
				<div class="row mb-3">
					<div class="col-12">
						<h4 class="mb-4">Profile Verification </h4>
					</div>
					<div class="col-md-12">
						@include('users.profile_nav')
						<!--Success Message -->
						@if(Session::has('message'))
							<div class="row mt-5 m-0">
								<div class="col-md-12 alert {{ Session::get('alert-class') }} alert-dismissable m-0">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									{{ Session::get('message') }}
								</div>
							</div>
						@endif 
					</div>
				</div>
				<div class="row justify-content-center mt-5">
					<div class="col-md-12">
						<h4 class="mb-4">{{ trans('messages.profile.current_verifications') }}</h4>
						<div class="">
							<ul class="list-layout edit-verifications-list">
								@if((Auth::user()->users_verification->email == 'no') && (Auth::user()->users_verification->facebook == 'no') && (Auth::user()->users_verification->google == 'no'))
									<div class="alert alert-success mt-3" role="alert">
										No Verification Available
									</div>
								@else
									@if(Auth::user()->users_verification->email == 'yes')
									<li class="edit-verifications-list-item border p-3 mb-4">
										<div class="d-flex justify-content-between align-items-center verfi">
											<div class="mr-3">
												<h5 class="mb-2">{{ trans('messages.users_dashboard.email_address') }}</h5>
												<p class="fs-6">{{ trans('messages.profile.you_have_confirmed_email') }} <b>{{ Auth::user()->email }}</b>.</p>
											</div>
										</div>
									</li>
									@endif
									<!--@if(Auth::user()->users_verification->facebook == 'yes')
									<li class="edit-verifications-list-item border p-3 mb-4">
										<div class="d-flex justify-content-between align-items-center verfi">
											<div class="mr-3">
												<h5 class="mb-2">Facebook</h5>
												<p class="fs-6">{{ trans('messages.profile.facebook_verification') }}</p>
											</div>
											<div class="disconnect-button-container">
												<a href="{{ url('facebookDisconnect') }}" class="btn vbtn-outline-success m-0 btn-block" data-method="post" rel="nofollow">{{ trans('messages.profile.disconnect') }}</a>
											</div>
										</div>
									</li>
									@endif-->
									@if(Auth::user()->users_verification->google == 'yes')
									<li class="edit-verifications-list-item border p-3 mb-4">
										<div class="d-flex justify-content-between align-items-center verfi">
											<div class="mr-3">
												<h5 class="mb-2">Google</h5>
												<p class="fs-6">{{ trans('messages.profile.google_verification', ['site_name'=>$site_name]) }}</p>
											</div>
											<div class="disconnect-button-container">
												<a href="{{ url('googleDisconnect') }}" class="btn vbtn-outline-success m-0 btn-block" data-method="post" rel="nofollow">{{ trans('messages.profile.disconnect') }}</a>
											</div>
										</div>
									</li>
									@endif
								@endif
							</ul>
						</div>
					</div>


					<div class="col-md-12 mt-4 mb-5">
						@if(!(Auth::user()->users_verification->email == 'yes' && Auth::user()->users_verification->facebook == 'yes' && Auth::user()->users_verification->google == 'yes'))
							<h4 class="mb-4">{{ trans('messages.profile.add_more_verifications') }}</h4>
							<ul>
							@if(Auth::user()->users_verification->email == 'no')
								<li class="border p-3 mb-4">
									<div class="d-flex justify-content-between align-items-center verfi">
										<div class="mr-3">
											<h5 class="mb-2">{{ trans('messages.login.email') }}</h5>
											<p class="fs-6">{{ trans('messages.profile.email_verification') }} <b>{{ Auth::user()->email }}</b>.</p>
										</div>
										<a href="{{ url('users/new_email_confirm?redirect=verification') }}">
											<button type="button" class="btn vbtn-outline-success m-0">{{ trans('messages.profile.connect') }}</button>
										</a>
									</div>
								</li>
							@endif

							<!--@if(Auth::user()->users_verification->facebook == 'no')
								<li class="border p-3 mb-4">
									<div class="d-flex justify-content-between align-items-center verfi">
										<div class="mr-3">
											<h5 class="mb-2">{{ trans('messages.sign_up.facebook') }}</h5>
											
										</div>
										<a href="{{ url('facebookLoginVerification') }}">
											<button type="button" class="btn vbtn-outline-success m-0">{{ trans('messages.profile.connect') }}</button>
										</a>
									</div>
								</li>
							@endif-->
							
							@if(Auth::user()->users_verification->google == 'no')
								<li class="border p-3 mb-4">
									<div class="d-flex justify-content-between align-items-center verfi">
										<div class="mr-3">
											<h5 class="mb-2">{{ trans('messages.sign_up.google') }}</h5>
											<p class="fs-6">{{ trans('messages.profile.google_verification', ['site_name'=>$site_name]) }}</b>.</p>
										</div>
										<a href="{{URL::to('googleLoginVerification')}}">
											<button type="button" class="btn vbtn-outline-success m-0">{{ trans('messages.profile.connect') }}</button>
										</a>
									</div>
								</li>
							@endif
							</ul>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
