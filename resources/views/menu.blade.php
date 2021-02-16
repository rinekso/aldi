@extends('layout')
@section('content')
<div class="user">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 centered">
				<div class="box">
					<div class="box-header">
						<a href="{{url('/')}}" class="btn btn-primary left">Kembali</a>
						<h2>Pembayaran {{$pembayaran->nama}}</h2>
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
						  			<td>: {{\Auth::User()->nama}}</td>
						  		</tr>
						  		<tr>
						  			<td>NIK</td>
						  			<td>: {{\Auth::User()->nik}}</td>
						  		</tr>
						  		<tr>
						  			<td>Tagihan</td>
						  			<td>: {{$tagihan}} - {{$pembayaran->nama}} / {{$keterangan}}</td>
						  		</tr>
						  	</table>
						  </p>
						  @if($tagihan>0)
						  <form action="{{url('/bayar/'.$idJenisTr.'/proses')}}" method="post">
						  	{{csrf_field()}}
							<button type="submit" class="btn btn-lg btn-success">Bayar</button>
						  </form>
						  @endif
						</div>

						<div id="Riwayat" class="tabcontent">
							<br>
							<div class="col-md-12">
								Tahun : 
								<select onchange="changeTahun()" id="tahun">
									<?php $selisihY = (date('Y')-$pembayaran->tahun) ?>
									@for($i=0; $i <= $selisihY; $i++)
										<option value="{{$i}}">{{($pembayaran->tahun+$i)}}</option>
									@endfor
								</select>
							</div>
							<br>
							@for($i=0; $i <= $selisihY;$i++)
								<div class="con" id="tahun{{$i}}">
								@foreach($periode["tahun-".($pembayaran->tahun+$i)] as $p)
								  <form action="{{url('/bayar/'.$idJenisTr.'/proses')}}" method="post">
								  	{{csrf_field()}}
										<div class="col-md-3">
										@if($p['paid'])
											<a href="{{url('pdf/cetak')}}?kode={{$p['kode']}}&periode={{$p['month']}}-{{($pembayaran->tahun+$i)}}" target="_blank" class="bg-success">
												{{$p['month']}}
												<div class="ket bg-primary">Lunas</div>
											</a>
										@else
										<button type="submit" class="bg-success" style="border:none;display: block; width: 100%;">
												{{$p['month']}}
												<input type="hidden" value="{{$p['month']}}-{{($pembayaran->tahun+$i)}}" name="periode">
												<div class="ket bg-danger">Bayar</div>
										</button>
										@endif
										</div>
								  </form>
								@endforeach
								</div>
							@endfor
						</div>

						<div id="Mutasi" class="tabcontent">
						  <table class="table table-hover table-strip">
						  	<tr>
						  		<th>No</th>
						  		<th>Kode</th>
						  		<th>Status</th>
						  		<th>Keterangan</th>
						  		<th>Nominal</th>
						  		<th>Tanggal</th>
							  </tr>
						  	@foreach($mutasi as $k=>$m)
						  	<tr>
						  		<td>{{$k+1}}</td>
						  		<td>{{$m['kode']}}</td>
						  		<td>{{$m['status']}}</td>
						  		<td>{{$m['keterangan']}}</td>
						  		<td>{{$m['nominal']}}</td>
						  		<td>{{$m['date']}}</td>
						  	</tr>
						  	@endforeach
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
@if(@$errors->first('text') != "")
	alert("{{$errors->first('text')}}");
@endif
$(".con").hide();
$("#tahun"+0).show();
function changeTahun(){
	var thn = $("#tahun").val();
	$(".con").hide();
	$("#tahun"+thn).show();
	// console.log(thn);
}
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