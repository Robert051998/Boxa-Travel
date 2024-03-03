<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Boxa Travel </title>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');
	html{
		font-size: 62.5%;;
	}

	body {
		margin: 0;
		padding: 0;
		font-size: 1.6rem;
		font-weight: 300;
		line-height: 1.667;
		background: #ffffff;
		font-family: 'Outfit', sans-serif;
	}

	.shadow {
		box-shadow: inset 0px 1px 0px #E9E9E9;
	}

	img {
		display: block;
		border: 0;
		width:100%;
		height:auto;
	}
	/***************
	POSITIONING
	***************/	
	.center {
		margin: 0 auto;
	}
	.vat {
		vertical-align: top;
	}
	.vam {
		vertical-align: middle;
	}
	.vab {
		vertical-align: bottom;
	}
</style>

<style>
	p {
		color: #000;
		font-family: 'Outfit', sans-serif;
		margin: 0;
	}
	.frame {
		background: #fff;
	}  

	.justify-content-center{
		justify-content:center;
	}
	.wrapper {
		width: 100%;
		max-width:600px;
		margin:0 auto;
		text-align:center; 
	}

	.box {
		background: #ffffff;
		box-shadow: inset 0px 1px 0px #E9E9E9;
	}
	@media screen and (max-width: 600px) {
		.img-max {
			max-width: 100% !important;
			width: 100% !important;
			height: auto !important;
		}
	}
	@media screen and (min-width: 600px) {
		.des-pt50 {
			padding-top: 50px !important;
		}
		.des-pb50 {
			padding-bottom: 50px !important;
		}
	}
	/* Typhography*/
	.text-16{
		font-size: 1.6rem;
	}

	.text-18{
		font-size: 1.8rem;
	}
	.font-weight-700{
		font-weight: 700;
	}

	.p-1{
		padding:15px;
	}

	.p-3{
		padding:30px;
	}

	.ml-2{
		margin-left:25px;
	}
	.mr-2{
		margin-right:25px;
	}
	.mt-20{
		margin-top: 0px;
	}
	/* background-color*/
	.green{
		background:#1DBF73;
	}
	.w{
		width: 100%;
	}
	.d-flex{
		display: flex;
	}
	.img-fluid{
		width: 100%;
		height: auto;
	}
	.text-left{
		text-align: left;
	}
	.text-right{
		text-align: right;
	}
	.text-center{
		text-align: center;
	}
	.text-justify{
		text-align: justify;
	}	
	button,
	a.learn-more {
		position: relative;
		display: inline-block;
		cursor: pointer;
		outline: none;
		border: solid 0px #d8d8d8;
		vertical-align: middle;
		text-decoration: none;
		font-size: inherit;
		font-family: inherit;
		text-align: center;
		padding:15px 20px;
		border-radius: 10px;
		background: #008F6A;
		color: #fff;
		line-height: 1;
		margin-top: 30px;
		font-weight: bold;
	}
	button.learn-more,
	a.learn-more {
		color: #fff;
		background: #008F6A;
		border-radius: 10px;
		text-transform: capitalize;
	}
	a{
		color: #008F6A;
	}
	a.confirm_token{
		word-break: break-all;
	}
</style>
</head>
<body>
	<div class="frame">
		<div class="mt-20" style="display: table; margin-right: auto; margin-left: auto; width: 100%;">
			<div class="wrapper box" style="border: solid 1px #E1E1E1 !important; padding: 0; width: 100%;">
				<div class="d-flex" style="background: #053F32; padding: 15px 0;">
					<div style="margin: 0 auto; text-align: center; display: block;">
						<img src="{{ url('images/boxa_logo.png') }}" class="img-fluid" alt="logo1">
					</div>
				</div>
				<div style="padding: 30px;">