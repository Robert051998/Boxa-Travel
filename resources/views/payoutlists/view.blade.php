@extends('template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link rel="stylesheet" href="{{URL::to('/')}}/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/css/responsive.dataTables.min.css">
@endpush
@section('main')
<main>
    <div class="row m-0">
		@include('users.sidebar')
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
			<div class="container-fluid inner-content">
				<div class="row m-0 mb-3">
					<div class="col-12 p-0">
						<div class="d-flex justify-content-between align-items-center main-heading">
							<h4 class="m-0">{{trans('messages.users_dashboard.my_wallet')}}: {!! moneyFormat( $currentCurrency->symbol, $walletBalance->total) !!}</h4>
							<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('users/payout-list') }}" method="GET" id='filter_form' accept-charset="UTF-8">
								<div class="row justify-content-between m-0">
									@if($payouts->count() > 0)
									<button  type="button" class="btn vbtn-outline-success m-0" data-toggle="modal" data-target="#exampleModal">
										{{trans('messages.account_preference.payout_request')}}
										<i class="fa fa-arrow-up ml-2"></i>
									</button>
									@else
									<button type="button" class="btn vbtn-outline-success m-0 no-payout">
										{{trans('messages.account_preference.payout_request')}}
										<i class="fa fa-arrow-up ml-2"></i>
									</button>
									@endif	
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row m-0">
                    <div class="col-md-12 p-0 mt-0 mt-sm-3">
						<div class="row justify-content-center m-0">
							<div class="col-md-12 p-0">
								<ul class="nav navbar-expand-lg navbar-light list-bacground border rounded-3 p-3">
									<li class="nav-item">
										<a class="nav-link" href="{{ url('users/payout-list') }}">{{trans('messages.sidenav.payouts')}}</a>
									</li>

									<li class="nav-item ">
										<a class="nav-link" href="{{ url('users/payout') }}">{{trans('messages.account_sidenav.account_preference')}}</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					@if(Session::has('message'))
						<div class="row justify-content-center ">
							<div class="col-md-12  alert {{ Session::get('alert-class') }} alert-dismissable fade in top-message-text opacity-1">
								<a href="#" class="close pt-2 text-18" data-dismiss="alert" aria-label="close">&times;</a>
								{{ Session::get('message') }}
							</div>
						</div>
					@endif

					<div class="col-12 p-0 mt-0 mt-sm-5">
						<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('users/payout-list') }}" method="GET" id='filter_form' accept-charset="UTF-8">
								{{ csrf_field() }}
								<input class="form-control" type="text" id="startDate"  name="from" value="<?= isset($from) ? $from : '' ?>" hidden>
								<input class="form-control" type="text" id="endDate"  name="to" value="<?= isset($to) ? $to : '' ?>" hidden>

								<div class="row justify-content-between m-0 ">
									<div class="d-flex justify-content-between align-items-center main-heading">
										<div class="">
											<button type="button" class="form-control pick_date pick_date-width pick-btn" id="daterange-btn">
												<span class="float-left">
													<i class="fa fa-calendar pr-2"></i> {{trans('messages.filter.pick_date_range')}}
												</span>
												<i class="fa fa-caret-down float-right ml-2"></i>
											</button>
										</div>
										<div class="text-right ml-3">
											<button type="submit" name="btn" class="btn vbtn-outline-success m-0">{{trans('messages.filter.filter')}}</button>
										</div>
									</div>	
								</div>
							</form>
						</div>
						<div class="col-md-12 p-0 mt-5">
							<div class="panel-footer card">
								<div class="panel">
									<div class="panel-body">
										<div class="box">
											<div class="card-body p-0">
												<div class="table-responsive">
													{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive pt-4', 'width' => '100%', 'cellspacing' => '0']) !!}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal calender_modal" id="exampleModal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header p-4">
					<h5 class="modal-title" id="exampleModalLabel">{{trans('messages.account_preference.payout_request')}}</h5>
					<button type="button" class="close text-28" data-dismiss="modal" aria-label="Close" id="modalClose">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<form action="{{url('users/payout/success')}}" id="add_payout_request" method="post" name="add_payout_setting" accept-charset='UTF-8'>
						{{ csrf_field() }}
						<div class="row" id="paymentDiv">
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputPassword1" class="control-label">{{trans('messages.utility.payment_method')}}</label>
									<select class="form-control" name="payment_method_id" id="payment_method_id">
										@foreach($payouts as $payout)
										<option value="{{$payout->id}}">@if( $payout->type == 1) Paypal ({{$payout->email}}) @else Bank ({{$payout->account_number}}) @endif </option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputPassword1" class="control-label">{{trans('messages.listing_price.currency')}}</label>
									<select class="form-control" name="currency_id" id="currency_id">
										<option value="{{$default_currency->id}}">{{$default_currency->code}}</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputPassword1" class="control-label">{{trans('messages.account_transaction.amount')}}
                                        <span class="text-danger">* </span>
                                        ({!! $default_currency->symbol . convert_currency($walletBalance->currency->code, $default_currency->code, $walletBalance->balance) . $default_currency->code !!})
                                    </label>
									<input type="text" class="form-control" name="amount" id="amount" value="{{old('amount')}}">
									<span class="text-danger d-none" id="amount_high">Don't have sufficient balance !</span>

									@if ($errors->has('amount')) <p class="error-tag">{{ $errors->first('amount') }}</p>
									@endif
								</div>
							</div>
							<input type="text" name="balance" id="balance" value="{{ convert_currency($walletBalance->currency->code, $default_currency->code, $walletBalance->balance) }}" hidden="">
							<div class="col-md-12">
								<div class="row m-0 justify-content-between ">
									<button type="button" class="btn btn-outline-danger" id="close" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
									<button type="button" class="btn vbtn-outline-success" disabled id="next_btn">  {{trans('messages.utility.next')}} </button>
								</div>
							</div>
						</div>
						<div class="d-none" id="confirmDiv">
							confirm
						</div>
					</form>
				</div>
			</div>
		</div>
</main>
@endsection
@push('scripts')

<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript" src="{{ url('js/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.min.js')}}"></script>
<script type="text/javascript">
	$(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		dateRangeBtn(startDate,endDate, dt=1);
		formDate (startDate, endDate);
	});
