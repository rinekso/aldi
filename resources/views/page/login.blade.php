<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/flaticon/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap/dist/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
</head>
<body class="login">
<a href="https://rinekso.id">
    <div class="logo">
    </div>
</a>
<div class="clearfix"></div>
<div class="wrapper">
    <div class="col-md-4 col-md-push-4">
        <div class="box-contain">
            <form class="form-horizontal" method="post" action="{{url('login')}}">
                {{csrf_field()}}
                @if(isset($errors))
                    <div class="alert-danger" style="font-size: 12px; text-align: center">
                        {{$errors->first()}}
                    </div>
                @endif
                <div class="box-header">
                    Login Admin
                </div>
                <div class="box-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <span class="flaticon-avatar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password" placeholder="Password">
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