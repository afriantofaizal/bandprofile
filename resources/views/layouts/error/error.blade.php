<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8" />
		{{-- <link rel="icon" type="image/png" href="assets/img/favicon.ico"> --}}
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('assets/front/errors/css/error.css') }}" rel="stylesheet" />

	@stack('css')


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>


			@yield('content')

@stack('js')
<script src="{{ asset('assets/front/errors/js/error.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" type="text/javascript"></script>

</html>