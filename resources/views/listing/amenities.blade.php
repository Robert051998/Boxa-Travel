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
							<form id="amenities_id" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
								{{ csrf_field() }}
								@foreach($amenities_type as $row_type)	
								<div class="row">
									<div class="col-md-12 ">
										<h3 class="mt-5 mb-5">{{ $row_type->name }}
											@if($row_type->name != 'Safety Amenities')
											<span class="text-danger">*</span>
											@endif
											
										</h3>										
										@if($row_type->id == 1)
											<span class="mb-3 error d-block"  id="at_least_one"></span>
										@endif
										@if($row_type->id == 3)
											<span class="mb-3 error d-block"  id="at_least_one">{{ $errors->first('amenities') }}</span>
										@endif
									</div>
									<div class="col-md-12">
										<div class="row">
											@foreach($amenities as $amenity)
												@if($amenity->type_id == $row_type->id)
												<div class="col-md-6">
													<label class="label-large label-inline amenity-label mb-4">
														<input type="checkbox" value="{{ $amenity->id }}" name="amenities[]" data-saving="{{ $row_type->id }}" {{ (is_array(old('amenities')) && in_array($amenity->id, old('amenities'))) ? 'checked' : ''  }} {{ in_array($amenity->id, $property_amenities) ? 'checked' : '' }}>
														<span>{{ $amenity->title }}</span>
													</label>																											
												</div>
												@endif
											@endforeach
										</div>
									</div>
								</div>
								@endforeach
								<div class="row">
									<div class="col-md-12">
										<div class="row m-0 justify-content-between">
											<div class="">
												<a data-prevent-default="" href="{{ url('listing/'.$result->id.'/location') }}" class="btn btn-outline-danger" >
												{{trans('messages.listing_description.back')}}
												</a>
											</div>

											<div class="">
												<button type="submit" class="btn vbtn-outline-success" id="btn_next"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
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
		$('#amenities_id').validate({
			rules: {
				'amenities[]': {
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
				$("#btn_next-text").text("{{trans('messages.listing_basic.next')}}..");
				return true;
			},
			messages: {
				'amenities[]': {
					required: "{{ __('messages.jquery_validation.required') }}",
				}
			},
			
			groups: {
			amenities: "amenities[]"
			},
			errorPlacement: function(error, element) {
			if (element.attr("name") == "amenities[]") {
				error.insertAfter("#at_least_one");
			} else {
				error.insertAfter(element);
			}
			},
		});
	});
</script>
@endpush