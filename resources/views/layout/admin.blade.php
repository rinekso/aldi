<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | Home</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/flaticon/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap/dist/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/font-awesome/css/font-awesome.css')}}">
    <link href="{{asset('assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/icon-style.css')}}">
    @yield('css')
</head>
<body>
<div id="branding">
    <div class="wrapper">
        <div class="logo">
            <i class="icon-logo"></i> Rinekso Admin
        </div>
        <a href="javascript:;" class="box pull-right">
            <img src="{{asset('assets/images/photo.jpg')}}">
        </a>
        <a href="javascript:;" class="box bg-green pull-right">
            <i class="flaticon-settings"></i>
        </a>
        <a href="javascript:;" class="box bg-red pull-right">
            <div class="notif bg-blue">7</div>
            <i class="flaticon-envelope"></i>
        </a>
        <form>
            <div id="search" data-toggle=0>
                <input type="text" onkeyup="searchActive()" placeholder="Search in web">
                <button type="submit" class="flaticon-magnifying-glass"></button>
            </div>
        </form>
    </div>
</div>
<div id="nav" class="left-col scroll-view">
    <ul class="menu-group">
        <li @if($menuActive == 'home') class="active" @endif>
            <a href="{{url('/')}}"><i class="flaticon-house"></i><span>Home</span></a>
        </li>
        <li @if($menuActive == 'article') class="active" @endif>
            <a href="{{url('article')}}"><i class="flaticon-copy"></i><span>Article</span></a>
        </li>
        <li @if($menuActive == 'gallery') class="active" @endif>
            <a href="{{url('gallery')}}"><i class="flaticon-monitor"></i><span>Gallery</span></a>
        </li>
        <li @if($menuActive == 'account') class="active" @endif>
            <a href="{{url('account')}}"><i class="flaticon-avatar"></i><span>Account</span></a>
        </li>
        <li>
            <a href="{{url('logout')}}"><i class="flaticon-logout"></i><span>logout</span></a>
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
        Design by <a target="_blank" href="http://www.facebook.com/rino.syfox/">Simson Rinekso</a>
    </div>
</div>
<script src="{{asset('assets/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('assets/plugins/reyno-togglein/reyno-togglein.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
{{--ajax function--}}
<script>
    function ajax(url,type,data,success){
        $.ajax({
            url : url,
            type : type,
            data : data,
            success : success
        })
    }
</script>
@yield('js')
</body>
</html>