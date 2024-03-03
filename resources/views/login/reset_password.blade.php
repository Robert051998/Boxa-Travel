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
				<h2 class="mb-3">{{trans('messages.forgot_pass.reset_password')}}</h2>
				@if(Session::has('message'))
					<div class="row mt-5">
							<div class="col-md-12 text-13  alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
								<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
								{{ Session::get('message') }}
							</div>
					</div>
				@endif 

				<form method="post" action="{{url('users/reset_password')}}" id='password-form' class='signup-form login-form mt-5' accept-charset='UTF-8'>  
					{{ csrf_field() }}
					<input id="id" name="id" type="hidden" value="{{ $result->id }}">
					<input id="token" name="token" type="hidden" value="{{ $token }}">
					<div class="form-group col-sm-12 p-0">
						<input type="password" class="form-control" id='new_password' name="password" placeholder = "{{trans('messages.forgot_pass.new_pass')}}">
						@if ($errors->has('password')) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
					</div>

					<div class="form-group col-sm-12 p-0">
						<input type="password" class="form-control" id='password_confirmation' name="password_confirmation" placeholder = "{{trans('messages.forgot_pass.confirm_pass')}}">
						@if ($errors->has('password_confirmation')) <p class="error-tag">{{ $errors->first('password_confirmation') }}</p> @endif
					</div>

					<div class="form-group col-sm-12 p-0" >
						<button class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100 rounded" type="submit">
						{{trans('messages.forgot_pass.reset_pass')}}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop

@push('css')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#password-form').validate({
        rules: {
			password: {
				required: true,
				minlength: 6,
			},

			password_confirmation: {
				required: true,
				minlength: 6,
				equalTo: "#new_password"
			}
        },

        messages: {
            password: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
            },

            password_confirmation: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
                equalTo:   "{{ __('messages.jquery_validation.equalTo') }}",
            }
        }
    });
});
</script>
@endpush