</script>

<script type="text/javascript">
	$('.no-payout').on('click', function(event) {
		event.preventDefault();
		swal({
			title: "{{trans('messages.modal.no_payout_settings')}}",
			text: "{{trans('messages.account_preference.add_payout')}}",
			icon: "warning",
			buttons: {
				cancel: false,
				confirm: {
					text: "{{trans('messages.modal.ok')}}",
					value: true,
					visible: true,
					className: "btn vbtn-outline-success",
					closeModal: true
				}
			},
			dangerMode: true,
		})
	});


	$(document).ready(function() {
		$('#add_payout_request').validate({
			rules: {
				amount: {
					required: true,
					number: true,
					maxlength: 255
				}
			},
			submitHandler: function(form)
            {
         		$("#save_btn").on("click", function (e)
                {
                	$("#save_btn").attr("disabled", true);
                    e.preventDefault();
                });

                $(".spinner").removeClass('d-none');
                $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
                return true;
            }
		});

			$('#amount').on('keyup', function() {
			var amount = $(this).val();
			var balance = parseFloat($("#balance").val());
				if ( amount > balance ) {
						$("#amount_high").removeClass('d-none');
						$("#next_btn").attr("disabled", true);
				} else if(amount > 0) {
						$("#next_btn").attr("disabled", false);
						$("#amount_high").addClass('d-none');
				} else {
					$("#next_btn").attr("disabled", true);
				}
			});

		$('#next_btn').on('click', function(){
			if ($('#next_btn').prop('disabled')) {
					//
				} else {
					$('#paymentDiv').addClass('d-none');
					$('#confirmDiv').removeClass('d-none');

					var payouts = {!! $payouts !!};

					var payment_method_id = $('#payment_method_id').val();
					var item = payouts.find(item => item.id == payment_method_id );
					var bank_holder = '{{ trans('messages.account_preference.bank_holder') }}';
					var bank_account_num = '{{ trans('messages.account_preference.bank_account_num') }}';
					var swift_code = '{{ trans('messages.account_preference.swift_code') }}';
					var bank_name = '{{ trans('messages.account_preference.bank_name') }}';
					var symbol = '{!! $default_currency->code !!}';
					var amount = $('#amount').val();
					var submit = '{{trans('messages.utility.submit')}}';

					$('#confirmDiv').html('');

					if(item.type == 4) {
						$('#confirmDiv').html('<div class="row">'
											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class="">'+ bank_holder + '  :</strong><span>' + item.account_name +'</span></label>'
												+'</div>'
											+'</div'
											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class="">'+ bank_account_num + ' :</strong><span>'+ item.account_number +'</span></label>'
												+'</div>'
											+'</div>'

											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class="">'+ swift_code +' :</strong><span>' +item.swift_code +'</span></label>'
												+'</div>'
											+'</div>'

											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class="">'+ bank_name +':</strong><span>'+ item.bank_name +'</span></label>'
												+'</div>'
											+'</div>'

											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label class=""><span>{{trans('messages.booking_detail.total_payout')}}:</span> <strong  class="pul-right">'+ symbol + ' '+ amount +'</strong></label>'
												+'</div>'
											+'</div>'
										+'</div>'
										+'<div class="row">'
											+'<div class="col-md-12 d-flex m-0 justify-content-between ">'
												+'<button type="button" class="btn btn-outline-danger"  id="back_btn">  Back </button>'
												+'<button type="submit" class="btn vbtn-outline-success" id="save_btn"> <i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="save_btn-text">'+ submit +'</span> </button>'
											+'</div>'
										+'</div>'
						);
					} else if(item.type == 1){
						$('#confirmDiv').html('<div class="row">'
											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class="">'+ bank_holder + '  :</strong><span>' + item.account_name +'</span></label>'
												+'</div>'
											+'</div'

											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label><strong class=""> Email :</strong><span>' +item.email +'</span></label>'
												+'</div>'
											+'</div>'

											+'<div class="col-md-12">'
												+'<div class="form-group">'
													+'<label class=""><span>{{trans('messages.booking_detail.total_payout')}}:</span> <strong  class="pul-right">'+ symbol + ' '+ amount +' </span></strong></label>'
												+'</div>'
											+'</div>'
										+'</div>'
										+'<div class="row">'
											+'<div class="col-md-12 d-flex m-0 justify-content-between">'
												+'<button type="button" class="btn btn-outline-danger"  id="back_btn">  Back </button>'
												+'<button type="submit" class="btn vbtn-outline-success" id="save_btn"> <i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="save_btn-text">'+ submit +'</span> </button>'
											+'</div>'
										+'</div>'
						);
					}
				}
		});

		$(document).on('click','#back_btn', function(){
			$('#paymentDiv').removeClass('d-none');
			$('#confirmDiv').addClass('d-none');
		});

		$('#modalClose, #close').on('click', function(){
			$('#paymentDiv').removeClass('d-none');
			$('#confirmDiv').addClass('d-none');
			$('#amount').val('');
			$("#next_btn").attr("disabled", true);
		});
	});
</script>
@endpush

