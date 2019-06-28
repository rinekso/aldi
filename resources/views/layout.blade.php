<!DOCTYPE html>
<html>
<head>
	<title>E-Card</title>
	<link rel="stylesheet" type="text/css" href="/assets/plugins/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/nivo-slider/nivo-slider.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/nivo-slider/themes/default/default.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/nivo-slider/themes/dark/dark.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/reyno-togglein/reyno-togglein.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/custom.css">
</head>
<body>
	@if(\Auth::Check())
<div id="branding">
	<div class="wrapper">
		<div class="logo">
			Pembayaran
		</div>
		<div id="search">
			<a href="{{url('logout
			')}}">Logout</a>
		</div>
		<div id="search">
			Saldo : {{\Auth::User()->saldo}}
		</div>
		<div id="search">
			{{\Auth::User()->nama}}
		</div>
	</div>
</div>
@endif

@yield('content')

<script src="/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/assets/plugins/reyno-togglein/reyno-togglein.js"></script>
<script src="/assets/plugins/nivo-slider/jquery.nivo.slider.js"></script>
<script src="/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>

<!--[if !(gte IE 8)]><!-->
<script src="/assets/js/wow.min.js"></script>
<script>
    // Initialize WOW
    //-------------------------------------------------------------
    new WOW({mobile: false}).init();
</script>
<!--<![endif]-->
@yield('js')
</body>
</html>