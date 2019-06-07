<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/plugins/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/admin/assets/css/custom.css">
</head>
<body class="login">
	<a href="index.html">
		<div class="logo">
			<!-- <img src="/assets/images/logo.png"> -->
		</div>		
	</a>
	<div class="clearfix"></div>
	<div class="wrapper">
		<div class="col-md-4 col-md-push-4">
			<div class="box-contain">
				<form class="form-horizontal" action="{{url('/login/process')}}" method="post">
					{{csrf_field()}}
				<div class="box-header">
					Login Admin
				</div>
				<div class="box-body">
                @if(isset($errors))
                    <div class="alert-danger" style="font-size: 12px; text-align: center">
                        {{$errors->first()}}
                    </div>
                @endif
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group has-feedback">
							<input type="text" name="username" class="form-control" placeholder="Username">
							<span class="flaticon-avatar form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group has-feedback">
							<input type="password" name="password" class="form-control" placeholder="Password">
							<span class="flaticon-padlock form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-footer">
					<button class="btn btn-success pull-right">Sign In</button>
					<div class="clearfix"></div>
				</div>					
				</form>
			</div>
		</div>
	</div>
</body>
</html>