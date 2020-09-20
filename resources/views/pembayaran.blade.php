@extends('layout')
@section('content')
<div class="user">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 centered">
				<div class="box">
					<div class="box-header">
						<h2>Pilih Jenis Pembayaran</h2>
					</div>
					<div class="box-body">
						@foreach($jenis as $j)
						<a href="{{url('bayar/'.$j->id_pembayaran)}}" class="btn btn-primary btn-col">{{$j->nama}}</a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')