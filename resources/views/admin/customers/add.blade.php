@extends('admin.template')

@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Customers<small>Add Customer</small></h1>
        @include('admin.common.breadcrumb')
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="box">
                <form class="form-horizontal" action="{{url('admin/add-customer')}}" id="add_customer" method="post" name="add_customer" accept-charset='UTF-8'>
                    {{ csrf_field() }}
                    <div class="box-body">
                    <input type="hidden" name="default_country" id="default_country" class="form-control">
                    <input type="hidden" name="carrier_code" id="carrier_code" class="form-control">
                    <input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control">
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">First Name<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">Last Name<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">Email<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control error" name="email" id="email" placeholder="">
                                <div id="emailError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">Phone</label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control" id="phone" name="phone">
                                <span id="phone-error" class="text-danger text-13"></span>
                                <span id="tel-error" class="text-danger text-13"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">Password<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="control-label col-sm-3">Status</label>
                            <div class="col-sm-8">
                            <select class="form-control" name="status" id="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                    <button type="submit" class="btn btn-info" id="submitBtn">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $('#add_customer').validate({
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
                laxEmail:true
            },
            password: {
                required: true,
                minlength: 6
            }
        }
    });

    jQuery.validator.addMethod("laxEmail", function(value, element) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
        }, "{{ __('messages.jquery_validation.email') }}" );

        $(document).on('blur keyup', '#email', function() {
            var emailError = '';
            $('#submitBtn').attr('disabled', false);
            var email      = $('#email').val();
            var _token     = $('input[name="_token"]').val();
            $('.error-tag').html('').hide();
            if(email != '') {
                $.ajax({
                url:"{{ route('checkUser.check') }}",
                    method:"POST",
                    data:{email:email, _token:_token},
                    success:function(result)
                {
                    if (result == 'not_unique') {
                        $('#emailError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.email_existed') }}"+'</label>');
                        $('#email').addClass('has-error');
                        $('#submitBtn').attr('disabled', 'disabled');
                    } else {
                        $('#email').removeClass('has-error');
                        $('#emailError').html('');
                        $('#submitBtn').attr('disabled', false);
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

        $(document).ready(function()
        {
            $("#phone").intlTelInput({
                separateDialCode: true,
                nationalMode: true,
                preferredCountries: ["us"],
                autoPlaceholder: "polite",
                placeholderNumberType: "MOBILE",
                utilsScript: '{{ URL::to('/') }}/backend/js/intl-tel-input-13.0.0/build/js/utils.js'
            });

            var countryData = $("#phone").intlTelInput("getSelectedCountryData");
            $('#default_country').val(countryData.iso2);
            $('#carrier_code').val(countryData.dialCode);
            $("#phone").on("countrychange", function(e, countryData)
            {
                formattedPhone();
                $('#default_country').val(countryData.iso2);
                $('#carrier_code').val(countryData.dialCode);
                if ($.trim($(this).val()) !== '') {
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
    // Validate phone via Ajax
    $(document).ready(function()
    {
        $("input[name=phone]").on('blur keyup', function(e)
        {
            formattedPhone();
            $('#submitBtn').attr('disabled', false);
            $('#phone').html('').css("border-color","silver");
            if ($.trim($(this).val()) !== '') {
                if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                    $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                    hasPhoneError = true;
                    $('#submitBtn').attr('disabled','disabled');
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
</script>
@endpush