<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/front/css/paper-kit.css?v=2.1.0') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/front/lightbox/css/lightbox.css') }}" rel="stylesheet">

	<!--     Fonts and icons     -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{ asset('assets/front/css/nucleo-icons.css') }}" rel="stylesheet" />

	<!-- Toastr -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>
<body>

<!--    navbar come here          -->


@include('layouts.front.partial.navbar')


<!-- end navbar  -->



<div class="wrapper">

	<!-- content come here     -->
	
		@yield('content')

</div>

<!-- footer  -->
@include('layouts.front.partial.footer')

<!-- Modal Bodies come here -->

<!--   end modal -->


</body>
<!-- Core JS Files -->
<script src="{{ asset('assets/front/js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Switches -->
<script src="{{ asset('assets/front/js/bootstrap-switch.min.js') }}"></script>

<!--  Plugins for Slider -->
<script src="{{ asset('assets/front/js/nouislider.js') }}"></script>

<!--  Plugins for DateTimePicker -->
<script src="{{ asset('assets/front/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap-datetimepicker.min.js') }}"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{ asset('assets/front/js/paper-kit.js?v=2.1.0') }}"></script>

<script src="{{ asset('assets/front/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>

<!-- Toastr JS -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<script>
	@if($errors->any())
		@foreach($errors->all() as $error)
			toastr.error('{{ $error }}', 'Error', {
				closeButton:true,
				progressBar:true,
				
			});
		@endforeach
	@endif
</script>
	
</html>
