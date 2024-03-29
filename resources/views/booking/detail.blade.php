@extends('template')
@section('main')
<main class="listing_detail">
	<div class="container-fluid p-0 mb-5">
		<div class="row mb-5">
			<div class="col-lg-6 col-xl-7 ">
				<div class="inner-Bookings">
					<h3>{{ trans('messages.booking_detail.request_booking') }}</h3>
					@if($result->status == 'Pending')
						<span class="d-flex align-items-center">
							<i class="far fa-clock mr-2"></i>
							{{ trans('messages.booking_detail.expire_in') }}
							<span class="countdown_timer hasCountdown"><span class="countdown_row countdown_amount" id="countdown_1"></span></span>
						</span>
					@endif
				</div>
				<div class="row flex-column-reverse flex-md-row mt-4 mb-4 inner-Bookings m-0">
					<div class="col-12 p-0">
						<span class="mb-3"><b>{{ $result->users->first_name }} {{ $result->users->last_name }}</b> has requested to book your property.Please accept or Decline this request.</span>
						@if($result->host_id == Auth::id())
							@if($result->status == 'Pending')
							<span class="d-flex align-items-center">
								<i class="fas fa-exclamation-triangle text-warning mr-2"></i> 
								{{ trans('messages.booking_detail.expire_in_data') }}
							</span>
							<div class="mt-3 text-center text-sm-left">
								<button class="btn vbtn-outline-success" id="accept-modal-trigger">
								{{ trans('messages.booking_detail.accept') }}
								</button>
								<button class="btn btn-outline-dark btn-lg ml-3" id="decline-modal-trigger">
								{{ trans('messages.booking_detail.decline') }}
								</button>
							</div>

							@else
								<h3 class="mt-4">Booking status</h3>
								<p class="">{{ $result->status }}</p>
							@endif
						@endif
					</div>
					
					<div class="col-12">
						<hr />
						<div class="status text-left">
							<div class="user-details">
                                <div class="user-img w-100">
									<img alt="{{ $result->users->first_name }}" class="m-0" src="{{ $result->users->profile_src }}" title="{{ $result->users->first_name }}">
								</div>
								<div class="user-name w-100">{{ $result->users->first_name }}</div>
							</div>
						</div>
						<p class="text-muted text-left fs-6">{{ trans('messages.booking_detail.member_since') }} {{ $result->users->account_since }}</p>
					</div>
				</div>
			</div>
			@include('payment.rightSection', [
				'result' => $result->properties, 
				'number_of_guests' => $result->guest, 
				'checkin' => $result->startdate_dmy, 
				'checkout' => $result->enddate_dmy,
				'nights' => $result->total_nights
			])
		</div>
	</div>
</main>

<div class="modal calender_modal modal-z-index" id="accept-modal" tabindex="-1" role="dialog" aria-labelledby="accept-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5>{{ trans('messages.booking_detail.accept_this_request') }}</h5>
					<button type="button" class="close filter-cancel" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body p-4">
					<form accept-charset="UTF-8" action="{{ url('booking/accept/'.$booking_id) }}" id="accept_reservation_form" method="post" name="accept_reservation_form">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="cancel_message">
								{{ trans('messages.booking_detail.optional_message_request') }}
							</label>
							<textarea class="form-control" id="accept_message" name="message" rows="4"></textarea>
						</div>
						<div class="form-group">
							<label for="tos_confirm" class="inline-flex items-center">
								<input id="tos_confirm" name="tos_confirm" type="checkbox" value="1">
								<span class="ml-2">{{ trans('messages.booking_detail.check_box_agree') }} <a href="#" target="_blank">{{ trans('messages.booking_detail.guarantee_term_condition') }}</a> <a href="#" target="_blank" class="font-weight-700">{{ trans('messages.booking_detail.refund_policy_term') }}</a>, {{ trans('messages.booking_detail.and') }} and <a href="{{ url('/') }}/terms_of_service" target="_blank">{{ trans('messages.booking_detail.term_of_service') }}</a>.</span>
							</label>
						</div>

						<div class="col-md-12 mt-0 p-0">
							<div class="row m-0 justify-content-between ">
								<input type="hidden" name="decision" value="accept">
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{trans('messages.booking_detail.close')}}</button>
								<button type="submit" class="btn vbtn-outline-success" id="accept_submit" name="commit"> <i class="spinner fa fa-spinner fa-spin d-none" id="accept_spinner" ></i>
									<span id="accept_btn-text">{{trans('messages.booking_detail.accept')}}</span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
