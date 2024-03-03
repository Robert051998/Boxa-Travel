@extends('template')
@section('main')
<main class="listing_detail mb-5">
	<div class="container-fluid p-0">
		@if(Session::has('message'))
			<div class="row mt-5">
				<div class="col-md-12 text-13 alert mb-0 {{ Session::get('alert-class') }} alert-dismissable fade in  text-center opacity-1">
					<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('message') }}
				</div>
			</div>
		@endif
		<div class="row">
			<div class="col-lg-6 col-xl-7 mb-5 pb-5">
				<h3 class="mb-5">{{trans('messages.payment.stripe')}} {{trans('messages.payment.payment')}}</h3>
				<form action="{{URL::to('payments/stripe-request')}}" method="post" id="payment-form">
					{{ csrf_field() }}
					<div class="form-row form-group p-0 m-0">
                        <h4 class="mb-4" for="card-element">{{trans('messages.payment_stripe.credit_debit_card')}}</h4>
						<div class="listing-info w-100">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="first_name" id="first_name" value="" class="form-control" required>										
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" id="last_name" value="" class="form-control" required>										
									</div>
								</div>
							</div>		
							<div id="card-element" class="border p-3">
							<!-- a Stripe Element will be inserted here. -->
							</div>
							<!-- Used to display form errors -->
							<div id="card-errors" class="error mt-3 mb-3" role="alert"></div>
							<div class="mt-3">* Terms & Conditions applied.</div>
						
							<div class="col-sm-12 text-right mt-4 p-0">
								<button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="stripe_btn"><i class="spinner fa fa-spinner fa-spin d-none"></i> {{trans('messages.payment_stripe.submit_payment')}}</button>
								<br />
								<img src="{{URL::to('images/logo_credit_cards_stripe.png')}}" alt="Credit Cards Stripe" class="mt-3 img-fluid credit_cards_stripe" />
							</div>
						</div>
					</div>
				</form>
			</div>
			@include('payment.rightSection', ['payment' => 'card']) 
		</div>
	</div>
</main>
@push('scripts')
@if (Request::path() == 'payments/stripe')
	<script src="https://js.stripe.com/v3/"></script>
@endif
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script>

</script>
<script type="text/javascript">
	// Create a Stripe client
	var stripe = Stripe('{{$publishable}}');

	// Create an instance of Elements
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
		base: {
		color: '#32325d',
		lineHeight: '24px',
		fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		fontSmoothing: 'antialiased',
		fontSize: '16px',
		'::placeholder': {
			color: '#aab7c4'
		}
		},
		invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
		}
	};

	// Create an instance of the card Element
	var card = elements.create('card', {style: style});

	// Add an instance of the card Element into the `card-element` <div>
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.addEventListener('change', function(event) {
		var displayError = document.getElementById('card-errors');
		console.log("🚀 ~ file: stripe.blade.php:78 ~ card.addEventListener ~ displayError", displayError)
		if (event.error) {
		displayError.textContent = event.error.message;
		} else {
		displayError.textContent = '';
		}
	});

	// Handle form submission
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
		event.preventDefault();

		stripe.createToken(card).then(function(result) {
		if (result.error) {
			// Inform the user if there was an error
			var errorElement = document.getElementById('card-errors');
			errorElement.textContent = result.error.message;
		} else {
			// Send the token to your server
			stripeTokenHandler(result.token);
		}
		});
	});

	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var form = document.getElementById('payment-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);

		$("#stripe_btn").on("click", function (e)
        {
        	$("#stripe_btn").attr("disabled", true);
            e.preventDefault();
        });

        $(".spinner").removeClass('d-none');
        $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");

		$("#payment-form").trigger("submit");

	}
	</script>
@endpush
@stop
