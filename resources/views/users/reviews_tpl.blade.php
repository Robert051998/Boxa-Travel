@extends('template')
@section('main')
<main>
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
            <div class="container-fluid inner-content">
				<div class="row m-0 mb-3">
					<div class="col-12 p-0">
						<div class="d-flex justify-content-between align-items-center">
							<h4 class="m-0">{{ trans('messages.reviews.reviews_about_you') }}</h4>
						</div>
					</div>
				</div>
				<div class="row m-0 inner-Bookings">
					<div class="col-12 p-0">	
						@if($reviewsAboutYou->count())
						@for($i=0; $i<$reviewsAboutYou->count(); $i++)
						@if(!$reviewsAboutYou[$i]->hidden_review)
						<div class="d-flex justify-content-between align-items-center booking-details">
							<div class="booking-info">
								<div class="booking-info-img">
									<a href="{{ url('/') }}/properties/{{$reviewsAboutYou[$i]->properties->slug}}">
										<img class="img-fluid" src="{{ $reviewsAboutYou[$i]->properties->cover_photo }}" alt="{{ $reviewsAboutYou[$i]->properties->name }}">
									</a>
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-center booking-info-text">
								<div class="mr-3">
                                    <h4 class="">
										<a href="{{ url('/') }}/properties/{{$reviewsAboutYou[$i]->properties->slug}}">
											{{ $reviewsAboutYou[$i]->properties->name }}
										</a>
									</h4>
									<span class="d-flex align-items-center">
										<i class="fas fa-exclamation-triangle  text-warning mr-2"></i> 
										{{ str_limit($reviewsAboutYou[$i]->message, 210)  }}
									</span>
									<span class="d-flex align-items-center">
										<img src="{{URL::to('images/clock.svg')}}" alt="Clock" class="mr-2" /> {{ $reviewsAboutYou[$i]->created_at->diffForHumans() }}
									</span>
									<button class="btn btn-outline-danger m-0 review_detials" data-name="{{ $reviewsAboutYou[$i]->properties->name }}" data-toggle="modal"  data-id="{{ $reviewsAboutYou[$i]->id }}" data-target="#myModal">
										{{ trans('messages.reviews.view_details') }}
									</button>
								</div>
								<div class="status text-center">
									<a href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->users->id }}">
										<div class="user-details">
											<div class="user-img">
												<img src="{{ $reviewsAboutYou[$i]->users->profile_src }}" alt="{{ $reviewsAboutYou[$i]->users->first_name }}" class="">
											</div>
											<div class="user-name mt-2">
												{{ $reviewsAboutYou[$i]->users->first_name }}
											</div>
										</div>
									</a>
								</div>
							</div>								
						</div>
						@else
						<div class="d-flex justify-content-between align-items-center booking-details">
							<div class="booking-info">
								<div class="booking-info-img">
									<a href="{{ url('/') }}/properties/{{$reviewsAboutYou[$i]->properties->slug}}">
										<img class="img-fluid" src="{{ $reviewsAboutYou[$i]->properties->cover_photo }}" alt="img">
									</a>
								</div>
							</div>

							<div class="d-flex justify-content-between align-items-center booking-info-text">
								<div class="mr-3">
									<h4 class="">
										<a href="{{ url('/') }}/properties/{{$reviewsAboutYou[$i]->properties->slug}}">
											{{ $reviewsAboutYou[$i]->properties->name }}
										</a>
									</h4>
									<span class="d-flex">
										<img src="{{URL::to('images/alert.svg')}}" alt="Alert" class="mr-2" />
										{{ trans('messages.reviews.review_is_hidden') }}. {{ trans('messages.reviews.pls_complete_your_part') }}
									</span>
									<a href="{{ url('/') }}/reviews/edit/{{ $reviewsAboutYou[$i]->booking_id }}" class="btn btn-outline-danger m-0">
										{{ trans('messages.reviews.complete_review') }}
									</a>
									<span class="d-flex">
										<i class="far fa-clock mr-2"></i> 
										{{ $reviewsAboutYou[$i]->created_at->diffForHumans() }}
									</span>
								</div>
								<div class="status text-center">
									<a href="{{ url('/') }}/users/show/{{ $reviewsAboutYou[$i]->sender_id }}">
										<div class="user-details">
											<div class="user-img">
												<img src="{{ $reviewsAboutYou[$i]->users->profile_src }}" alt="{{ $reviewsAboutYou[$i]->users->first_name }}">
											</div>
											<div class="user-name mt-2">{{ $reviewsAboutYou[$i]->users->first_name }}</div>
										</div>
									</a>
								</div>
							</div>
						</div>
						@endif
						@endfor
						@else
							<div class="row jutify-content-center w-100 p-4 mt-4">
								<div class="text-center w-100">
									<img src="{{ url('img/unnamed.png')}}" class="img-fluid"  alt="notfound">
									<p class="text-center fs-6">{{ trans('messages.reviews.no_review') }}</p>
								</div>
							</div>
						@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal calender_modal" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-4">
			<div class="modal-header">
				<h5 class="modal-title" id="name" >Property </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body p-4">
				<div id="heading">
				</div>
			</div>

			<div class="modal-footer ">
				<pre> </pre>
			</div>
		</div>
	</div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
	$(document).on('click', '.review_detials', function(){
		var id = $(this).data("id");
		var name = $(this).data("name");
		$('#name').html(name);
		var dataURL = APP_URL+'/reviews/details';
		$.ajax({
			url: dataURL,
			data:{
				"_token": "{{ csrf_token() }}",
				'id':id,
			},
			type: 'post',
			dataType: 'text',
			success: function(data) {
				$('#heading').html(data);          
			}
		})
	});
</script>
@endpush