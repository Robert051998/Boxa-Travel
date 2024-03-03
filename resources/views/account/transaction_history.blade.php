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
                            <h4 class="m-0">{{ trans('messages.account_transaction.transaction') }}</h4>
							<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('users/transaction-history') }}" method="GET" id='filter_form' accept-charset="UTF-8">
								{{ csrf_field() }}
								<input class="form-control" type="text" id="startDate"  name="from" value="<?= isset($from) ? $from : '' ?>" hidden>
								<input class="form-control" type="text" id="endDate"  name="to" value="<?= isset($to) ? $to : '' ?>" hidden>
								<div class="row justify-content-between m-0">
									<div class="d-flex">
										<div class="">
											<button type="button" class="form-control pick_date pick_date-width pick-btn" id="daterange-btn">
												<span class="float-left">
													<i class="fa fa-calendar pr-2"></i> {{ trans('messages.filter.pick_date_range') }}
												</span>
												<i class="fa fa-caret-down float-right ml-3 mr-1"></i>
											</button>
										</div>
										<div class="text-right ml-3">
											<button type="submit" name="btn" class="btn vbtn-outline-success m-0">{{trans('messages.filter.filter')}}</button>
										</div>
									</div>
								</div>
							</form>
                        </div>
                    </div>
					<div class="col-md-12 p-0 mt-5">
						<div class="panel-footer card">
							<div class="panel">
								<div class="card-body p-0">
									<div class="panel">
										<div class="panel-body">
											<div class="row m-0">
												<div class="table-responsive">
													{!! $dataTable->table(['class' => 'table table-header', 'width' => '100%', 'cellspacing' => '0']) !!}
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

<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.min.js') }}"></script>
<script type="text/javascript">
	$('.pagination li').addClass('page-item'); 
	$('.pagination li a').addClass('page-link');
	$('.pagination span').addClass('page-link');
</script>
<script type="text/javascript">
	$(function() {
		var startDate = $('#startDate').val();
		var endDate   = $('#endDate').val();
		dateRangeBtn(startDate,endDate, dt=1);
		formDate (startDate, endDate);
	});
</script>
@endpush 
