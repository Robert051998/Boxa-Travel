@extends('template')
<link rel="stylesheet" type="text/css" href="{{ url('css/jquery-ui.min.css')}}" />
@section('main')
<!-- Modal -->
<!-- Button trigger modal -->
<div class="modal calender_modal" id="hotel_date_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title" id="exampleModalLabel">{{trans('messages.listing_calendar.calendar_title')}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body p-4 m-0">
				<form method="post" action="hotel_date_package/" class='form-horizontal m-0' id='dtpc_form'>
					{{ csrf_field() }}
					<p class="bg-success text-white text-center text-16 d-none" id="model-message"></p>
					<input type="hidden" value="{{ $result->id }}" name="property_id" id="dtpc_property_id">

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.listing_calendar.start_date')}}<em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="start_date" id='dtpc_start' placeholder = "{{trans('messages.listing_calendar.start_date')}}" autocomplete = 'off'>
							<span class="text-danger" id="error-dtpc-start">{{ $errors->first('start_date') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob" >{{trans('messages.listing_calendar.end_date')}} <em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="end_date" id='dtpc_end' placeholder = "{{trans('messages.listing_calendar.end_date')}}" autocomplete = 'off'>
							<span class="text-danger" id="error-dtpc-end">{{ $errors->first('end_date') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.listing_calendar.price')}} <em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="price" id='dtpc_price' placeholder = "">
							<span class="text-danger" id="error-dtpc-price">{{ $errors->first('price') }}</span>
						</div>
					</div>

					<div class="form-group">
                        <div class="col-md-12 p-0">
                          <label for="input_dob">{{trans('messages.listing_calendar.minimum_stay')}}</label>
                          <input type="text" class="form-control text-14" name="minstay" id='dtpc_stay' placeholder = "Day..">
                          <span class="text-danger" id="error-dtpc-stay">{{ $errors->first('minstay') }}</span>
                        </div>
                      </div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.ical.status')}}<em class="text-danger">*</em></label>
							<select class="form-control text-14" name="status" id="dtpc_status">
								<option value="" >--{{trans('messages.ical.please_select')}}--</option>
								<option value="Available">Available</option>
								<option value="Not available">Not Available</option>
							</select>
							<span class="text-danger" id="error-dtpc-status">{{ $errors->first('status') }}</span>
						</div>
					</div>

					<div class="col-md-12 mt-2 p-0">
						<div class="row m-0 justify-content-between ">
							<button type="button" class="btn btn-outline-danger " data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>
							<button id="price_btn" class="btn vbtn-outline-success" type="submit" name="submit">
								<i id="price_spinner" class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="price_next-text">{{trans('messages.listing_calendar.submit')}}</span> 	
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal End -->
<!-- Import Calendar Modal Start -->
<!-- Modal -->
<div class="modal calender_modal" id="import_calendar_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title">{{trans('messages.ical.import_a_new')}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="">&times;</span>
				</button>
			</div>

			<div class="modal-body p-4">
				<form id='icalendar_form' class="m-0">
					<p class="bg-success text-white text-center d-none" id="icalendar-model-message"></p>
					<input type="hidden" value="{{ $result->id }}" name="property_id" id="icalendar_property_id">
				
					<div class="form-group">
						<label for="icalendar_url" class="col-form-label">{{trans('messages.ical.calendar_address')}} <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="url" id='icalendar_url' placeholder="{{trans('messages.ical.paste_calendar_address')}}" autocomplete = 'off'>
						<span class="text-danger" id="error-icalendar-url">{{ $errors->first('url') }}</span>
					</div>

					<div class="form-group">
						<label for="name" class="col-form-label">{{trans('messages.ical.name_calendar')}} <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id='icalendar_name' placeholder = "{{trans('messages.ical.your_calendar_name')}}" autocomplete = 'off'>
						<span class="text-danger" id="error-icalendar-name">{{ $errors->first('name') }}</span>
					</div>

					<div class="form-group">
						<label for="name" class="col-form-label">{{trans('messages.ical.color_of_calendar')}}<em class="text-danger">*</em></label>
						<select class="form-control" name="color" id="color">
						<option value="">--{{trans('messages.ical.please_select')}}--</option>
						<option value="#7FFFD4" style="background-color: Aquamarine;">Aquamarine</option>
						<option value="#0000FF" style="background-color: Blue;">Blue</option>
						<option value="#000080" style="background-color: Navy;color: #FFFFFF;">Navy</option>
						<option value="#800080" style="background-color: Purple;color: #FFFFFF;">Purple</option>
						<option value="#FF1493" style="background-color: DeepPink;">DeepPink</option>
						<option value="#EE82EE" style="background-color: Violet;">Violet</option>
						<option value="#FFC0CB" style="background-color: Pink;">Pink</option>
						<option value="#006400" style="background-color: DarkGreen;color: #FFFFFF;">DarkGreen</option>
						<option value="#008000" style="background-color: Green;color: #FFFFFF;">Green</option>
						<option value="#9ACD32" style="background-color: YellowGreen;">YellowGreen</option>
						<option value="#FFFF00" style="background-color: Yellow;">Yellow</option>
						<option value="#FFA500" style="background-color: Orange;">Orange</option>
						<option value="#FF0000" style="background-color: Red;">Red</option>
						<option value="#A52A2A" style="background-color: Brown;">Brown</option>
						<option value="#DEB887" style="background-color: BurlyWood;">BurlyWood</option>
						<option value="custom">{{trans('messages.ical.custom')}}</option>
						</select>
						<span class="text-danger" id="error-dtpc-color">{{ $errors->first('color') }}</span>
					</div>

					<div class="col-md-12 mt-2 p-0">
						<div class="row m-0 justify-content-between ">
							<button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>
							<button class="btn vbtn-outline-success" type="submit" id="import_btn" name="Import"> <i class="spinner fa fa-spinner fa-spin d-none" id="import_spinner" ></i>
								<span id="import_btn-text">{{trans('messages.ical.import_calendar')}}</span>
							 </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Import Calendar Modal End -->

<!-- Export Icalendar Modal Starts -->

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal calender_modal" id="calendar_export_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title">{{trans('messages.ical.export_calendar')}}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="">&times;</span>
				</button>
			</div>
			
			<div class="modal-body p-4">
				<div class="form-group">
					<p class="fs-6">{{trans('messages.ical.copy_paste_link')}}</p>
				
				</div>

				<div class="input-group mb-3">
					<input type="text" class="form-control" aria-describedby="basic-addon2" value="{{ url('icalender/export/'.$result->id.'.ics') }}" readonly="" id="myInput">
					<div class="input-group-append">
						<button class="m-0 btn vbtn-outline-success" onclick="myFunction()" id="copied">Copy</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Export Icalendar Modal End -->

<main>
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-xl-10 col-lg-9 min-height right-section">
			<div class="main-panel pro_listing">
				@if(Session::has('message'))
				<div class="row">
					<div class="w-100 alert {{ Session::get('alert-class') }}  alert-dismissible fade show text-center" role="alert">
						{{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
				@endif 
				<div class="row">
					<div class="col-md-3 bg-lightgreen">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mb-5">
						<div class="inner-main-panel">
							<form id="form_term_conditions" name="form_term_conditions" action="{{ url('properties/'.$result->slug) }}" method="get">
								<div class="row">
									<div class="col-md-12">
										<h3 class="mt-5 mb-5">Calendar</h3>
										<h4 class="mb-5">Click on calendar to edit specific dates</h4>
									</div>
									<div class="col-md-12">
										<div class="row">
											<form method='post' action="property-save/{{$result->id}}/pricing" class="w-100">
												<input type="hidden" id="dtpc_property_id1" value="{{$result->id}}">
												<div class="col-md-12" >
													<div id="calender-dv">
														{!! $calendar !!}
													</div>
												</div>
											</form>
										</div>

										<div class="row justify-content-start mt-5">
											<div class="col-12 m-0">
												<ul class="list-inline">
													<li class="list-inline-item mt-4">
														<a class="js-calendar-sync text-white text-16 btn secondary-bg " data-prevent-default="true" href="{{ url('icalendar/synchronization/'.$result->id) }}" id="cal_sync"><i class="spinner fa fa-spinner fa-spin d-none" id="cal_sync_spinner"></i> {{trans('messages.ical.sync_with_other')}}</a>
													</li>

													<li class="list-inline-item mt-4">
														<button class="text-white text-16 btn secondary-bg imporpt_calendar">{{trans('messages.ical.import_calendar')}}</button>
													</li>

													<li class="list-inline-item mt-4">
														<button class="text-white text-16 btn secondary-bg" id="export_icalendar">{{trans('messages.ical.export_calendar')}}</button>    
													</li>
												</ul>
											</div>
										</div>
									</div>
									
									<div class="col-md-12 mt-5">
										<div>
											<label for="term_conditions" class="inline-flex items-center">
												<input id="term_conditions" type="checkbox" class="" name="term_conditions">
												<span>By signing up we accept <a href="https://help.boxatravel.com/terms-conditions/" target="_blank">terms & conditions</a> of the BoxaTravel.</span>
											</label>
										</div>
									</div>
									<div class="col-md-12 mt-5">
											<div class="row m-0 justify-content-between">
												<div class="">
													<a  data-prevent-default="" href="{{ url('listing/'.$result->id.'/booking') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3">
														{{trans('messages.listing_description.back')}}
													</a>
												</div> 
												<div class="">													
													<button  data-prevent-default="" href="{{ url('properties/'.$result->slug) }}" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="btn_next">
														<i class="spinner fa fa-spinner fa-spin d-none" id="btn_next_spinner"></i>
														<span id="btn_next-text">Finish</span> 
													</button>
												</div>
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
<script src="{{ url('js/front.js') }}"></script>
<script src="{{ url('js/jquery-ui.js') }}"></script>
<script type="text/javascript">
	$(document).on('click', '#cal_sync', function() {
		$(this).addClass('disabled');
		$("#cal_sync_spinner").removeClass('d-none');		
	});

	$('#form_term_conditions').validate({
		rules: {
			term_conditions: {
				required: true,				
			},			
		},		
	});
	$('#icalendar_form').validate({  
			rules: {
				url: {
					required: true,
					maxlength: 255,
				},
				name: {
					required:true,
					maxlength:255,
				}
	        },    
	        submitHandler: function(form)
	        {
	            $("#import_btn").on("click", function (e)
                {	
                	$("#import_btn").attr("disabled", true);
                    e.preventDefault();
                });

	            $("#import_spinner").removeClass('d-none');
	            $("#import_btn-text").text("{{ trans('messages.ical.import_calendar') }} ..");
	            return true;

	        },
		    messages: {
	            url: {
	                required:  "{{ __('messages.jquery_validation.required') }}",
	                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
	            },

	            name: {
	                required:  "{{ __('messages.jquery_validation.required') }}",
	                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
	                equalTo:   "{{ __('messages.jquery_validation.equalTo') }}",
	            }
	        }   
	    });

</script>
@endpush 