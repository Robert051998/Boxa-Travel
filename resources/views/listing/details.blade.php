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
							<form method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8' id="listing_det">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-12">
										<h3 class="mt-5 mb-5">{{trans('messages.listing_description.detail')}}</h3>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.about_place')}}</label>
										<textarea class="form-control" name="about_place" rows="4" placeholder="">{{ $description->about_place }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.great_place')}}</label>
										<textarea class="form-control" name="place_is_great_for" rows="4" placeholder="">{{ $description->place_is_great_for }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.guest_access')}}</label>
										<textarea class="form-control" name="guest_can_access" rows="4" placeholder="">{{ $description->guest_can_access }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.guest_interaction')}}</label>
										<textarea class="form-control" name="interaction_guests" rows="4" placeholder="">{{ $description->interaction_guests }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.thing_note')}}</label>
										<textarea class="form-control" name="other" rows="4" placeholder="">{{ $description->other }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.overview')}}</label>
										<textarea class="form-control" name="about_neighborhood" rows="4" placeholder="">{{ $description->about_neighborhood }}</textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label class="label-large">{{trans('messages.listing_description.getting_around')}}</label>
										<textarea class="form-control" name="get_around" rows="4" placeholder="">{{ $description->get_around }}</textarea>
									</div>
									<div class="col-md-12 mt-5">
										<div class="row m-0 justify-content-between">
											<div>
												<a  href="{{ url('listing/'.$result->id.'/description') }}" class="btn btn-outline-danger">
												{{trans('messages.listing_description.back')}}
												</a>
											</div>
											<div>
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
		$('#listing_det').validate({
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
            }
		});
	});
</script>
@endpush