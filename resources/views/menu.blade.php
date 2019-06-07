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
			<div class="col-md-offset-1 col-md-10 centered">
				<div class="box">
					<div class="box-header">
						<a href="pembayaran.html" class="btn btn-primary left">Kembali</a>
						<h2>Pembayaran SPP</h2>
					</div>
					<div class="box-body">
						<div class="tab">
						  <button class="tablinks active" onclick="openCity(event, 'Bayar')">Bayar</button>
						  <button class="tablinks" onclick="openCity(event, 'Riwayat')">Riwayat</button>
						  <button class="tablinks" onclick="openCity(event, 'Mutasi')">Mutasi</button>
						</div>

						<div id="Bayar" class="tabcontent" style="display: block">
						  <p>
						  	<br>
						  	<b>Biodata</b><br>
						  	<table>
						  		<tr>
						  			<td>Nama</td>
						  			<td>: Dummy</td>
						  		</tr>
						  		<tr>
						  			<td>NIS</td>
						  			<td>: 2353123</td>
						  		</tr>
						  		<tr>
						  			<td>Kelas</td>
						  			<td>: 3 A</td>
						  		</tr>
						  		<tr>
						  			<td>Tahun Ajaran</td>
						  			<td>: 2018/2019</td>
						  		</tr>
						  		<tr>
						  			<td>Tagihan</td>
						  			<td>: 150.000 (1 bulan)</td>
						  		</tr>
						  	</table>
						  </p>
						  <a href="#" class="btn btn-success">Bayar</a>
						</div>

						<div id="Riwayat" class="tabcontent">
							<br>
							<div class="col-md-12">
								Tahun Ajaran : 
								<select>
									<option>2017/2018</option>
									<option>2018/2019</option>
									<option>2019/2020</option>
								</select>
							</div>
							<br>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Januari
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Februari
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Maret
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									April
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Mei
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Juni
									<div class="ket bg-primary">Lunas</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Juli
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Agustus
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									September
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Oktober
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									November
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
							<div class="col-md-3">
								<a href="#" class="bg-success">
									Desember
									<div class="ket bg-danger">Bayar</div>
								</a>
							</div>
						</div>
						<div id="Mutasi" class="tabcontent">
						  <p>
						  	<br>
						  	<b>Biodata</b><br>
						  	<table>
						  		<tr>
						  			<td>Nama</td>
						  			<td>: Dummy</td>
						  		</tr>
						  		<tr>
						  			<td>NIS</td>
						  			<td>: 2353123</td>
						  		</tr>
						  		<tr>
						  			<td>Kelas</td>
						  			<td>: 3 A</td>
						  		</tr>
						  		<tr>
						  			<td>Tahun Ajaran</td>
						  			<td>: 2018/2019</td>
						  		</tr>
						  	</table>
						  </p>
						  <table class="table table-hover table-strip">
						  	<tr>
						  		<th>Tanggal</th>
						  		<th>Keterangan Transaksi</th>
						  		<th>Saldo</th>
						  	</tr>
						  	<tr>
						  		<td>12/10/2018</td>
						  		<td>Top up</td>
						  		<td>200.000</td>
						  	</tr>
						  	<tr>
						  		<td>12/10/2018</td>
						  		<td>Top up</td>
						  		<td>200.000</td>
						  	</tr>
						  	<tr>
						  		<td>12/10/2018</td>
						  		<td>Top up</td>
						  		<td>200.000</td>
						  	</tr>
						  	<tr>
						  		<td>12/10/2018</td>
						  		<td>Top up</td>
						  		<td>200.000</td>
						  	</tr>
						  	<tr>
						  		<td>12/10/2018</td>
						  		<td>Top up</td>
						  		<td>200.000</td>
						  	</tr>
						  </table>
						  <div class="clearfix"></div>
						</div>

						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection('content')
@section('js')
<script type="text/javascript">
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection('js')