@extends('emails.template')

@section('emails.main')
<div class="mt-20 text-left">
<p>Dear <b>{{ $first_name }}</b>,</p><br />
  <p>
    We received a request to reset your Boxa Travel password. If you did not make this request, you can disregard this email.
  </p><br>
  <p>
  To reset your password, please click on the button below:
  </p>  
  <p class="mt-20 text-center">
    <a href="{{ $url.('users/reset_password?secret='.$token) }}" target="_blank" class="learn-more">
      {{trans('messages.email_template.reset_password')}}
    </a>
  </p><br>
  <p>
  If the button above does not work, you can also reset your password by copying and pasting the following link into your web browser:
  </p><br>
  <p class="mt-20">
    <a href="{{ $url.('users/reset_password?secret='.$token) }}" class="confirm_token" target="_blank">
    {{ $url.('users/reset_password?secret='.$token) }}
    </a>
  </p><br>
  <p>Please note that this link will expire in 24 hours. If you do not reset your password within this time frame, you will need to request another password reset.</p><br>
  <p>If you have any questions or concerns regarding your account or password, please contact our customer support team at  <a href="mailto:support@boxatravel.com">support@boxatravel.com</a>.</p><br>
  <p>Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you plan your next adventure!</p><br>
  <p><b>Best regards,</b><br>Boxa Travel Team.</p>
</div>
@stop

