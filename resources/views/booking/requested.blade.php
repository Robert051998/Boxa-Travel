@extends('template')

@section('main')
<main class="listing_detail mb-5">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-lg-6 col-xl-7 mb-5 pb-5">
				@if($booking_details->status == 'Pending')
					@if($booking_details->payment_method_id == 4)
						<h3 class="mb-4">{{trans('messages.booking_request.get_ready')}} {{ $booking_details->properties->property_address->city }}!</h3>
						<p class="fs-6">{{trans('messages.booking_request.bank_paid')}}</p>
					@else
						<h3 class="mb-4">{{ trans('messages.booking_request.request_has_sent') }}</h3>
						<p class="fs-6">{{ trans('messages.booking_request.not_a_confirmed_booking') }} {{ trans('messages.booking_request.hear_back_within_24') }} {{ trans('messages.booking_request.not_be_charged') }} {{$booking_details->properties->users->first_name}} {{ trans('messages.booking_request.accommodate_stay') }}.</p>
					@endif
				@endif

				@if($booking_details->status == 'Accepted')
					<h3 class="mb-4">{{trans('messages.booking_request.get_ready')}} {{ $booking_details->properties->property_address->city }}!</h3>
					<p class="fs-6">{{trans('messages.booking_request.confirmed_booking')}} {{$booking_details->properties->users->first_name}}. {{trans('messages.booking_request.emailed_itinerary')}} {{$booking_details->properties->users->email}}.</p>
				@endif
			</div>
			
			<div class="col-lg-6 col-xl-5 listing m-0">
				<div class="listing-info">
					<div class="col-12 p-0 m-0">
						<a href="{{ url('/') }}/properties/{{ $booking_details->properties->slug}}">
							<img class="" src="{{$booking_details->properties->cover_photo}}" alt="{{$booking_details->properties->name}}" height="180px">
						</a>
						<div class="card-body p-0 pt-4 pb-4">
							<div class="listing_name">
								<a href="{{ url('/') }}/properties/{{ $booking_details->properties->slug}}">
									{{ $booking_details->properties->name }}
								</a>
								<p class="mt-2">
									<i class="fas fa-map-marker-alt mr-1"></i>
									{{$booking_details->properties->property_address->address_line_1}}, {{ $booking_details->properties->property_address->state }}, {{ $booking_details->properties->property_address->country_name }}
								</p>
							</div>
							<div class="listing-info mt-4 text-center">
								<p class="mb-2">
									<strong class="">{{ $booking_details->properties->property_type_name }}</strong>
									{{trans('messages.payment.for')}}
									<strong class="">{{ $booking_details->guest }} {{trans('messages.payment.guest')}}</strong>
								</p>
								<div class=""><strong>{{ date('D, M d, Y', strtotime($booking_details->startdate_dmy)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($booking_details->enddate_dmy)) }}</strong></div>
							</div>

							<div class="listing-info mt-4 payment-details {{ (isset($booking_details) &&  $booking_details->payment_method_id == 2) ? 'euro-actvie' : 'boxa-price'}}">
								<div class="d-flex justify-content-between align-items-center">
									<div>{{trans('messages.booking_detail.night')}}</div>
									<div>{{ $booking_details->total_night }}</div>
								</div>

								<div class="d-flex justify-content-between align-items-center">
									<div>{{trans('messages.booking_detail.guest')}}</div>
									<div>{{ $booking_details->guest}}</div>
								</div>

								<div class="d-flex justify-content-between align-items-center">
									<div>{{trans('messages.booking_detail.rate_per_night')}}</div>
									<div>
										<div class="boxa-price d-flex">
											<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
											<span class="ml-2 light-grey">{!! $price_list->per_night_price_boxa !!}</span>
										</div>
										<div class="euro-price">
											<span class="ml-2 light-grey">{!! $price_list->per_night_price_with_symbol !!}</span>
										</div>
									</div>
								</div>

								@if($price_list->date_with_price)
									@foreach($price_list->date_with_price as $datePrice )
									<div class="d-none justify-content-between align-items-center">
										<div>{{ $datePrice->date }}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $datePrice->boxa_price!!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $datePrice->price!!}</span></div>
										</div>
									</div>
									@endforeach
								@endif

								@if($booking_details->cleaning_charge != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.booking_detail.cleanning_fee')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->cleaning_fee_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->cleaning_fee_with_symbol !!}</span></div>
										</div>
									</div>
								@endif
								@if($booking_details->pets_charge != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.home.pets')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->pets_price_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->pets_price_with_symbol !!}</span></div>
										</div>
									</div>
								@endif

								@if($booking_details->guest_charge != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.booking_detail.additional_guest_fee')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->additional_guest_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->additional_guest_fee_with_symbol !!}</span></div>
										</div>
									</div>
								@endif

								@if($booking_details->security_money != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.booking_detail.security_fee')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->security_fee_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->security_fee_with_symbol !!}</span></div>
										</div>
									</div>
								@endif

								@if($booking_details->service_charge != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.property_single.service_fee')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->service_fee_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->service_fee_with_symbol !!}</span></div>
										</div>
									</div>
								@endif


								@if($booking_details->iva_tax != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.property_single.iva_tax')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->iva_tax_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->iva_tax_with_symbol !!}</span></div>
										</div>
									</div>
								@endif

								@if($booking_details->accomodation_tax != 0)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.property_single.accommodatiton_tax')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{!! $price_list->accomodation_tax_boxa !!}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->accomodation_tax_with_symbol !!}</span></div>
										</div>
									</div>
								@endif


								<div class="d-flex justify-content-between align-items-center">
									<div>{{trans('messages.booking_detail.subtotal')}}</div>
									<div>
										<div class="boxa-price d-flex">
											<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
											<span class="ml-2 light-grey">{!! $price_list->total_boxa !!}</span>
										</div>
										<div class="euro-price"><span class="ml-2 light-grey">{!! $price_list->total_with_symbol !!}</span></div>
									</div>
								</div>

								@if($booking_details->host_fee)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.booking_detail.host_fee')}}</div>
										<div>
											<div class="boxa-price d-flex">
												<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
												<span class="ml-2 light-grey">{{ $booking_details->host_fee_boxa }}</span>
											</div>
											<div class="euro-price"><span class="ml-2 light-grey">{!! $booking_details->currency->symbol !!}{{ $booking_details->host_fee }}</span></div>	
										</div>								
									</div>
								@endif
								<div class="d-flex justify-content-between align-items-center"  id="total">
									<div>{{trans('messages.booking_detail.total_payout')}}</div>
									<div>
										<div class="boxa-price d-flex">
											<img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid" />
											<span class="ml-2 text-green">{!! $price_list->total_boxa !!}</span>
										</div>
										<div class="euro-price"><span class="ml-2 text-green">{!! $price_list->total_with_symbol !!}</span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@push('scripts')
<script type="text/javascript">
	$('#request-add-email').on('click', function(){
		var content = '<div class="form-group">'
			+'<input type="email" name="friend[]" class="form-control" id="exampleInputPassword1" placeholder="Email">'
			+'</div>';
		$(content).insertBefore('#add-email-field');
	});
</script>
@endpush
@stop
