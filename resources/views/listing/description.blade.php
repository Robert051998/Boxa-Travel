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
							<form method="post" id="list_des" action="{{url('listing/'.$result->id.'/'.$step)}}"  accept-charset='UTF-8'>
								{{ csrf_field() }}
								<div class="row">	
									<div class="col-12">
										<h3 class="mt-5 mb-5">{{trans('messages.listing_sidebar.description')}}</h3>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>{{trans('messages.listing_description.listing_name')}} <span class="text-danger">*</span></label>
											<input type="text" name="name" id="name" class="form-control text-16 mt-2" value="{{ old('name', $description->properties->name)  }}" placeholder="" maxlength="100">
											<span class="text-danger">{{ $errors->first('name') }}</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>{{trans('messages.listing_description.summary')}} <span class="text-danger">*</span></label>
											<textarea class="form-control text-16 mt-2" name="summary" rows="6" placeholder=""  ng-model="summary">{{ old('summary', $description->summary)  }} </textarea>
											<span class="text-danger">{{ $errors->first('summary') }}</span>
										</div>
									</div>
								</div>

								<div class="row mb-5">
									<div class="col-md-12">
										{{trans('messages.listing_description.add_more')}} <a href="{{ url('listing/'.$result->id.'/details') }}" class="secondary-text-color" id="js-write-more">{{trans('messages.listing_description.detail')}}</a> {{trans('messages.listing_description.detail_data')}}.
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row m-0 justify-content-between">
											<div class="">
												<a  href="{{ url('listing/'.$result->id.'/basics') }}" class="btn btn-outline-danger">
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
		$('#list_des').validate({
			rules: {
				name: {
					required: true
				},
				summary: {
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
				name: {
					required: "{{ __('messages.jquery_validation.required') }}",
				},
				summary: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength500') }}",
				} 
			}
		});
	});
</script>
@endpush