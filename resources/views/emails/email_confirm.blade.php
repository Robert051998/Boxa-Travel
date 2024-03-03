@extends('emails.template')

@section('emails.main')

<div class="mt-20 text-left">
  <p>Dear <b>{{ $first_name }}</b>,</p>
  <p>
    @if($type == 'register')
    Thank you for creating an account with Boxa Travel! To ensure that we have your correct email address on file, we need you to confirm it by clicking on the button below:
    @elseif($type == 'change')
      Please click the link below to complete the process of changing your email address.
    @else
      Please Confirm your email address:
    @endif
  </p><br>
  
  <p class="mt-20 text-center">
    <a href="{{ $url.('users/confirm_email?code='.$token) }}" target="_blank" class="learn-more">
      {{trans('messages.email_template.confirm_email')}}
    </a>
  </p><br>
  <p>
  If the button above does not work, you can also confirm your email address by copying and pasting the following link into your web browser:
  </p><br>
  <p>
  <a href="{{ $url.('users/confirm_email?code='.$token) }}" target="_blank">
    {{ $url.('users/confirm_email?code='.$token) }}
  </a>
  </p><br>
  <p>
    Please note that you will not be able to make any bookings or receive important updates about your account until your email address has been confirmed.
  </p><br>
  <p>
  If you did not create an account with Boxa Travel, or if you received this email in error, please disregard this message and contact our customer support team at  <a href="mailto:support@boxatravel.com">support@boxatravel.com</a>.
  </p><br>
  <p>
  Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you plan your next adventure!
  </p><br>
  <p><b>Best regards,</b><br>Boxa Travel Team.</p>
</div>


@stop