</div>

<div class="modal calender_modal modal-z-index" id="decline-modal" tabindex="-1" role="dialog" aria-labelledby="decline-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content ">
			<div class="modal-header p-4">
				<h5>{{ trans('messages.booking_detail.cancel_this_booking') }}</h5>
				<button type="button" class="close filter-cancel" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form accept-charset="UTF-8" action="{{ url('booking/decline/'.$booking_id) }}" id="decline_reservation_form" method="post" name="decline_reservation_form">
				{{ csrf_field() }}
				<div class="modal-body p-4">
					<div id="decline_reason_container">
						<p class="fs-6">
							{{ trans('messages.booking_detail.improve_experience') }}{{ trans('messages.booking_detail.what_reason_cancelling') }}
						</p>
						<p class="mb-3"><strong>{{ trans('messages.booking_detail.response_not_shared') }}</strong></p>
						<div class="select">
							<select class="form-control" id="decline_reason" name="decline_reason">
								<option value=" ">{{ trans('messages.booking_detail.why_declining') }}</option>
								<option value="dates_not_available">{{ trans('messages.booking_detail.date_are_not_avialable') }}</option>
								<option value="not_comfortable">{{ trans('messages.booking_detail.not_feel_comfortable_guest') }}</option>
								<option value="not_a_good_fit">{{ trans('messages.booking_detail.listing_is_not_good') }}</option>
								<option value="waiting_for_better_reservation">{{ trans('messages.booking_detail.waiting_more_attractive') }}</option>
								<option value="different_dates_than_selected">{{ trans('messages.booking_detail.different_date_one_selected') }}</option>
								<option value="spam">{{ trans('messages.booking_detail.spam_message') }}</option>
								<option value="other">{{ trans('messages.booking_detail.other') }}</option>
							</select>
							<span class="errorMessage text-danger"></span>
						</div>
						<div id="cancel_reason_other_div d-none" class="form-group mt-4">
							<label for="cancel_reason_other" class="mb-3">
								{{ trans('messages.booking_detail.why_declining') }}?
							</label>
							<textarea class="form-control" id="decline_reason_other" name="decline_reason_other" rows="4"></textarea>
							<span class="decline_reason_other text-danger"></span>
						</div>
						<div class="form-group">
							<label for="block_calendar" class="inline-flex items-center">
								<input type="checkbox" checked="checked" name="block_calendar" value="yes">
								<span class="ml-2">{{ trans('messages.booking_detail.block_calender') }}  <b>{{ $result->startdate_md }}</b> {{ trans('messages.booking_detail.through') }} <b>{{ $result->enddate_md }}</b></span>
							</label>
						</div>
						<div class="form-group">
							<label for="cancel_message">
								{{ trans('messages.booking_detail.optional_message_request') }}
							</label>
							<textarea class="form-control" id="decline_message" name="message" rows="4"></textarea>
						</div>

						<div class="col-md-12 mt-0 p-0">
							<div class="row m-0 justify-content-between ">
								<input type="hidden" name="decision" value="decline">
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ trans('messages.booking_detail.close') }}</button>
								<button type="submit" class="btn vbtn-outline-success" id="decline_submit" name="commit"> <i class="spinner fa fa-spinner fa-spin d-none" id="decline_spinner" ></i>
									<span id="decline_btn-text">{{trans('messages.booking_detail.decline')}}</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<input type="hidden" id="expired_at" value="{{ $result->expiration_time }}">
