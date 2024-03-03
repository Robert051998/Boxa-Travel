@php 

    $page_title='Add Boxa to user wallet';
    $page_subtitle= 'Enter the amount you want to send to user'; 
    $form_name = '';
    $form_id = 'edit_admin';
    $action =URL::to('/').'/admin/customer/send-boxa-to-wallet/'.$user->id;
    $fields = [
        ['type' => 'text', 'class' => '', 'label' => 'Boxa Amount', 'name' => 'amount', 'value' => ''],        
    ];

@endphp
@extends('admin.template')
	@section('main')
	<div class="content-wrapper">
		<section class="content-header">
			<h1>{{ $page_title ?? '' }}<small>{{ $page_subtitle ?? '' }}</small></h1>
			@include('admin.common.breadcrumb')
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">{{ $form_name ?? '' }}</h3>
						</div>
						<form id="{{ $form_id ?? ''}}" method="post" action="{{ $action ?? ''}}" onsubmit="return contentValidate();" class="form-horizontal {{ $form_class ?? '' }}" {{ isset($form_type) && $form_type == 'file'? "enctype=multipart/form-data":"" }}>
							{{ csrf_field() }}
							<div class="box-body">
								@foreach($fields as $field)
									@include("admin.common.fields.".$field['type'], ['field' => $field])
								@endforeach
							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-space">Submit</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>



<div class="col-md-12 p-0 mt-5">
						<div class="panel-footer card">
							<div class="panel">
                            <h6 class="p-3">{{trans('messages.profile.boxa_wallet_heading')}} - {{$total}}</h6>
										<div class="panel-body">

											<div class="row m-0">
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
                    </section>
	</div>
	@endsection

<script type="text/javascript">



    $(document).ready(function () {
            $('#edit_admin').validate({
                rules: {
                    amount: {
                        required: true,
                        maxlength: 255
                    },
                    
                }
            });
        });
</script>