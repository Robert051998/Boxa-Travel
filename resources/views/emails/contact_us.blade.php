@extends('emails.template')

@section('emails.main')
<div style="margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;margin-top:1em">
A customer has sent you massage
</div>
<div>
    <label><b>Name</b> 	   : {{$name}}</label>
    <label><b>Email</b>      : {{$email}}</label>
    <label><b>Telephone</b>  : {{$telephone}}</label>
    <label><b>Message</b>	   :</label>
    <p>{{$message}}</p>
</div>
@stop