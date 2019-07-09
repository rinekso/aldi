@extends('layout')
@section('content')
<div class="user">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 centered">
				<div class="box">
					<div class="box-header">
						<a href="{{url('/')}}" class="btn btn-primary left">Kembali</a>
						<h2>Pembayaran {{$nama}}</h2>
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
						  			<td>Tahun Ajaran</td>
						  			<td>: {{\Auth::User()->tahun_ajaran}}</td>
						  		</tr>
						  		<tr>
						  			<td>Tagihan</td>
						  			<td>: {{$tagihan}} - {{$nama}}/{{$keterangan}}</td>
						  		</tr>
						  	</table>
						  </p>
						  @if($tagihan>0)
						  <form action="{{url('/bayar/'.$idJenisTr.'/proses')}}" method="post">
						  	{{csrf_field()}}
						  	<input type="hidden" value="{{$id_periode}}" name="id_periode">
							<button type="submit" class="btn btn-lg btn-success">Bayar</button>
						  </form>
						  @endif
						</div>

						<div id="Riwayat" class="tabcontent">
							<br>
							<div class="col-md-12">
								Tahun : 
								<select onchange="changeTahun()" id="tahun">
									@foreach($periode as $key=>$p)
										@if(@$p[0]->tahun != "")
											<option value="{{$key}}">{{$p[0]->tahun}}</option>
										@endif
									@endforeach
								</select>
							</div>
							<br>
							@foreach($periode as $key=>$per)
								<div class="con" id="tahun{{$key}}">
								@foreach($per as $p)
								  <form action="{{url('/bayar/'.$idJenisTr.'/proses')}}" method="post">
								  	{{csrf_field()}}
								  	<input type="hidden" value="{{$p->id_periode}}" name="id_periode">
										<div class="col-md-3">
										@if($p->paid)
											<a href="#" class="bg-success">
												{{$p->nama_periode}}
												<div class="ket bg-primary">Lunas</div>
											</a>
										@else
										<button type="submit" class="bg-success" style="border:none;display: block; width: 100%;">
												{{$p->nama_periode}}
												<div class="ket bg-danger">Bayar</div>
										</button>
										@endif
										</div>
								  </form>
								@endforeach
								</div>
							@endforeach
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