@extends('template')

@section('main')
<div class="container p-0">
	<div class="row inner-row">
		<div class="col-4 text-center">
			<h1 class="mb-0"><span>{{trans('messages.home.find')}}</span> {{trans('messages.home.perfect')}}</h1>
		</div>
		<div class="col-8 mt-5 mb-5">
			<div class="d-flex w-100 justify-content-between mb-5 pb-5">
				<a aria-label="logo" href="{{ url('/') }}">
					<img src="{{URL::to('images/BoxaTravelLogo.svg')}}" alt="logo" class="img-fluid">
				</a>
			</div>
			<div class="login_form ">
				<h2 class="mb-3">{{trans('messages.forgot_pass.reset_pass')}}</h2>
				@if(Session::has('message'))
					<div class="row ">
						<div class="col-md-12 alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
							<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('message') }}
						</div>
					</div>
				@endif 
				<form id="forgot_password_form" method="post" action="{{url('forgot_password')}}" class='signup-form login-form mt-5' accept-charset='UTF-8'>  
					{{ csrf_field() }}
					<div class="form-group col-sm-12 p-0">
						<label>{{trans('messages.forgot_pass.please_enter_email')}}</label>
						<input type="text" id="email" class="form-control" name="email" placeholder = "Email">
						@if ($errors->has('email'))<label class="text-danger email-error">{{ $errors->first('email') }}</label>@endif
					</div>
				
					<div class="form-group col-sm-12 p-0" >
						<button id="reset_btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100 rounded" type="submit" > <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text">{{trans('messages.forgot_pass.reset_link')}}</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop

@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	jQuery.validator.addMethod("laxEmail", function(value, element) {
			// allow any non-whitespace characters as the host part
			return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
		}, "{{ __('messages.jquery_validation.email') }}" );

	$(document).ready(function () {
		
	$("#reset_btn").on("click", function (e)
    {	
    	$(".email-error").hide();
    });

    $('#forgot_password_form').validate({
        rules: {
			email: {
				required: true,
				maxlength: 255,
				laxEmail: true
			}
        },
        submitHandler: function(form)
        {
     		$("#reset_btn").on("click", function (e)
            {	
            	$("#reset_btn").attr("disabled", true);
                e.preventDefault();
            });
            
            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("{{trans('messages.forgot_pass.reset_link')}}..");
            return true;
        },
        messages: {
		email: {
				required:  "{{ __('messages.jquery_validation.required') }}",
				maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
            }
        }
    });
});
</script>
@endpush