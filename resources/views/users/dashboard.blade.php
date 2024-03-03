@extends('template')
@section('main')
<main>
	<div class="row m-0">
		{{-- sidebar start--}}
		@include('users.sidebar')
		{{--sidebar end--}}
		<div class="col-xl-10 col-lg-9 min-height right-section p-0">
			<div class="container-fluid inner-content">
				<div class="row">
					<div class="col-12">
						<h4 class="mb-4">{{trans('messages.home.dashboard')}}</h4>
					</div>
				</div>
				<div class="row total-values">
					<div class="col-md-3">
						<a href="{{ url('properties') }}">
							<div class="card card-default lists">
								<div class="card-body d-flex justify-content-between align-items-center">
									<div class="inner-text">
										<span class="wallet">{{ $list }}</span>
										<span>{{trans('messages.users_dashboard.my_lists')}}</span>
									</div>
									<p class="listing-icon m-0 p-0">
										<img src="{{URL::to('images/lists.svg')}}" alt="Listing" />
									</p>	
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="{{ url('/') }}/trips/active">
							<div class="card card-default trips">
								<div class="card-body d-flex justify-content-between align-items-center">
									<div class="inner-text">
										<span class="wallet">{{ $trip }}</span>
										<span>{{trans('messages.users_dashboard.my_trips')}}</span>
									</div>
									<p class="listing-icon m-0 p-0">
										<img src="{{URL::to('images/trips_icon.svg')}}" alt="Trips" />
									</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-md-3">
						<a href="{{ url('users/payout-list') }}">
							<div class="card card-default wallet">
								<div class="card-body d-flex justify-content-between align-items-center">
									<div class="inner-text">
										<span class="wallet">{!! moneyFormat( $currentCurrency->symbol, number_format($currency_wallet->total, 2)) !!}</span>
										<span>{{trans('messages.users_dashboard.my_wallet')}}</span>
									</div>
									<p class="listing-icon m-0 p-0">
										<img src="{{URL::to('images/wallet.svg')}}" alt="Wallet" />
									</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3">
						<a href="{{ url('users/boxa-list') }}">
							<div class="card card-default boxa">
								<div class="card-body d-flex justify-content-between align-items-center">
									<div class="inner-text">
										<span class="wallet">{{ number_format($crypto_wallet->balance, 2)}}</span>
										<span>Boxa</span>
									</div>
									<p class="listing-icon m-0 p-0">
										<img src="{{URL::to('images/boxa-icon.svg')}}" alt="Boxa" />
									</p>	
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="row mb-5">
					<!-- Content Column -->
					<div class="col-xl-6 col-lg-12 mb-4 mt-5">
						<!-- Project Card Example -->
						<h6 class="p-3">{{trans('messages.users_dashboard.latest_bookings')}}</h6>
						<div class="card card-default">
							<div class="card-body p-0">
								<div class="widget">
									<ul>
										@forelse($bookings as $booking)
										@if($loop->index < 4)
										<li>
											<div class="d-flex justify-content-between align-items-center">
												<div class="booking-info">
													<div class="booking-info-img">
														<a href="{{ url('/') }}/properties/{{ $booking->properties->slug}}">
															<img src="{{ $booking->properties->cover_photo}} " alt="coverphoto" />
														</a>
													</div>
												</div>
												<div class="d-flex justify-content-between align-items-center booking-info-text">
													<div class="mr-3">
														<h4 class="animated bounceInRight">
															<a href="{{ url('/') }}/properties/{{ $booking->properties->slug}}">{{ $booking->properties->name}}</a>
														</h4>
														<span class="d-flex"><img src="{{URL::to('images/Calendar.svg')}}" alt="Calendar" class="mr-2" /> 
															{{ $booking->date_range}}
														</span>
														{{ $booking->users->full_name}}
													</div>
													<div class="status">
														<span class="badge vbadge-success {{ $booking->status}}">{{ $booking->status}}</span>
													</div>
												</div>
											</div>
										</li>
										@endif
										
										@empty
										<div class="row jutify-content-center w-100 m-0">
											<div class="text-center w-100 p-3">
											<p class="text-center fs-6">{{trans('messages.booking_my.no_booking')}}</p>
											</div>
										</div>
										@endforelse
									</ul>
								</div>

								@if($bookings->count()>4)
								<div class="more-btn text-center p-3">
										<a class="" href="{{ url('/') }}/my-bookings">
											{{trans('messages.property_single.more')}}
										</a>
									</div>
								@endif
							</div>


						</div>
					</div>

					<div class="col-xl-6 col-lg-12 mb-4 mt-5">
						<!-- Illustrations -->
						<h6 class="p-3">{{trans('messages.users_dashboard.latest_transactions')}}</h6>
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
																	<th>{{trans('messages.account_transaction.type')}}</th>
																	<th>{{trans('messages.utility.payment_method')}}</th>
																	<th>{{trans('messages.account_transaction.date')}}</th>
																	<th>{{trans('messages.account_transaction.amount')}}</th>
																</tr>
															</thead>
														@endif
															<tbody id="transaction-table-body1">
																@forelse($transactions as $transaction)
																	<tr>
																		<td>{{ $transaction->type > 0 ? trans('messages.users_dashboard.booking') : ($transaction->type < 0 ? trans('messages.users_dashboard.trip') : trans('messages.users_dashboard.withdraw'))}}</td>
																		<td>{{ $transaction->payment_methods !== null ? ($transaction->payment_methods->name  == 'Crypto' ? 'Boxa' : $transaction->payment_methods->name) : '' }}</td>
																		<td>{{ onlyFormat($transaction->created_at)}}</td>
																		<td class="{{ $transaction->type <= 0 ? 'text-danger' : 'text-success'}}">
                                                                            <span>
																				{{ $transaction->type <= 0 ? '- ' : '+ ' }}
																				@if ($transaction->payment_methods !== null) 
																					@if ($transaction->payment_methods->name == 'Crypto') 
																						<a target="_blank" href="{{$transaction->transaction_id}}">...{{substr($transaction->transaction_id, -6)}}</a>
																					@else
																						{!! Session::get('symbol') !!}{{ $transaction->type <> 0 ? currency_fix($transaction->amount, $transaction->currency_id) : currency_fix($transaction->amount, $transaction->currency->code)  }}
																					@endif
																				@endif
																			</span>
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
</main>
@stop
