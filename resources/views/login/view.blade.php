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
				<div class="d-flex align-items-center">
					<span class="already">{{trans('messages.login.do_not_have_an_account')}}</span>
					<a href="{{URL::to('/')}}/signup" class="btn btn-secondary ml-2">{{trans('messages.sign_up.sign_up')}}</a>
				</div>
			</div>
			<div class="login_form ">

			
			@if(Session::has('message'))
							<div class="alert-message p-3 mb-4 text-center {{Session::get('alert-class')}}">{{ Session::get('message') }}</div>
						@endif
				<h3 class="text-success mb-4">{{trans('messages.sign_up.login')}}</h3>
				<h2 class="mb-3">{{trans('messages.home.welcome_back')}}</h2>
				<h3 class="font-weight-normal">{{trans('messages.home.account_details')}}</h3>				
				<form id="login_form" method="post" action="{{url('authenticate')}}"  accept-charset='UTF-8' class="mt-5">
					{{ csrf_field() }}
					<div class="form-group col-sm-12 p-0">
						<label for="first_name">{{ trans('messages.login.email') }} <span class="text-13 text-danger">*</span></label>
						@if ($errors->has('email'))
							<p class="error">{{ $errors->first('email') }}</p>
						@endif
						<input type="email" class="form-control text-14" value="{{ old('email') }}" name="email" placeholder = "{{trans('messages.login.email')}}">
						
					</div>

					<div class="form-group col-sm-12 p-0">
						<label for="first_name">{{ trans('messages.login.password') }} <span class="text-13 text-danger">*</span></label>
						@if ($errors->has('password'))
							<p class="error">{{ $errors->first('password') }}</p>
						@endif
						<input type="password" class="form-control text-14" value="" name="password" placeholder = "{{trans('messages.login.password')}}">
					</div>

					<div class="d-flex w-100 justify-content-between mb-3 mt-3">
						<div class="">
							<input type="checkbox" class='remember_me' id="remember_me2" name="remember_me" value="1">
							{{trans('messages.login.remember_me')}}
						</div>

						<div class="">
							<a href="{{URL::to('/')}}/forgot_password" class="forgot-password text-right">{{trans('messages.login.forgot_pwd')}}</a>
						</div>
					</div>

					<div class="form-group col-sm-12 p-0" >
						<button type='submit' id="btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100 rounded"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="btn_next-text">{{trans('messages.login.login')}}</span>
						</button>
					</div>
				</form>
				<div class="continue text-center mt-5 mb-5">
					<span>{{trans('messages.home.login_with')}}</span>
				</div>
				<div class="d-flex w-100 justify-content-between social-login">
					@if($social['facebook_login'])
						<a href="{{ isset($facebook_url) ? $facebook_url:URL::to('facebookLogin') }}">
							<button class="btn btn-outline-primary">
								<img src="{{URL::to('images/Facebook.svg')}}" alt="Facebook" /><span class="ml-3">{{trans('messages.sign_up.sign_up_with_facebook')}}</span>
							</button>
						</a>
					@endif
					@if($social['google_login'])
						<a href="{{URL::to('googleLogin')}}">
							<button class="btn btn-outline-primary">
								<img src="{{URL::to('images/Google.svg')}}" alt="Google" width="24px"/><span class="ml-3">{{trans('messages.sign_up.sign_up_with_google')}}</span>
							</button>
						</a>
					@endif
				</div>
				<hr class="mt-5 mb-3"/>
				<div class="text-center fs-6">
					{{trans('messages.home.term_conditions_before')}} <a href="https://help.boxatravel.com/terms-conditions/" target="_blank">{{trans('messages.home.terms_conditions')}} </a> and <a href="https://help.boxatravel.com/guest/privacy-policy/" target="_blank">{{trans('messages.home.privacy_policy')}}</a>.
				</div>
				<hr class="mt-3 mb-3"/>
				<div class="text-center fs-6">
					{{trans('messages.home.rights')}}. <br>Copyright – 2023 Boxa Travel LLC.
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('validation_script')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
jQuery.validator.addMethod("laxEmail", function(value, element) {
	// allow any non-whitespace characters as the host part
	return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
}, "{{ __('messages.jquery_validation.email') }}" );

$(document).ready(function () {
	$('#login_form').validate({
		rules: {
			email: {
				required: true,
				maxlength: 255,
				laxEmail: true
			},

			password: {
				required: true
			}
		},
		submitHandler: function(form)
        {
 			$("#btn").on("click", function (e)
            {
            	$("#btn").attr("disabled", true);
                e.preventDefault();
            });


            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("{{trans('messages.login.login')}}..");
            return true;
        },
		messages: {
			email: {
				required:  "{{ __('messages.jquery_validation.required') }}",
				maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
			},

			password: {
				required: "{{ __('messages.jquery_validation.required') }}",
			}
		}
	});
});
</script>
@endsection
