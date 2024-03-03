@extends('template')

@section('main')
<main>
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-xl-10 col-lg-9 min-height right-section">
			<div class="main-panel pro_listing">
				<div class="row justify-content-center">
					<div class="col-md-3 bg-lightgreen">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mb-5">
						<div class="inner-main-panel">
							<form id="booking_id" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}"  accept-charset='UTF-8'>
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-12">
										<h3 class="mt-5 mb-5">{{trans('messages.listing_sidebar.booking')}}</h3>
									</div>
									<div class="col-md-12 mb-5">
										<h4 class="mb-3">{{trans('messages.listing_book.booking_title')}} <span class="text-danger">*</span></h4>
										<p class="text-muted fs-6">{{trans('messages.listing_book.booking_data')}}.</p>
									</div>
									<div class="col-md-12">
										<label>{{trans('messages.listing_book.booking_type')}}</label>
										<select name="booking_type" id="booking_type" class="form-control">
											<option value="instant" {{ ($result->booking_type == 'instant') ? 'selected' : '' }}>{{trans('messages.listing_book.guest_instant')}}</option>
											<!-- <option value="request" {{ ($result->booking_type == 'request') ? 'selected' : '' }}>{{trans('messages.listing_book.review_request')}}</option> -->
										</select>
									</div>

									<div class="col-md-12 mt-5">
										<div class="row m-0 justify-content-between">
											<div class="">
												<a href="{{ url('listing/'.$result->id.'/pricing') }}" class="btn btn-outline-danger">
													{{trans('messages.listing_description.back')}}
												</a>
											</div>

											<div class="">
												<button type="submit" class="btn vbtn-outline-success" id="btn_next"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
													<span id="btn_next-text">{{trans('messages.listing_basic.next')}}</span>	
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop
@push('scripts')
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#booking_id').validate({
				rules: {
					booking_type: {
						required: true,
					}
				},
				submitHandler: function(form)
				{
					$("#btn_next").on("click", function (e)
					{	
						$("#btn_next").attr("disabled", true);
						e.preventDefault();
					});


					$(".spinner").removeClass('d-none');
					$("#btn_next-text").text("{{trans('messages.listing_basic.next')}} ..");
					return true;
				},
				messages: {
					booking_type: {
						required:  "{{ __('messages.jquery_validation.required') }}",
					}
				}
			});
		});
	</script>
@endpush