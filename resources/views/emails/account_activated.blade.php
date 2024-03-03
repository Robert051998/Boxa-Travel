@extends('emails.template')

@section('emails.main')
<div class="mt-20 text-left">
    <p>Dear <b>{{$name}},</b></p><br />
    <p>We are pleased to confirm that your Boxa Travel account has been activated. You can now start exploring our platform and book your next travel adventure!</p><br />
    <p>Your login credentials are as follows:</p><br />
    <p><b>Email Address:</b> {{$email}}</p><br />
    <p><b>Password:</b> <i>Password you have set during registration</i></p><br />
    <p>Please note that your password is case-sensitive, so make sure to enter it exactly as shown above.</p><br />
    <p>If you have any questions or concerns regarding your account, please contact our customer support team at <a href="mailto:support@boxatravel.com">support@boxatravel.com</a>. We are available 24/7 to assist you.</p><br />
    <p>Thank you for choosing Boxa Travel as your preferred travel platform. We look forward to helping you plan your next adventure!</p><br />
    <p><b>Best regards,</b><br />
    Boxa Travel Team.</p>
</div>
@stop