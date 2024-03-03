@extends('template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('js/intl-tel-input-13.0.0/build/css/intlTelInput.min.css')}}">
@endpush
@section('main')
<div class="container p-0">
	<div class="row inner-row">
		<div class="col-4 text-center">
			<h1 class="mb-0"><span>{{trans('messages.home.find')}}</span> {{trans('messages.home.perfect')}}</h1>
		</div>
		<div class="col-8 mt-5 mb-5">
			<div class="d-flex w-100 justify-content-between  mb-5">
				<a aria-label="logo" href="{{ url('/') }}">
					<img src="{{URL::to('images/BoxaTravelLogo.svg')}}" alt="logo" class="img-fluid">
				</a>
				<div class="d-flex align-items-center">
					<span class="already">{{trans('messages.home.already')}}</span>
					<a href="{{URL::to('/')}}/login" class="btn btn-secondary ml-2" onClick="disconnectWallet()">{{trans('messages.header.login')}}</a>
				</div>
			</div>
			<div class="login_form">
				<h3 class="text-success mb-4">{{trans('messages.sign_up.sign_up')}}</h3>
				<h2 class="mb-3">{{trans('messages.home.create_account')}}</h2>
				<h3 class="font-weight-normal">{{trans('messages.home.get_started')}}</h3>
				<form id="signup_form" name="signup_form" method="post" action="{{url('create')}}" class='mt-5 signup-form login-form' accept-charset='UTF-8' onsubmit="return ageValidate();">
					{{ csrf_field() }}
					<div class="row m-0">
						<input type="hidden" name='email_signup' id='form'>
						<input type="hidden" name="default_country" id="default_country" class="form-control">
						<input type="hidden" name="carrier_code" id="carrier_code" class="form-control">
						<input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control">
						<div class="form-group col-sm-12 p-0">
							<div class="row p-0">
								<div class="col-sm-6">
									<label for="first_name">{{ trans('messages.sign_up.first_name') }} <span class="text-13 text-danger">*</span></label>
									@if ($errors->has('first_name')) <p class="error-tag">{{ $errors->first('first_name') }}</p> @endif
									<input type="text" class='form-control text-14 p-2' value="{{ old('first_name') }}" name='first_name' id='first_name' placeholder='{{ trans('messages.sign_up.first_name') }}'>
								</div>
								<div class="col-sm-6">
									<label for="last_name">{{ trans('messages.sign_up.last_name') }} <span class="text-13 text-danger">*</span></label>
									@if ( $errors->has('last_name') ) <p class="error-tag">{{ $errors->first('last_name') }}</p> @endif
									<input type="text" class='form-control text-14 p-2' value="{{ old('last_name') }}" name='last_name' id='last_name' placeholder='{{ trans('messages.sign_up.last_name') }}'>
								</div>
							</div>
						</div>

						<div class="form-group col-sm-12 p-0">
                            <label for="email">{{ trans('messages.login.email') }} <span class="text-13 text-danger">*</span></label>
								<input type="text" class='form-control text-14 p-2' value="{{old('email')}}" name='email' id='email' placeholder='{{ trans('messages.login.email') }}'>
								@if ($errors->has('email'))
									<p class="error-tag">
									{{ $errors->first('email') }}
									</p>
								@endif
								<div id="emailError"></div>
						</div>

						<div class="form-group col-sm-12 p-0">
                            <label for="PhoneNumber">{{ trans('messages.users_profile.phone') }} <span class="text-13 text-danger">*</span></label>
								<input type="tel" class="form-control text-14 p-2" id="phone" name="phone" required>
								<span id="tel-error" class="text-13 text-danger"></span>
								<span id="phone-error" class="text-13 text-danger"></span>
						</div>

						<div class="form-group col-sm-12 p-0">
                            <label for="password">{{ trans('messages.login.password') }} <span class="text-13 text-danger">*</span></label>
								@if ( $errors->has('password') ) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
								<input type="password" class='form-control text-14 p-2' name='password' id='password' placeholder='{{ trans('messages.login.password') }}'>
						</div>

						<div class="col-sm-12 p-0">
							<label class="l-pad-none text-14">{{ trans('messages.sign_up.birth_day') }} <span class="text-13 text-danger">*</span></label>
						</div>

						<div class="col-sm-12 p-0">
								@if ($errors->has('birthday_month') || $errors->has('birthday_day') || $errors->has('birthday_year'))
								<p class="error-tag">{{ $errors->first('date_of_birth') }}</p>
								@else
									<p class="error-tag">{{ $errors->first('date_of_birth') }}</p>
								@endif
						</div>

						<div class="form-group col-sm-12 m-0">
								<div class="row p-0">
									<div class="col-sm-4 pl-0 mt-2">
											<select name='birthday_month' class='form-control text-14 p-2' id='user_birthday_month'>
												<option value=''>{{ trans('messages.sign_up.month') }}</option>
												@for($m=1; $m<=12; ++$m)
													<option value="{{ $m }}" {{old('birthday_month')==$m?'selected="selected"':''}}>{{date('F', mktime(0, 0, 0, $m, 1))}}</option>
												@endfor
											</select>
									</div>

									<div class="col-sm-4 mt-2">
										<select name='birthday_day' class='form-control text-14' id='user_birthday_day'>
											<option value=''>{{trans('messages.sign_up.day')}}</option>
											@for($m=1; $m<=31; ++$m)
											<option value="{{$m}}" {{old('birthday_day')==$m?'selected="selected"':''}}>{{$m}}</option>
											@endfor
										</select>
									</div>

									<div class="col-sm-4 pr-0 mt-2">
									<select name='birthday_year' class='form-control text-14' id='user_birthday_year'>
										<option value=''>{{ trans('messages.sign_up.year') }}</option>
										@for($m=date('Y'); $m > date('Y')-100; $m--)
										<option value="{{ $m }}"{{old('birthday_year')==$m?'selected="selected"':''}}>{{ $m }}</option>
										@endfor
									</select>
									</div>
								</div>

							<span class="text-danger text-13">
								<label id='dobError'></label>
							</span>
						</div>
						<div class="d-flex w-100 justify-content-between mb-5">
							<div>
								<label for="remember" class="inline-flex items-center">
									<input id="remember" type="checkbox" class="" name="remember">
									<span class="ml-2 text-sm ">{{ trans('messages.home.platform_accept') }} <a href="https://help.boxatravel.com/terms-conditions/" target="_blank">{{trans('messages.home.terms_conditions')}}</a> {{trans('messages.home.of_boxa')}}.</span>
								</label>
							</div>
						</div>
						<button type='submit' id="btn" class="btn btn-primary m-0"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text">{{ trans('messages.sign_up.sign_up') }}</span>
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

@push('scripts')
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		$('select').on('change', function() {
			var dobError = '';
			var day = document.getElementById("user_birthday_day").value;
			var month = document.getElementById("user_birthday_month").value;
			var y = document.getElementById("user_birthday_year").value;
			var year = parseInt(y);
			var year2 = signup_form.birthday_year;
			var age = 18;

			var setDate = new Date(year + age, month - 1, day);
			var currdate = new Date();
			if (day == '' || month == '' || y == '') {
				$('#dobError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.required') }}"+'</label>');
				year2.focus();
				return false;
			}
			else if (setDate > currdate) {
				$('#dobError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.age_greater_than_18') }}"+'</label>');
					year2.focus();
					return false;
				}
				else
				{
					$('#dobError').html('<span class="text-danger"></span>');
					return true;
				}
			});

		function ageValidate()
		{
			var dobError = '';
			var day = document.getElementById("user_birthday_month").value;
			var month = document.getElementById("user_birthday_day").value;
			var y = document.getElementById("user_birthday_year").value;
			var year = parseInt(y);
			var year2 = signup_form.birthday_year;
			var age = 18;

			var setDate = new Date(year + age, month - 1, day);
			var currdate = new Date();
			if (day == '' || month == '' || y == '') {
				$('#dobError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.required') }}"+'</label>');
				year2.focus();
				return false;
			}
			else if (setDate > currdate) {
				$('#dobError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.age_greater_than_18') }}"+'</label>');
				year2.focus();
				return false;
				}
				else
				{
				$('#dobError').html('<span class="text-danger"></span>');
				return true;
				}
			}

			$('#signup_form').validate({
				rules: {
					first_name: {
						required: true,
						maxlength: 255
					},
					last_name: {
						required: true,
						maxlength: 255
					},
					email: {
						required: true,
						maxlength: 255,
						laxEmail: true
					},
					password: {
						required: true,
						minlength: 6
					},
					birthday_month: {
						required: true
					},
					birthday_day: {
						required: true
					},
					birthday_year: {
						required: true,
						minAge: 18
					},
					remember: {
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
	                $("#btn_next-text").text("{{trans('messages.sign_up.sign_up')}}..");
	                return true;
	            },

	            errorPlacement: function (error, element) {
					$('#user_birthday_month-error').addClass('d-none');
					$('#user_birthday_day-error').addClass('d-none');
					error.insertAfter(element);
					$('#user_birthday_year-error').addClass('d-none');

				},

				messages: {
				first_name: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
				},
				last_name: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
				},
				email: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
				},
				password: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					minlength: "{{ __('messages.jquery_validation.minlength6') }}",
				},
				birthday_day: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				},
				birthday_month: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				},
				birthday_year: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				},
				remember: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				}
				}
			});

			jQuery.validator.addMethod("laxEmail", function(value, element) {
				return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
			}, "{{ __('messages.jquery_validation.email') }}" );


			$(document).on('blur keyup', '#email', function() {
				var emailError = '';
				var email      = $('#email').val();
				var _token     = $('input[name="_token"]').val();
				$('.error-tag').html('').hide();
				if(email != '') {
				$.ajax({
					url:"{{ route('checkUser.check') }}",
					method:"POST",
					data:{
							email:email,
							"_token": "{{ csrf_token() }}",
							},
					success:function(result)
					{
						if (result == 'not_unique') {
							$('#emailError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.email_existed') }}"+'</label>');
							$('#email').addClass('has-error');
							$('#btn').attr('disabled', 'disabled');
						} else {
							$('#email').removeClass('has-error');
							$('#emailError').html('');
							$('#btn').attr('disabled', false);
						}
					}
				})
				} else {
					$('#emailError').html('');
				}

		});

	</script>

	<script type="text/javascript">
		var hasPhoneError = false;
		var hasEmailError = false;

		//jquery validation
		$.validator.setDefaults({
			highlight: function(element) {
				$(element).parent('div').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).parent('div').removeClass('has-error');
			},
			errorPlacement: function (error, element) {
					$('.error-tag').html('').hide();
					$('#emailError').html('').hide();
					error.insertAfter(element);
			}
		});

		/*
		intlTelInput
		*/
		$(document).ready(function()
		{
			$("#phone").intlTelInput({
				separateDialCode: true,
				nationalMode: true,
				preferredCountries: ["us"],
				autoPlaceholder: "polite",
				placeholderNumberType: "MOBILE",
				utilsScript: '{{ URL::to('/') }}/js/intl-tel-input-13.0.0/build/js/utils.js'
			});

			var countryData = $("#phone").intlTelInput("getSelectedCountryData");
			$('#default_country').val(countryData.iso2);
			$('#carrier_code').val(countryData.dialCode);

			$("#phone").on("countrychange", function(e, countryData)
			{
				formattedPhone();
				// log(countryData);
				$('#default_country').val(countryData.iso2);
				$('#carrier_code').val(countryData.dialCode);
				if ($.trim($(this).val()) !== '') {
					//Invalid Number Validation - Add
					if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
						$('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
						hasPhoneError = true;
						$('#phone-error').hide();
					} else  {
						$('#tel-error').html('');

						$.ajax({
							method: "POST",
							url: "{{url('duplicate-phone-number-check')}}",
							dataType: "json",
							cache: false,
							data: {
								"_token": "{{ csrf_token() }}",
								'phone': $.trim($(this).val()),
								'carrier_code': $.trim(countryData.dialCode),
							}
						})
						.done(function(response)
						{
							if (response.status == true) {
								$('#tel-error').html('');
								$('#phone-error').show();

								$('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
								hasPhoneError = true;
								enableDisableButton();
							} else if (response.status == false) {
								$('#tel-error').show();
								$('#phone-error').html('');

								hasPhoneError = false;
								enableDisableButton();
							}
						});
					}
				} else {
					$('#tel-error').html('');
					$('#phone-error').html('');
					hasPhoneError = false;
					enableDisableButton();
				}
			});
		});

		$(document).ready(function()
		{
			$("input[name=phone]").on('blur keyup', function(e)
			{
				formattedPhone();
				$('#btn').attr('disabled', false);
				$('#phone').html('').css("border-color","none");
				if ($.trim($(this).val()) !== '') {
					if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
						$('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
						hasPhoneError = true;
						$('#btn').attr('disabled','disabled');
						$('#phone').css("border-color","#a94442");
						$('#phone-error').hide();
					} else {

						var phone = $(this).val().replace(/-|\s/g,""); //replaces 'whitespaces', 'hyphens'
						var phone = $(this).val().replace(/^0+/,"");  //replaces (leading zero - for BD phone number)
						var token = "{{csrf_token()}}";
						var pluginCarrierCode = $('#phone').intlTelInput('getSelectedCountryData').dialCode;
						$.ajax({
							url: "{{url('duplicate-phone-number-check')}}",
							method: "POST",
							dataType: "json",
							data: {
								'phone': phone,
								'carrier_code': pluginCarrierCode,
								'_token': "{{csrf_token()}}",
							}
						})
						.done(function(response)
						{
							if (response.status == true) {
								if (phone.length == 0) {
									$('#phone-error').html('');
								} else {
									$('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
									hasPhoneError = true;
									enableDisableButton();
								}
							} else if (response.status == false) {
								$('#phone-error').html('');
								hasPhoneError = false;
								enableDisableButton();
							}
						});
						$('#tel-error').html('');
						$('#phone-error').show();
						hasPhoneError = false;
						enableDisableButton();
					}
				} else {
					$('#tel-error').html('');
					$('#phone-error').html('');
					hasPhoneError = false;
					enableDisableButton();
				}
			});
		});

		function formattedPhone()
		{
			if ($('#phone').val != '') {
				var p = $('#phone').intlTelInput("getNumber").replace(/-|\s/g,"");
				$("#formatted_phone").val(p);
			}
		}
		function enableDisableButton() {
			if (!hasPhoneError) {
				$('form').find("button[type='submit']").prop('disabled', false);
			} else {
				$('form').find("button[type='submit']").prop('disabled', true);
			}
		}

		$.validator.addMethod("minAge", function(value, element, min) {
		    var today = new Date();
		    var birthDate = new Date(value);
		    var age = today.getFullYear() - birthDate.getFullYear();

		    if (age > min+1) { return true; }

		    var m = today.getMonth() - birthDate.getMonth();

		    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }

		    return age >= min;
		}, "You are not old enough!");


	</script>
@endpush
