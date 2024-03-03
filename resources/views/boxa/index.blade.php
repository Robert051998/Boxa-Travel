@extends('template')
@section('main')
<main>
    <div class="row m-0">
		@include('users.sidebar')
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
			<div class="container-fluid inner-content">
				<div class="row">
					<div class="col-12">
						<h4 class="mb-4">{{trans('messages.profile.boxa_wallet_heading')}}</h4>	
					</div>
				</div>
				<div class="row">
					<div class="col-12 panel-body">
						<div class="table-responsive">
							<div class="card card-default"> 
								<div class="card-body p-0">
									<div class="panel-footer">
										<div class="panel">
											<div class="panel-body">
												<div class="row m-0">
													<div class="table-responsive">
														<table class="table table-header m-0">
															@if($transactions->count()>0)
																<thead>
																	<tr class="">
																		<th>{{trans('messages.account_transaction.date')}}</th>
																		<th>{{trans('messages.account_transaction.amount')}}</th>
																	</tr>
																</thead>
															@endif
																<tbody id="transaction-table-body1">
																	@forelse($transactions as $transaction)
																		<tr>
																			<td>{{ onlyFormat($transaction->created_at)}}</td>
																			<td>
																				{{$transaction->amount}}
																			</td>
																		</tr>
																	@empty

																	<div class="row jutify-content-center w-100 m-0">
																		<div class="text-center w-100 p-3">
																			<p class="text-center fs-6">{{trans('messages.listing_description.no')}} {{trans('messages.account_sidenav.transaction_history')}}.</p>
																		</div>
																	</div>
																	@endforelse
																</tbody>
															</table>
															@if( $transactions->count() >= 9 )
																<div class="more-btn text-center p-3">
																	<a class="" href="{{ url('/') }}/users/transaction-history">
																		{{trans('messages.property_single.more')}}
																	</a>
																</div>
															@endif
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
		</div>
	</div>
</main>

@endsection
@push('scripts')


<script src="{{ url('js/sweetalert.min.js') }}"></script>
<script src="{{ url('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">

	$('.delete-confirm').on("click", function(event) {
		var form =  $(this).closest("form");
		var name = $(this).data("name");
		console.log(name);
		event.preventDefault();
		swal({
			title: "{{trans('messages.modal.are_you_sure')}}",
			text: "{{trans('messages.modal.delete_message')}}",
			icon: "warning",
			buttons: {
				cancel: {
				    text: "{{trans('messages.search.cancel')}}",
				    value: null,
				    visible: true,
				    className: "btn btn-outline-danger",
				    closeModal: true,
				},
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
		.then((willDelete) => {
			if (willDelete) {
				$("#delete-payout-form").trigger("submit");
			}
		});
	});


	$(document).ready(function() {

		$("select#payout_type").change(function(){
			var payout = $( "#payout_type" ).val();
			if (payout == 1) {
				$("#acc_holder").addClass("d-none");
				$("#branch").addClass("d-none");
				$("#branch_c").addClass("d-none");
				$("#acc_number").addClass("d-none");
				$("#swift").addClass("d-none");
				$("#branch_ad").addClass("d-none");
				$("#bank").addClass("d-none");
				$("#country_id").addClass("d-none");
				$("#email_id").removeClass("d-none");
			}else{

				$("#acc_holder").removeClass("d-none");
				$("#branch").removeClass("d-none");
				$("#branch_c").removeClass("d-none");
				$("#acc_number").removeClass("d-none");
				$("#swift").removeClass("d-none");
				$("#branch_ad").removeClass("d-none");
				$("#bank").removeClass("d-none");
				$("#country_id").removeClass("d-none");
				$("#email_id").addClass("d-none");
			}
		});


		$('#add_payout_setting').validate({
			rules: {
				bank_account_holder_name: {
					required: true,
					maxlength: 255
				},
				bank_account_number: {
					required: true,
					maxlength: 255
				},
				swift_code: {
					required: true,
					maxlength: 255
				},
				branch_city: {
					required: true,
					maxlength: 255
				},
				branch_address: {
					required: true,
					maxlength: 255
				},
				branch_name: {
					required: true,
					maxlength: 255
				},
				bank_name: {
					required: true,
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
            },

		});

		$('#add_payout_setting').validate({
			rules:{
				email:{
					required:true,
				}
			}
		});

		$(document).on('click', '.editmodal', function() {
			var obj = $(this).data("obj");
			$('#edit_id').val(obj['id']);
			$('#edit_acc_holder').val(obj['account_name']);
			$('#edit_branch_name').val(obj['bank_branch_name']);
			$('#edit_branch_address').val(obj['bank_branch_address']);
			$('#edit_bank_name').val(obj['bank_name']);
			$('#edit_swift_code').val(obj['swift_code']);
			$('#edit_branch_city').val(obj['bank_branch_city']);
			$('#edit_account_number').val(obj['account_number']);
			$('#edit_country').val(obj['country']);
			$('#edit_payout_setting').validate({
				rules: {
					bank_account_holder_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					bank_account_number: {
						required: true,
						maxlength: 255,
						minlength: 3,

					},
					swift_code: {
						required: true,
						maxlength: 255,
						minlength: 3,

					},
					branch_city: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					branch_address: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					branch_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					bank_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					}
				},
				submitHandler: function(form)
	            {
	         		$("#edit_save_btn").on("click", function (e)
	                {
	                	$("#edit_save_btn").attr("disabled", true);
	                    e.preventDefault();
	                });

	                $(".spinner").removeClass('d-none');
	                $("#edit_save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
	                return true;
	            }
			});

		});

		$(document).on('click', '.editmodal2', function() {
			var obj = $(this).data("obj");
			$('#edit_id2').val(obj['id']);
			$('#edit_email').val(obj['email']);
			console.log(obj);
			$('#edit_payout_setting2').validate({
				rules:{
					email:{
						required:true,
					}
				},
				submitHandler: function(form)
	            {
	         		$("#edit_save_btn2").on("click", function (e)
	                {
	                	$("#edit_save_btn2").attr("disabled", true);
	                    e.preventDefault();
	                });

	                $(".spinner").removeClass('d-none');
	                $("#edit_save_btn-text2").text("{{trans('messages.users_profile.save')}} ..");
	                return true;
	            }
			});
		});
	});
</script>
@endpush

