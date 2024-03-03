@extends('template')
@section('main')
<main>
	<div class="row m-0">
		@include('users.sidebar')
		<div class="col-xl-10 col-lg-9 min-height right-section">
			<div class="main-panel pro_listing">
				<div class="row ">
					<div class="col-md-3 bg-lightgreen">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mb-5">
						<div class="inner-main-panel">
							<form id="lis_location" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-12">
										<h3 class="mt-5 mb-5">{{trans('messages.listing_sidebar.location')}}</h3>
									</div>
								</div>

								<input type="hidden" name='latitude' id='latitude'>
								<input type="hidden" name='longitude' id='longitude'>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>{{trans('messages.listing_location.country')}} <span class="text-danger">*</span></label>
											<select id="basics-select-bed_type" name="country" class="form-control" id='country'>
												@foreach($country as $key => $value)
													<option value="{{ $key }}" {{ ($key == $result->property_address->country) ? 'selected' : '' }}>{{ $value }}</option>
												@endforeach
											</select>
											<span class="text-danger">{{ $errors->first('country') }}</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>{{trans('messages.listing_location.address_line_1')}} <span class="text-danger">*</span></label>
											<input type="text" name="address_line_1" id="address_line_1" value="{{ $result->property_address->address_line_1  }}" class="form-control" placeholder="House name/number + street/road">
											<span class="text-danger">{{ $errors->first('address_line_1') }}</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div id="map_view" class="map-view-location"></div>
										</div>
									</div>
									<div class="col-md-12 mb-4">
										<p class="fs-6">You can move the pointer to set the correct map position</p>
										<span class="text-danger">{{ $errors->first('latitude') }}</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>{{trans('messages.listing_location.address_line_2')}}</label>
											<input type="text" name="address_line_2" id="address_line_2" value="{{ $result->property_address->address_line_2  }}" class="form-control" placeholder="Apt., suite, building access code">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>{{trans('messages.listing_location.city_town_district')}}  <span class="text-danger">*</span></label>
											<input type="text" name="city" id="city" value="{{ $result->property_address->city  }} " class="form-control">
											<span class="text-danger">{{ $errors->first('city') }}</span>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>{{trans('messages.listing_location.state_province')}} <span class="text-danger">*</span></label>
											<input type="text" name="state" id="state" value="{{ $result->property_address->state  }}" class="form-control">
											<span class="text-danger">{{ $errors->first('state') }}</span>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>{{trans('messages.listing_location.zip_postal_code')}}</label>
											<input type="text" name="postal_code" id="postal_code" value="{{ $result->property_address->postal_code }}" class="form-control">
											<span class="text-danger">{{ $errors->first('postal_code') }}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row m-0 justify-content-between">
											<div class="">
												<a href="{{ url('listing/'.$result->id.'/description') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pt-3 pb-3">
													{{trans('messages.listing_description.back')}}
												</a>
											</div>

											<div class="">
												<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pt-3 pb-3" id="btn_next"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
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
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places&callback=callbackMap'></script>
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
	<script type="text/javascript">
		function updateControls(addressComponents) {
			$('#street_number').val(addressComponents.streetNumber);
			$('#route').val(addressComponents.streetName);
			if (addressComponents.city) {
				$('#city').val(addressComponents.city);
			}
			$('#state').val(addressComponents.stateOrProvince);
			$('#postal_code').val(addressComponents.postalCode);
			$('#country').val(addressComponents.country);
		}

		$('#map_view').locationpicker({
			location: {
				latitude: {{$result->property_address->latitude != ''? $result->property_address->latitude:0 }},
				longitude: {{$result->property_address->longitude != ''? $result->property_address->longitude:0 }}
			},
			radius: 0,
			addressFormat: "",
			inputBinding: {
				latitudeInput: $('#latitude'),
				longitudeInput: $('#longitude'),
				locationNameInput: $('#address_line_1')
			},
			enableAutocomplete: true,
			onchanged: function (currentLocation, radius, isMarkerDropped) {
				var addressComponents = $(this).locationpicker('map').location.addressComponents;
				updateControls(addressComponents);
			},
			oninitialized: function (component) {
				var addressComponents = $(component).locationpicker('map').location.addressComponents;
				updateControls(addressComponents);
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#lis_location').validate({
				rules: {
					address_line_1: {
						required: true,
						maxlength: 255
					},
					address_line_2: {
						maxlength: 255
					},
					city: {
						required: true
					},
					state: {
						required: true
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
				messages: {
					address_line_1: {
						required:  "{{ __('messages.jquery_validation.required') }}",
						maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
						},
					address_line_2: {
						required:  "{{ __('messages.jquery_validation.required') }}",
						maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
						},
					city: {
						required: "{{ __('messages.jquery_validation.required') }}",
					},
					state: {
						required: "{{ __('messages.jquery_validation.required') }}",
					}
				}
			});
		});
	</script>
@endpush