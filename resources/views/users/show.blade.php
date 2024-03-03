@extends('template')
@section('main')
<main class="listing_detail">
	<div class="container-fluid user-profile p-0 mb-5">
		<div class="row">
			<div class="col-md-3">
				<div class="row listing-info m-0">
					<div class="col-md-12 p-0 text-center mb-3">
						<img src="{{ $result->profile_src }}" title="{{ $result->first_name }}" class="img-fluid " alt="{{ $result->first_name }}" >
					</div>
					<div class="col-md-12 text-center p-0 status">
						@if($result->id == Auth::user()->id )
							@if((Auth::user()->users_verification->email == 'no') || (Auth::user()->users_verification->facebook == 'no') || (Auth::user()->users_verification->google == 'no'))
								<a href="{{ url('users/edit-verification') }}">
									<button  class="btn vbtn-outline-success mb-4">{{trans('messages.users_dashboard.complete_profile')}}</button>
								</a>
							@else
								<i class="fa fa-check-circle fa-3x text-success" aria-hidden="true"></i>
							@endif
						@endif
						<div class="identity_details d-none">
							<h4 class="d-flex align-items-center w-100 mb-3"><span class="Accepted mr-3">({{ $reviews_count }})</span>{{trans('messages.users_dashboard.identity_verified')}} </h4>  
							@if(($result->users_verification->email == 'yes') || ($result->users_verification->facebook == 'yes') || ($result->users_verification->google == 'yes'))
								<h4 class="d-flex align-items-center w-100"> 
									<span class="Accepted mr-3"><i class="fas fa-check-double"></i></span>Identity Verified
								</h4>
							@else
								<h4 class="d-flex align-items-center w-100">
									<span class="Expired mr-3"><i class="fa fa-times "></i></span>{{trans('messages.users_dashboard.identity_unverified')}}
								</h4>
							@endif
						</div>
						<hr class="mt-4 mb-4">
					</div>
					
					<div class="col-md-12 text-center p-0">
						<h2 class="mb-3">{{ ucfirst($result->first_name) }} {{ trans('messages.users_dashboard.confirmed') }}</h2>
						<ul class="profile-detial d-flex align-items-center justify-content-center m-0 p-0">
							<li><i class="{{ ($result->users_verification->email == 'yes') ? 'fa fa-envelope' : 'fa fa-envelope' }} "></i> <!--{{ trans('messages.login.email') }}--></li>
							<li><i class="{{ ($result->users_verification->facebook == 'yes') ? 'fab fa-facebook-f' : 'fab fa-facebook-f' }} "></i><!--{{ trans('messages.sign_up.facebook') }} --></li>
							<li><i class="{{ ($result->users_verification->google == 'yes') ? 'fab fa-google' : 'fab fa-google' }} "></i><!--{ trans('messages.sign_up.google') }}--></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 right-sidebar">
				<div class="row m-0">
					<div class="col-md-12 p-0">
						<h2 class="mb-3">{{trans('messages.users_show.hey')}} {{ucfirst($result->first_name)}}!</h2>
						@if(isset($details['live']))
							<p class="mb-3"><i class="fas fa-home mr-2"></i>Lives in {{ $details['live'] }}</p>
						@endif
						<h4>{{trans('messages.users_show.member_since')}} {{ $result->account_since }}</h4>
						<hr class="mt-4 mb-4">
						@if(isset($details['about']))
							<h5 class="mb-2">{{trans('messages.users_dashboard.about')}}</h5>
							<p class="fs-6 mb-3">{{$details['about']}}</p>
						@endif
					</div>
				</div>

				<div class="row m-0">
					<div class="col-md-12 p-0">
						<div class="pro-results mb-5">
							{{trans('messages.sidenav.reviews')}} ({{ $reviews_count }})
						</div>
						@if($reviews_from_guests->count() > 0 && $reviews_from_hosts->count() > 0 )
							<ul class="nav navbar-expand-lg navbar-light list-bacground border rounded-3 p-3 mb-5" role="tablist">
								<li class="nav-item">
									<a class="nav-link active secondary-text-color text-color-hover" data-toggle="tab" href="#tabs-1" role="tab">{{trans('messages.users_show.review_guest')}}</a>
								</li>
								<li class="nav-item">
									<a class="nav-link secondary-text-color text-color-hover" data-toggle="tab" href="#tabs-2" role="tab">{{trans('messages.users_show.review_host')}}</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="row m-0 inner-Bookings">
                                        <div class="col-md-12 p-0">
											@foreach($reviews_from_guests as $row_host) 
												@include('users.review_list')
											@endforeach
										</div>
									</div>
								</div>

								<div class="tab-pane" id="tabs-2" role="tabpanel">
									@foreach($reviews_from_hosts as $row_host) 
										@include('users.review_list')
									@endforeach
								</div>
							</div>  
							@elseif($reviews_from_guests->count() > 0)
							@foreach($reviews_from_guests as $row_host) 
								@include('users.review_list')
							@endforeach
							@elseif($reviews_from_hosts->count() > 0)
							@foreach($reviews_from_hosts as $row_host) 
								@include('users.review_list')
							@endforeach
						@endif
					</div>
				</div>
			</div> 
		</div>
	</div>
	<section class="listing m-0">
        <div class="container-fluid p-0">
			@if(!$users_properties->isEmpty())
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-5">{{trans('messages.property_single.user_list')}}</h3>
                </div>
            </div>
            <div class="row">
                @foreach($users_properties->slice(0, 8) as $row_similar)
                    @include('property.preview', ['property' => $row_similar])
                @endforeach
            </div>
            @endif
        </div>
    </section> 
</main>
@stop

@push('scripts')
<script type="text/javascript">
	$("#profile-review-count").on('click', function(e){
		e.preventDefault()
		$('html,body').animate({
			scrollTop: $("#profile-review-title").offset().top},
			'slow');
	});
</script>
@endpush