<input type="hidden" id="booking_id" value="{{ $booking_id }}">
@stop

@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$(document).on('submit', 'form', function() {
	$('#accept_submit').attr('disabled', 'disabled');
});
});
</script>
<script type="text/javascript">
$('#accept-modal-trigger').on('click', function(){
	expirationTimeSet()
	$('#accept-modal').modal();
})
$('#decline-modal-trigger').on('click', function(){
	$('#decline-modal').modal();
})
$('#discuss-modal-trigger').on('click', function(){
	$('#discuss-modal').modal();
})

$('#decline_reason').on('change', function(){
	var res = $('#decline_reason').val();
	if(res == 'other') $('#cancel_reason_other_div').show();
});

var expiration_time  =  "{{ $result->expiration_time }}";
var _second = 1e3, _minute = 60 * _second, _hour = 60 * _minute, _day = 24 * _hour, timer;

function expirationTimeSet(){
	date_ele = new Date,
	present_time = new Date(date_ele.getUTCFullYear(), date_ele.getUTCMonth(), date_ele.getUTCDate(), date_ele.getUTCHours(), date_ele.getUTCMinutes(), date_ele.getUTCSeconds()).getTime(),
	expiration_time = new Date(this.expiration_time).getTime(),
	time_remaining = expiration_time - present_time;
	if (time_remaining < 0)
	//return '';
	return clearInterval(interval), document.getElementById("countdown_1").innerHTML = "Expired!";
	else{
	var h = (Math.floor(time_remaining / this._day), Math.floor(time_remaining % this._day / this._hour)),
		m = Math.floor(time_remaining % this._hour / this._minute),
		s = Math.floor(time_remaining % this._minute / this._second);
		document.getElementById("countdown_1").innerHTML = h + ":", document.getElementById("countdown_1").innerHTML += m + ":", document.getElementById("countdown_1").innerHTML += s + "";
	}
	console.log(h+':'+m+':'+s);
}

var interval = setInterval(expirationTimeSet, 1e3)
$(document).on('click','#decline_submit',function(){
	var optVal    = $('#decline_reason').val();
	if(optVal==' '){
	$('.errorMessage').html("{{ __('messages.jquery_validation.required') }}");
	return false;
	}else if(optVal=='other'){
	var decline_reason = $('#decline_reason_other').val();
	if(decline_reason==''){
		$('.decline_reason_other').html("{{ __('messages.jquery_validation.required') }}");
		return false;
	}else{
		return true;
	}
	}
});
	$(document).on('click','#accept_submit',function(){
		if($("#tos_confirm").prop('checked') == true){
			return true;
		}else{
		alert("{{ __('messages.jquery_validation.accept_terms_conditions') }}");
		return false;
		}
});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#accept_reservation_form').validate({
			rules: {
				tos_confirm: {
					required: true
				}
			},
			submitHandler: function(form)
			{
				$("#accept_submit").on("click", function (e)
				{
					$("#accept_submit").attr("disabled", true);
					e.preventDefault();
				});

				$("#accept_spinner").removeClass('d-none');
				$("#accept_btn-text").text("{{trans('messages.booking_detail.accept')}} ..");
				return true;

			},
			messages: {
				tos_confirm: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				}
			}
		});

		$('#decline_reservation_form').validate({
			rules: {
				decline_reason: {
					required: true
				}
			},
			submitHandler: function(form)
			{
				$("#decline_submit").on("click", function (e)
				{
					$("#decline_submit").attr("disabled", true);
					e.preventDefault();
				});

				$("#decline_spinner").removeClass('d-none');
				$("#decline_btn-text").text("{{trans('messages.booking_detail.decline')}} ..");
				return true;

			},
			messages: {
				decline_reason: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				}
			}
		});
	});
</script>
@endpush

