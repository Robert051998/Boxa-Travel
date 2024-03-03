@extends('template')

@section('main')
<main class="listing_detail">
	<div class="container-fluid p-0">
		@if(Session::has('message'))
			<div class="row mt-5">
				<div class="col-md-12 text-13 alert mb-0 {{ Session::get('alert-class') }} alert-dismissable fade in  text-center opacity-1">
					<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('message') }}
				</div>
			</div>
		@endif

		<div class="row mb-5">
			<div class="col-lg-6 col-xl-7 mb-5 pb-5">
				<h3 class="mb-5">Payment</h3>
				<form action="{{ url('payments/create_booking') }}" method="post" id="checkout-form">
					{{ csrf_field() }}
					<div class="row justify-content-center">
					<input name="property_id" type="hidden" value="{{ $property_id }}">
					<input name="checkin" type="hidden" value="{{ $checkin }}">
					<input name="checkout" type="hidden" value="{{ $checkout }}">
					<input name="number_of_guests" type="hidden" value="{{ $number_of_guests }}">
					<input name="nights" type="hidden" value="{{ $nights }}">
					<input name="currency" type="hidden" value="{{ $result->property_price->code }}">
					<input name="booking_id" type="hidden" value="{{ $booking_id }}">
					<input name="booking_type" type="hidden" value="{{ $booking_type }}">

					@if($status == "" && $booking_type == "request")
						<div class="col-md-12">
							<h4 class="text-left">{{ trans('messages.listing_book.request_message') }}</h4>
						</div>
					@endif
					@if($booking_type == "instant"|| $status == "Processing" )
						<div class="col-md-12">
							<label for="exampleInputEmail1">{{ trans('messages.payment.country') }}</label>
						</div>

						<div class="col-sm-12 pb-3">
							<select name="payment_country" id="country-select" data-saving="basics1" class="form-control">
								@foreach($country as $key => $value)
								<option value="{{ $key }}" {{ ($key == $default_country) ? 'selected' : '' }}>{{ $value }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-12">
							<label for="exampleInputEmail1">{{ trans('messages.payment.payment_type') }}</label>
						</div>

						<div class="col-sm-12 pb-3">
							<div class="form-group mb-1">
								<input type="radio" name="payment_method" id="Boxa_Wallet" onChange="changePricing('Boxa_Wallet')" value="Boxa_Wallet" {{$price_list->total_boxa_without_format > $boxa_wallet->balance ? 'disabled' : '' }} /> 
								<label for="Boxa_Wallet">Boxa Wallet ({{ number_format($boxa_wallet->balance, 2)}})</label>
							</div>
							<div class="form-group mb-1">
								<input type="radio" name="payment_method" id="Currency_Wallet" onChange="changePricing('Currency_Wallet')" value="Currency_Wallet" {{$price_list->total > $euro_wallet->balance ? 'disabled' : '' }} />
								<label for="Currency_Wallet">Euro Wallet ({!! moneyFormat( $currentCurrency->symbol, number_format($euro_wallet->total, 2)) !!})</label>
							</div>
							@if($crypto_status->value == 1)
								<div class="form-group mb-1">
									<input type="radio" name="payment_method" id="WalletConnect"  onChange="changePricing('WalletConnect')" value="WalletConnect" />
									<label for="WalletConnect">Boxa</label>			
								</div>					
							@endif
							@if($stripe_status->value == 1)
								<div class="form-group mb-1">
									<input type="radio" name="payment_method" id="stripe"  onChange="changePricing('stripe')" value="stripe" />
									<label for="stripe">Credit Card</label>
								</div>
							@endif
							@if($banks >= 1)
								<div class="form-group mb-1">
									<input type="radio" name="payment_method" id="bank"  onChange="changePricing()" value="bank" />
									<label for="bank">Bank</label>
								</div>
							@endif
						</div>

					@endif

						<div class="col-sm-12">
							<label for="message"></label>
						</div>

						<div class="col-sm-12 pb-3">
							<textarea name="message_to_host" placeholder="{{ trans('messages.trips_active.type_message') }}" class="form-control " rows="7" ></textarea>
						</div>


						<div class="col-sm-12 text-right mt-4">
							<button id="payment-form-submit" type="submit" class="btn vbtn-outline-success  font-weight-700 pl-5 pr-5 pt-3 pb-3">
								<i class="spinner fa fa-spinner fa-spin d-none"></i>
								{{ ($booking_type == 'instant') ? trans('messages.listing_book.book_now') : trans('messages.property.continue') }}
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-xl-5 listing m-0">
				<div class="listing-info">
					<div class="col-12 p-0 m-0">
						<a href="{{ url('/') }}/properties/{{ $result->slug}}">
							<img class="card-img-top" src="{{ $result->cover_photo }}" alt="{{ $result->name }}" height="180px">
						</a>
						<div class="card-body p-0 pt-4 pb-4">
							<div class="listing_name">
								<a href="{{ url('/') }}/properties/{{ $result->slug}}">
									{{ $result->name }}
								</a>

								<p class="mt-2">
									<i class="fas fa-map-marker-alt mr-1"></i>
									{{$result->property_address->address_line_1}}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}
								</p>
							</div>
							<div class="listing-info mt-4 text-center">
								<p class="mb-2">
									<strong class="">{{ $result->property_type_name }}</strong>
									{{trans('messages.payment.for')}}
									<strong class="">{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong>
								</p>
								<div class=""><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>
							</div>

							<div class="listing-info mt-4 payment-details" id="payment-details-div">

								@foreach( $price_list->date_with_price as $date_price)
								<div class="d-none justify-content-between align-items-center " >
									<div>{{ $date_price->date }}</div>
									<div class="euro-price">{!! $date_price->price !!}</div>
									<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $date_price->boxa_price !!}</div>
								</div>
								@endforeach
								<div class="d-flex justify-content-between align-items-center">
									<div>{{trans('messages.payment.night')}}</div>
									<div>{{ $nights }}</div>
								</div>

								<div class="d-flex justify-content-between ">
									<div>{{ $nights }} {{trans('messages.payment.nights')}}</div>
									<div class="euro-price">{!! $price_list->total_night_price_with_symbol !!}</div>
									<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->total_night_price_boxa !!}</div>
								</div>

								@if($price_list->service_fee)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.payment.service_fee')}}</div>
										<div class="euro-price">{!! $price_list->service_fee_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->service_fee_boxa !!}</div>
									</div>
								@endif

								@if($price_list->additional_guest)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.payment.additional_guest_fee')}}</div>
										<div class="euro-price">{!! $price_list->additional_guest_fee_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->additional_guest_boxa !!}</div>
									</div>
								@endif

								@if($price_list->security_fee)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.payment.security_deposit')}}</div>
										<div class="euro-price">{!! $price_list->security_fee_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->security_fee_boxa !!}</div>
									</div>
								@endif

								@if($price_list->cleaning_fee)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.payment.cleaning_fee')}}</div>
										<div class="euro-price">{!! $price_list->cleaning_fee_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->cleaning_fee_boxa !!}</div>
									</div>
								@endif
								@if($price_list->pets_price)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.home.pets')}}</div>
										<div class="euro-price">{!! $price_list->pets_price_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->pets_price_boxa !!}</div>
									</div>
								@endif

								@if($price_list->iva_tax)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.property_single.iva_tax')}}</div>
										<div class="euro-price">{!! $price_list->iva_tax_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->iva_tax_boxa !!}</div>
									</div>
								@endif

								@if($price_list->accomodation_tax)
									<div class="d-flex justify-content-between align-items-center">
										<div>{{trans('messages.property_single.accommodatiton_tax')}}</div>
										<div class="euro-price">{!! $price_list->accomodation_tax_with_symbol !!}</div>
										<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->accomodation_tax_boxa !!}</div>
									</div>
								@endif
								<div class="d-flex justify-content-between font-weight-700 align-items-center">
									<div>{{trans('messages.payment.total')}}</div>
									<div class="euro-price">{!! $price_list->total_with_symbol !!}</div>
									<div class="boxa-price d-flex"><img src="{{URL::to('images/boxa-coin.svg')}}" alt="Boxa" class="img-fluid mr-1" />{!! $price_list->total_boxa !!}</div>
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
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$('#payment-method-select').on('change', function(){
  var payment = $(this).val();
  if(payment !== 'paypal'){
      $('.paypal-div').addClass('display-off')
  }
  else {
      $('.paypal-div').removeClass('display-off')
  }
});

$(document).ready(function() {
    $('#checkout-form').validate({
		rules: {
			payment_method: {
				required: true
			},
		},
        submitHandler: function(form)
        {			
 			$("#payment-form-submit").on("click", function (e)
            {
            	$("#payment-form-submit").attr("disabled", true);
                e.preventDefault();
            });
            $(".spinner").removeClass('d-none');
            $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
            return true;
        }
    });
});


$('#country-select').on('change', function() {
  var country = $(this).find('option:selected').text();
  $('#country-name-set').html(country);
})
function changePricing(value) {
    if (value == 'WalletConnect' || value == 'Boxa_Wallet') {
		$("#payment-details-div").removeClass('euro-actvie').addClass('boxa-actvie');
	} else {
        $("#payment-details-div").addClass('euro-actvie').removeClass('boxa-actvie');
    }
}


$(document).ready(function(){
@if (Session::get('my_currency'))
	@if(Session::get('my_currency')=='Boxa')
		$("#payment-details-div").removeClass('euro-actvie').addClass('boxa-actvie');
	@else
	$("#payment-details-div").addClass('euro-actvie').removeClass('boxa-actvie');
	@endif
@endif
})
</script>

@endpush
@stop
