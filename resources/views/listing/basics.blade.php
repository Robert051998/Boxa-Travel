@extends('template')
@section('main')
<main>
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-xl-10 col-lg-9 min-height right-section">
			<div class="main-panel pro_listing">
				<div class="row">
					<div class="col-md-3 bg-lightgreen">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mb-5">
						<div class="inner-main-panel">
							<form method="post" action="{{url('listing/'.$result->id.'/'.$step)}}"  accept-charset='UTF-8' id="listing_bes">
								{{ csrf_field() }}
								<div class="inner-inner-form-row row">
									<div class="col-12">
										<h3 class="mt-5 mb-5">Basic</h3>
									</div>
									<div class="form-group col-md-12 main-panelbg">
										<h4 class="">{{trans('messages.listing_basic.room_bed')}}</h4>
									</div>
								
									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.bedroom')}}</label>
										<select name="bedrooms" id="basics-select-bedrooms"  class="form-control">
											@for($i=1;$i<=10;$i++)
											<option value="{{ $i }}" {{ ($i == $result->bedrooms) ? 'selected' : '' }}>
											{{ $i}}
											</option>
											@endfor 
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.bed')}}</label>
										<select name="beds" id="basics-select-beds"  class="form-control">
											@for($i=1;$i<=16;$i++)
												<option value="{{ $i }}" {{ ($i == $result->beds) ? 'selected' : '' }}>
												{{ ($i == '16') ? $i.'+' : $i }}
												</option>
											@endfor 
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.bathroom')}}</label>
										<select name="bathrooms" id="basics-select-bathrooms"  class="form-control">
											@for($i=0.5;$i<=8;$i+=0.5)
											<option class="bathrooms" value="{{ $i }}" {{ ($i == $result->bathrooms) ? 'selected' : '' }}>
											{{ ($i == '8') ? $i.'+' : $i }}
											</option>
											@endfor
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.bed_type')}}</label>
										<select  name="bed_type"  class="form-control ">
											@foreach($bed_type as $key => $value)
											<option value="{{ $key }}" {{ ($key == $result->bed_type) ? 'selected' : '' }}>{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<hr />
								<div class="inner-form-row row">
									<div class="form-group col-md-12">
										<h4 class="">{{trans('messages.listing_basic.listing')}}</h4>
									</div>
								
									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.property_type')}}</label>
										<select name="property_type"  class="form-control"> 
											@foreach($property_type as $key => $value)
											<option value="{{ $key }}" {{ ($key == $result->property_type) ? 'selected' : '' }}>{{ $value }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="inputState">{{trans('messages.listing_basic.room_type')}}</label>
										<select name="space_type" class="form-control">
											@foreach($space_type as $key => $value)
											<option value="{{ $key }}" {{ ($key == $result->space_type) ? 'selected' : '' }}>{{ $value }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-md-6 ">
										<label for="inputState">{{trans('messages.listing_basic.accommodate')}}</label>
										<select name="accommodates" id="basics-select-accommodates" class="form-control">
										@for($i=1;$i<=16;$i++)
											<option class="accommodates" value="{{ $i }}" {{ ($i == $result->accommodates) ? 'selected' : '' }}>
											{{ ($i == '16') ? $i.'+' : $i }}
											</option>
										@endfor
										</select>
									</div>
								</div>
								<hr />
								<div class="inner-form-row row">
									<div class="form-group col-md-12">
										<h4 class="">Pets Allowed?</h4>
									</div>
								
									<div class="form-group col-md-6">
										<select name="pets_allowed" class="form-control">
											<option value="1" {{ (1 == $result->pets_allowed) ? 'selected' : '' }}>Yes</option>
											<option value="0" {{ (0 == $result->pets_allowed) ? 'selected' : '' }}>No</option>
										</select>
									</div>
								</div>
								<hr />
								<div class="inner-form-row row">
									<div class="form-group col-md-12">
										<h4 class="">Certifications <span class="text-danger">*</span></h4>
										<span class="mb-3 error d-block"  id="at_least_one"></span>
									</div>
									@foreach($certifications as $certification)
									<div class="col-md-6">
										<label class="label-large label-inline amenity-label mb-4">
											<input type="checkbox" value="{{ $certification->id }}" name="certifications[]" {{ in_array($certification->id, $property_certifications) ? 'checked' : '' }}>											
											<span>{{ $certification->name }}</span>
										</label>
									</div>
									@endforeach									
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Other Certifications (comma separated)</label>
											<input type="text" name="other_certifications" id="other_certifications" value="{{ $result->other_certifications }}" class="form-control">
											<span class="text-danger">{{ $errors->first('other_certifications') }}</span>
										</div>
									</div>
								</div>		
								<hr />						
								<div class="inner-form-row row">
									<div class="form-group col-md-12">
										<h4 class="">Upload Certifications Documents <span class="text-danger">*</span></h4>
										<span class="mb-3 error d-block"  id="at_least_one">{{ $errors->first('certifications') }}</span>
									</div>
									<div class="col-md-12">
										<div class="form-group upload form-group photo-upload "> 
											<div class="row">
												<div class="col-md-12">
													<div class="alert alert-success m-0 mb-4 text-center doc-success-message display-off"></div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="file-upload text-center d-block m-auto">
														<input class="form-control w-full" type="file" name="certification_document" id="certification_document" />
														<img src="{{URL::to('images/uploads.svg')}}" alt="Upload File"/>
														<div class="doc-error-message display-off"></div>												
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12  text-center">
													<button type="button" class="btn btn-large btn-photo btn vbtn-outline-success mb-3" id="up_button" disabled>
														<i class="spinner fa fa-spinner fa-spin d-none" id="up_spin"></i>
														<span id="up_button_txt">{{ trans('messages.listing_description.upload') }}</span>
													</button>
												</div>
											</div>
                                        </div>
										
									</div>
									
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-header  m-0" id="document-list">
												<thead>
													<tr class="">
														<th>Document</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="certification_document">
													@if(count ($certification_documents) == 0)
														<tr class="no-document">
															<td colspan="2">No Document Uploaded</td>
														</tr>
													@endif
													@foreach($certification_documents as $certification_document)
													<tr class="">
														<td><a href="{{$certification_document->document}}" target="_blank">{{$certification_document->name}}<a></td>
														<td><a href="{{ url('listing/delete-certification-document/'.$certification_document->id) }}"><i class="fa fa-trash"></i></a></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									
								</div>
								<div class="row">
									
								</div>
								<div class="inner-form-row row float-right ">
									<div class="col-md-12">
										<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-4 pr-4 pt-3 pb-3" id="btn_next"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
											<span id="btn_next-text">{{trans('messages.listing_basic.next')}}</span> 
										</button>
									</div>
								</div>
							</div>
						</form>
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
		$('#listing_bes').validate({
			rules: {
				'certifications[]': {
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


                // $(".spinner").removeClass('d-none');
                $("#btn_next-text").text("{{trans('messages.listing_basic.next')}} ..");
                return true;
            },
			messages: {
				'certifications[]': {
					required: "{{ __('messages.jquery_validation.required') }}",
				}
			},
			errorPlacement: function(error, element) {			
			if (element.attr("name") == "certifications[]") {
				error.insertAfter("#at_least_one");
			} else {
				error.insertAfter(element);
			}
			},
		});
	});
</script>
<script>
	function uploadfile(field){    
		var formData = new FormData();            
		var files = $('#certification_document')[0].files;            
		var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
		formData.append('id', {{$result->id}});
		formData.append('certification_document',files[0]);
		formData.append('_token',CSRF_TOKEN);
			
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {                        
					if (evt.lengthComputable) {
						var percentComplete = ((evt.loaded / evt.total) * 100);
						$(".progress-bar").width(percentComplete + '%');
						$(".progress-bar").html(percentComplete.toFixed(2) +'%');
					}
				}, false);
				return xhr;
			},
			type: 'POST',
			url: '{{ url("listing/upload-certification-document") }}',
			data: formData,
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$(".progress-bar").width('0%');
				$(".progress").removeClass('display-off');
				$("#certification_document").attr('disabled', true);
				$("#btn_next").attr("disabled", true);
				$(".doc-error-message").addClass('display-off');
				$(".doc-success-message").addClass('display-off');
				$("#up_spin").removeClass('d-none');
				$("#up_button_txt").text("{{trans('messages.listing_description.upload')}}..").attr("disabled", true);
				$("#up_button").attr("disabled", true);
			},
			error:function(resp){                    				
				console.log("🚀 ~ file: basics.blade.php:269 ~ uploadfile ~ resp:", JSON.parse(resp.responseText).certification_document[0])
				$(".progress").addClass('display-off');
				$("#certification_document").attr('disabled', false);
				$("#btn_next").attr("disabled", false);
				$(".doc-error-message").removeClass('display-off').text(JSON.parse(resp.responseText).certification_document[0]);	
				$("#up_spin").addClass('d-none');
				$("#up_button_txt").text("{{trans('messages.listing_description.upload')}}").attr("disabled", false);
				$("#up_button").attr("disabled", falses);			
			},
			success: function(resp){
				$("#certification_document").attr('disabled', false);
				$("#btn_next").attr("disabled", false);
				$("#up_button_txt").text("{{trans('messages.listing_description.upload')}}")
				
				$("#document-list").append('<tr class=""><td><a href="'+resp.document+'">'+resp.name+'</a></td><td><a href="'+resp.delete_url+'"><i class="fa fa-trash"></i></a></td></tr>');
				$(".progress").addClass('display-off'); 
				$(".no-document").addClass('display-off');
				$("#up_spin").addClass('d-none');
				$(".doc-success-message").removeClass('display-off').text('File Uploaded Successfully!');
			}
		});
	}
	$("#certification_document").change( function(field) {            
		$("#up_button").attr("disabled", false);
	});
	$("#up_button").click( function(field) {            
		uploadfile(field);
	});
</script>

@endpush
