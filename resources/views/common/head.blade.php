<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta property="og:url"                content="{{url()->full()}}" />
		<meta property="og:url"                content="{{Request::ip()}}" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }}" />
		<meta property="og:description"        content="{{ isset($result->property_description->summary) ? $result->property_description->summary : ( Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'description'))  }}" />
		<meta property="og:image"              content="{{ (isset($property_id) && !empty($property_id && isset($property_photos[0]->photo) )) ? $property_photos[0]->photo : (defined("BANNER_URL") ? BANNER_URL : '') }}" />

		@if (!empty($favicon))
			<link rel="shortcut icon" href="{{ $favicon }}">
		@endif

		<title>{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ $additional_title ?? '' }} </title>
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- CSS  new version start-->
		@stack('css')
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('css/vendors/bootstrap/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/vendors/fontawesome/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
		<!--CSS new version end-->
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-0EEY8FN001"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-0EEY8FN001');
		</script>
	</head>
<body class="{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ Route::current()->uri() == 'login' ? 'Signup' : '' }} {{ Route::current()->uri() == 'forgot_password' ? 'Signup' : '' }} {{ Route::current()->uri() == 'users/reset_password' ? 'Signup' : '' }} {{ Route::current()->uri() == 'thankyou' ? 'Signup' : '' }} m-0">
	<input type="hidden" name="isTestnet" id="isTestnet" value="{{ env('IS_TEST_NET_ENABLED')}}" />
