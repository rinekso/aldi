@extends('layout')
@section('content')
<div id="branding">
	<div class="wrapper">
		<div class="logo">
			Pembayaran
		</div>
		<div id="search">
			Saldo : 200.000
		</div>
		<div id="search">
			Nama Pengguna
		</div>
	</div>
</div>
<div class="user">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 centered">
				<div class="box">
					<div class="box-header">
						<h2>Pilih Jenis Pembayaran</h2>
					</div>
					<div class="box-body">
						<a href="menu.html" class="btn btn-primary btn-col">SPP</a>
						<a href="menu.html" class="btn btn-primary btn-col">UTS</a>
						<a href="menu.html" class="btn btn-primary btn-col">UAS</a>
						<a href="menu.html" class="btn btn-primary btn-col">KALENDER</a>
						<a href="menu.html" class="btn btn-primary btn-col">BUKU</a>
						<a href="menu.html" class="btn btn-primary btn-col">KARTU PELAJAR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')