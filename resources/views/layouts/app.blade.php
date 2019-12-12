<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Dashboard SGAT</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <meta charset="utf-8">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet"  href="{{ URL::asset('adminlte/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ URL::asset('loginadmin/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/css/util.css') }}">
	<link rel="stylesheet"  href="{{ URL::asset('loginadmin/css/main.css') }}">
<!--===============================================================================================-->
   <!-- jQuery -->
   <script src="{{ URL::asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> 
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- FontAwesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/elegant_font/css/style.css') }}">    
    <!-- Theme CSS -->
    <link id="stylesheet" rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="shortcut icon" href="favicon.ico">  


<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <!-- echarts -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-gl/dist/echarts-gl.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-stat/dist/ecStat.min.js"></script>
<!-- highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/pareto.js"></script>
    <style type="text/css">
#hs-component{background-color:#34343e;padding:0}#hs-component>.container{width:100%;padding:0}.img-thumbnail{border:0}#hs-component .container{padding:0}#header{background-color:#3A3A4F;border-bottom:10px solid #eee}#header .container{background-color:#3A3A4F;box-shadow:none}#header h1{text-align:left;color:#eee;text-transform:none;font-weight:400}.demo,h1{text-align:center}#demos{background-color:#eee}#demos .container{background-color:transparent;box-shadow:none}#demos #secondary-mobile-menu,#secondary-mobile-menu{background-color:#3A3A4F}#demos .row{background-color:transparent}#demos .row:last-of-type{border-bottom:0}h1{margin-bottom:1em;font-weight:lighter}.demo{margin:20px 0}.demo-container{background:#f9f9f9;box-shadow:0 3px 4px #ddd;position:relative;transition:transform .2s ease-in-out;-webkit-transition:-webkit-transform .2s ease-in-out;-moz-transition:-moz-transform .2s ease-in-out;-ms-transition:-ms-transform .2s ease-in-out}.demo-container.new-demo:after{content:'New';position:absolute;top:5px;left:-5px;background:#6B6FD0;box-shadow:0 1px 2px #bbb;padding:2px 10px;font-weight:700;letter-spacing:1px;font-size:13px;text-transform:uppercase}.demo-container:hover{transform:translateY(-5px);-webkit-transform:translateY(-5px);-moz-transform:translateY(-5px);-ms-transform:translateY(-5px)}.demo a{font-weight:lighter;color:#fff}.image-container{height:250px;max-height:250px;padding:0;background-color:#fff;font:0/0 a}.dark-unica .image-container{background-color:inherit}.sand-signika .image-container{background:url(http://www.highcharts.com/samples/graphics/sand.png)}.image-container::before{content:' ';display:inline-block;vertical-align:middle;height:100%}.image-container img,.image-container svg{display:inline-block;vertical-align:middle;max-width:100%;max-height:100%;border-radius:0;padding:0;background:0;position:inherit!important}.demo-container .footer-container{border-top:1px solid #EDEDED}.demo h3{text-transform:none;color:#6B6FCE;font-size:16px;font-weight:700;transition:color .2s ease-in-out;-webkit-transition:color .2s ease-in-out;-moz-transition:color .2s ease-in-out;-ms-transition:color .2s ease-in-out}.demo .demo-container:hover h3{color:#58BB45}.row>.title{background-color:transparent;color:#3A3A4F}.row>.title>h2{margin:20px 0 0;text-transform:none;font-weight:500;padding-bottom:14px;border-bottom:2px solid #D4D4DE}a.btn.btn-theme{color:#eeeaea;background-color:#565669;border:1px solid #34343e;border-bottom:0;border-radius:0;font-weight:700;font-size:13px;margin:0 2px 0 0;letter-spacing:.5px;line-height:36px;padding:0 15px;transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-ms-transition:all .2s ease-in-out}a.btn.btn-theme:hover{background-color:#6A6A7E;color:#90ef7f}a.btn.btn-theme.disabled{background-color:#eee;color:#313131;opacity:1}.select{margin-bottom:10px;margin-top:10px}.select label{color:#fff}.dropdown.theme>ul{border-radius:0;border:0}@media (max-width:400px){.demo{width:100%}.demo-container .footer-container,.demo-container .image-container{width:50%}.demo-container .footer-container{border-top:none}.demo-container .image-container{height:auto}.demo h3{text-align:left}}@media screen and (min-width:400px) and (max-width:768px){.demo-container .image-container{height:200px}@media screen and (min-width:768px) and (max-width:992px){.demo-container{-webkit-transition-duration:.3s;transition-duration:.3s;-webkit-transition-property:transform;transition-property:transform;-webkit-transform:translateZ(0);transform:translateZ(0);box-shadow:0 0 1px transparent}.demo-container:hover{-webkit-transform:scale(1.05);transform:scale(1.05)}}@media screen and (min-width:992px) and (max-width:1200px){.demo-container{-webkit-transition-duration:.3s;transition-duration:.3s;-webkit-transition-property:transform;transition-property:transform;-webkit-transform:translateZ(0);transform:translateZ(0);box-shadow:0 0 1px transparent}.demo-container:hover{-webkit-transform:scale(1.05);transform:scale(1.05)}}@media screen and (min-width:1200px){.demo-container{-webkit-transition-duration:.3s;transition-duration:.3s;-webkit-transition-property:transform;transition-property:transform;-webkit-transform:translateZ(0);transform:translateZ(0);box-shadow:0 0 1px transparent}.demo-container:hover{-webkit-transform:scale(1.05);transform:scale(1.05)}}}
  </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                <img src="{{ URL::asset('welcom/images/Image1.png') }}" style="width:170px; height:50px;"  href="http://sogeclairaerospace.com/">
                </a>
           
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @can('home-index')
                        <a class="nav-link" href="{{ route('home') }}"> Home</a>
                        <a class="nav-link" href="{{ route('cartographie') }}"> Cartography</a>
                      @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                              
                                    @can('manager')
                                    <a class="dropdown-item" href="{{ route('manager') }}">Parameters</a>
                                @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!--========================================adminlte=======================================================-->
 
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ URL::asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ URL::asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ URL::asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
 <script src="{{ URL::asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('adminlte/dist/js/demo.js') }}"></script>
<script src="{{ URL::asset('adminlte/plugins/jquery/jquery.min.js') }}"></script> 
<!--===============================================================================================-->
	  <!-- Main Javascript -->     

<!--===============================================================================================-->

</body> 
</html>
