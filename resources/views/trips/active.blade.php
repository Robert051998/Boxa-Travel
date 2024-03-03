@extends('template')

@section('main')
<main>
	<div class="row m-0">
		@include('users.sidebar')
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
			<div class="container-fluid inner-content">
				<div class="row m-0 mb-3">
                    <div class="col-12 p-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">{{trans('messages.users_dashboard.my_trips')}}</h4>
                            <div>
								<form action="{{url('/trips/active')}}" method="POST" id="my-trip-form">
									{{ csrf_field() }}
									<select class="form-control room-list-status text-14 minus-mt-6" name="status" id="trip_select">
										<option value="All" {{ $status == "All" ? ' selected="selected"' : '' }}>All</option>
										<option value="Current" {{ $status == "Current" ? ' selected="selected"' : '' }}>Current</option>
										<option value="Upcoming" {{ $status == "Upcoming" ? ' selected="selected"' : '' }}>Upcoming</option>
										<option value="Pending" {{ $status == "Pending" ? ' selected="selected"' : '' }}>Pending</option>
										<option value="Completed" {{ $status == "Completed" ? ' selected="selected"' : '' }}>Completed</option>
										<option value="Expired" {{ $status == "Expired" ? ' selected="selected"' : '' }}>Expired</option>
									</select>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
				@if(Session::has('message'))
				<div class="alert alert-success text-center" role="alert" id="alert">
					<span id="messages">{{ Session::get('message') }}</span>
				</div>
				@endif
				<div class="row m-0 inner-Bookings">
                    <div class="col-12 p-0">
						@forelse($bookings as $booking)
							<?php
								$bookingStatus = $booking->status;
								if ($booking->created_at < $yesterday && $booking->status != 'Accepted') {
									$bookingStatus = 'Expired';
								} elseif($booking->status == 'Pending' && $booking->payment_method_id == 4) {
									$bookingStatus = 'Processing';
								}
							?>
							<div class="d-flex justify-content-between align-items-center booking-details">
                                <div class="booking-info">
                                    <div class="booking-info-img">
										<a href="{{ url('/') }}/properties/{{ $booking->properties->slug }}">
											<img src="{{ $booking->properties->cover_photo }}" alt="{{ $booking->properties->name }}">
										</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center booking-info-text">
                                    <div class="mr-3">
                                        <h4 class="">
											<a href="{{ url('/') }}/properties/{{ $booking->properties->slug}}">
												{{ $booking->properties->name}}
											</a>
                                        </h4>
                                        <span class="d-flex"><img src="{{URL::to('images/Location.svg')}}" alt="Location" class="mr-2" /> {{ $booking->properties->property_address->address_line_1 }}</span>
                                        <span class="d-flex lowercase"><img src="{{URL::to('images/Email.svg')}}" alt="Email" class="mr-2" /> {{ $booking->host->email }}</span>
										@if($booking->host->phone)
                                        	<span class="d-flex"><img src="{{URL::to('images/Phone.svg')}}" alt="Contact Number" class="mr-2" /> {{ $booking->host->formatted_phone }}</span>
										@endif
										<span class="d-flex"><img src="{{URL::to('images/Calendar.svg')}}" alt="Calendar" class="mr-2" /> {{ date(' M d, Y', strtotime($booking->start_date)) }}  -  {{ date(' M d, Y', strtotime($booking->end_date)) }}</span>
										@if($booking->status == 'Accepted')
											<a class="btn btn-outline-danger m-0" href="{{ url('/') }}/booking/receipt?code={{ $booking->code }}">
												{{trans('messages.trips_active.view_receipt')}}
											</a>
											<button class="btn btn-outline-danger m-0 decline-modal-triggers" data-id="{{ $booking->id }}">
												{{trans('messages.trips_active.cancel_my_booking')}}
											</button>
											<!-- <a class="btn btn-outline-danger m-0" href="{{ url('/') }}/trips/guest_cancel/{{ $booking->id }}">
											</a> -->
										@elseif($booking->status == 'Processing' && $booking->payment_method_id <> 4)
											<a class="btn btn-outline-danger m-0" href="{{ url('/') }}/booking_payment/{{ $booking->id }}">
												Make {{trans('messages.payment.payment')}}
											</a>
										@endif
                                    </div>
                                    <div class="status text-center">
                                        <span class="badge vbadge-success mb-4 {{ $booking->status}}">{{ $booking->status }}</span>
										<a href="{{ url('/') }}/users/show/{{ $booking->host->id }}">
											<div class="user-details">
												<div class="user-img">
													<img src="{{ $booking->host->profile_src }}" alt="{{ $booking->host->first_name }}">
												</div>
												<div class="user-name">
													{{ $booking->host->first_name}}
												</div>
											</div>
										</a>
                                    </div>
                                </div>
                            </div>
						@empty
							<div class="text-center w-100 pt-4 pb-4">
								<img src="{{ url('img/unnamed.png') }}" alt="notfound" class="img-fluid">
								<p class="text-center fs-6">{{trans('messages.message.empty_tripts')}}</p>
							</div>
						@endforelse
					</div>
				</div>
				<div class="row justify-content-between overflow-auto pb-3 mt-4 mb-5">
					{{ $bookings->appends(request()->except('page'))->links('paginate')}}
				</div>
			</div>
		</div>
	</div>
</main>
<div class="modal calender_modal modal-z-index" id="decline-modals" tabindex="-1" role="dialog" aria-labelledby="decline-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content ">
			<div class="modal-header p-4">
				<h5>{{ trans('messages.booking_detail.cancel_this_booking') }}</h5>
				<button type="button" class="close filter-cancel" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form accept-charset="UTF-8" action="{{ url('trips/guest_cancel') }}" id="decline_reservation_form" method="post" name="decline_reservation_form">
				{{ csrf_field() }}
				<div class="modal-body p-4">
					<div id="decline_reason_container">
						<div id="cancel_reason_other_div d-none" class="form-group mt-4">
							<label for="cancel_reason_other" class="mb-3">
								{{ trans('messages.booking_detail.what_reason_cancelling') }}?
							</label>
							<textarea class="form-control" id="cancel_reason" name="cancel_reason" rows="4" required></textarea>
							<span class="cancel_reason text-danger"></span>
						</div>
						<div class="col-md-12 mt-0 p-0">
							<div class="row m-0 justify-content-between ">
								<input type="hidden" name="decision" value="decline">
								<input type="hidden" name="id" id="booking-id" value="">
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ trans('messages.booking_detail.close') }}</button>
								<button type="submit" class="btn vbtn-outline-success" id="decline_submit" name="commit"> <i class="spinner fa fa-spinner fa-spin d-none" id="decline_spinner" ></i>
									<span id="decline_btn-text">{{trans('messages.booking_my.cancel')}}</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
@push('scripts')
    <script type="text/javascript">
        $(document).on('change', '#trip_select', function(){
            $("#my-trip-form").trigger("submit");
        });
		
		$('.decline-modal-triggers').on('click', function(e){
            e.preventDefault();
            // $(this).val();
             console.log("🚀 ~ file: my_bookings.blade.php:162 ~ $ ~ $(this).val():", $(this).data('id'))
            $("#booking-id").val($(this).data('id'));
            $('#decline-modals').modal('toggle');
        })
    </script>
@endpush
