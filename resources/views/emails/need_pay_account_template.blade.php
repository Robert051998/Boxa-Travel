@extends('emails.template')

@section('emails.main')
<?=$content?>
<p class="mt-20 text-center">
  <a href="{{ $url.'users/payout' }}" target="_blank" class="learn-more">
    {{trans('messages.email_template.add_payment_method')}}</a>
</p>
 
@stop

 