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
						<h2>Login</h2>
					</div>
					<div class="box-content">
						<form action="{{url('login/user')}}" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<input type="password" class="form-control" placeholder="ID SmartCard" name="rfid">
								<i class="fa fa-check"></i>
							</div>
							<div class="form-group">
								<input type="password" placeholder="PIN" class="form-control" name="pin">
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
