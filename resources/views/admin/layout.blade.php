<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel | {{$title}}</title>
	<link rel="stylesheet" type="text/css" href="/assets/plugins/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
  <!-- Font Awesome -->
  <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="/admin/assets/css/custom.css">
  @yield('css')
</head>
<body>
<div id="branding">
	<div class="wrapper">
		<div class="logo">
			<h4>Admin</h4>
			<!-- <img src="/assets/images/logo.png"> -->
		</div>
		<a href="javascript:;" class="box pull-right">
			<img src="/assets/images/photo.jpg">
		</a>
	</div>
</div>
<div id="nav" class="left-col scroll-view">
	<ul class="menu-group">
		<li class="@if($title == 'home') active @endif">
			<a href="{{url('/adm')}}"><i class="flaticon-house"></i><span>Home</span></a>
		</li>
		<li class="@if($title == 'history') active @endif">
			<a href="{{url('/adm/history')}}"><i class="flaticon-pie-chart"></i><span>History Transaksi</span></a>
		</li>
		<li class="@if($title == 'siswa') active @endif">
		    <a href="{{url('/adm/siswa')}}"><i class="flaticon-edit"></i><span>Siswa</span></a>
		</li>
		<li class="@if($title == 'topup') active @endif">
			<a href="{{url('/adm/topup')}}"><i class="flaticon-monitor"></i><span>Top Up</span></a>
		</li>
	</ul>
</div>
<div class="right-col">
	<div class="wrapper">
    @yield('content')
	</div>
</div>
<div class="clearfix"></div>
  <div class="footer">
    <div class="wrapper">
      &copy; Copyright 2019 <!-- <a target="_blank" href="http://www.facebook.com/rino.syfox/">Simson Rinekso</a> -->
    </div>
  </div>
<script src="/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/assets/plugins/reyno-togglein/reyno-togglein.js"></script>
<script src="/assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery custom content scroller -->
<script src="/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
@yield('js')
</body>
</html>