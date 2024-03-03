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
				<form action="{{URL::to('payments/boxa-wallet-request')}}" method="post" id="payment-form">
					{{ csrf_field() }}
					<div class="form-row form-group p-0 m-0">
                        <h4 class="mb-4" for="card-element">{{trans('messages.payment_stripe.credit_debit_card')}}</h4>
						<div class="listing-info w-100">
							<div class="row">
                                <div class="col-md-12">
                                    <div class="card card-default lists">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="inner-text">
                                                <a href="{{ url('properties') }}">{{ number_format($crypto_wallet->balance, 2)}}</a>
                                                <span>Boxa</span>
                                            </div>
                                            <p class="listing-icon m-0 p-0">
                                                <img src="{{URL::to('images/lists.svg')}}" alt="Listing" />
                                            </p>	
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="mt-3">* Terms & Conditions applied.</div>
						
							<div class="col-sm-12 text-right mt-4 p-0">
								<button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="stripe_btn"><i class="spinner fa fa-spinner fa-spin d-none"></i> {{trans('messages.payment_stripe.submit_payment')}}</button>
								<br />								
							</div>
						</div>
					</div>
				</form>
			</div>
			@include('payment.rightSection') 
		</div>
	</div>
</main>
@push('scripts')

@endpush
@stop
