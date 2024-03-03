@extends('emails.template')

@section('emails.main')
<h3 style="text-align:center;font-weight: bold;">{{ $site_name }}</h3>
<p>Hi <b>{{ $first_name }},</b></p><br>
@if($type == 'update')
  <p>
    Your {{ $site_name }} payout information was updated on {{ $updated_time }}.
  </p><br>
@endif
  @if($type == 'delete')
    <p>
      Your {{ $site_name }} payout information was deleted on {{ $deleted_time }}.
    </p><br>
  @endif

  @if($type == 'default_update')
    <p>
        We hope this message finds you well. Your {{ $site_name }} payout account information was recently changed on {{ $updated_date }}. To help keep your account secure, we wanted to reach out to confirm that you made this change. Feel free to disregard this message if you updated your payout account information on {{ $updated_date }}.
    </p><br>
    <p>
        If you did not make this change to your account, please contact us.
    </p><br>
  @endif
@stop