@extends('layout')
@section('content')
<div id="branding">
	<div class="wrapper">
		<div class="logo">
			Pembayaran
		</div>
	</div>
</div>
<div class="user">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 centered">
				<div class="box">
					<div class="box-header">
						<h2>Silahkan tempelkan smartcard anda</h2>
					</div>
					<div class="box-content">
						<form action="menu" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<input type="text" class="form-control" disabled placeholder="ID SmartCard" name="">
								<i class="fa fa-check"></i>
							</div>
							<div class="form-group">
								<input type="number" placeholder="PIN" class="form-control" name="">
							</div>
							<div class="form-group">
								<button class="btn btn-primary form-control" type="submit">Enter</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')
