<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Dashboard SGAT</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <meta charset="utf-8">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
  <style type="text/css">
  
	.modal-form {
		width: 350px;
	}
	.modal-form .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-form .modal-header {
		border-bottom: none;
        position: relative;
		justify-content: center;
	}
	.modal-form .close {
        position: absolute;
		top: -10px;
		right: -10px;
	}
	.modal-form h4 {
		color: #636363;
		text-align: center;
		font-size: 26px;
		margin-top: 0;
	}
	.modal-form .modal-content {
		color: #999;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 25px;
    }
	.modal-form .form-group {
		margin-bottom: 20px;
	}
	.modal-form label {
		font-weight: normal;
		font-size: 13px;
	}
	.modal-form .form-control {
		min-height: 38px;
		padding-left: 5px;
		box-shadow: none !important;
		border-width: 0 0 1px 0;
		border-radius: 0;
	}
	.modal-form .form-control:focus {
		border-color: #ccc;
	}
	.modal-form .input-group-addon {
		max-width: 42px;
		text-align: center;
		background: none;
		border-width: 0 0 1px 0;
		padding-left: 5px;
		border-radius: 0;
	}
    .modal-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #19aa8d;
        border-radius: 3px;
		border: none;
		min-width: 140px;
        outline: none !important;
    }
	.modal-form .btn:hover, .modal-form .btn:focus {
		background: #179b81;
	}
	.modal-form .hint-text {
		text-align: center;
		padding-top: 5px;
		font-size: 13px;
	}
	.modal-form .modal-footer {
		color: #999;
		border-color: #dee4e7;
		text-align: center;
		margin: 0 -25px -25px;
		font-size: 13px;
		justify-content: center;
	}
	.modal-form a {
		color: #fff;
		text-decoration: underline;
	}
	.modal-form a:hover {
		text-decoration: none;
	}
	.modal-form a {
		color: #19aa8d;
		text-decoration: none;
	}	
	.modal-form a:hover {
		text-decoration: underline;
	}
	.modal-form .fa {
		font-size: 21px;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
<style type="text/css">
    body {
        color: #566787;
        background: #f5f5f5;
		font-family: 'Roboto', sans-serif;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px;
        margin: 30px 0;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
		font-size: 15px;
        padding-bottom: 10px;
        margin: 0 0 10px;
		min-height: 45px;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
	.table-title select {
		border-color: #ddd;
		border-width: 0 0 1px 0;
		padding: 3px 10px 3px 5px;
		margin: 0 5px;
	}
	.table-title .show-entries {
		margin-top: 7px;
	}
	.search-box {
        position: relative;
        float: right;
    }
	.search-box .input-group {
		min-width: 200px;
		position: absolute;
		right: 0;
	}
	.search-box .input-group-addon, .search-box input {
		border-color: #ddd;
		border-radius: 0;
	}
	.search-box .input-group-addon {
		border: none;
		border: none;
		background: transparent;
		position: absolute;
		z-index: 9;
	}
    .search-box input {
        height: 34px;
        padding-left: 28px;		
		box-shadow: none !important;
		border-width: 0 0 1px 0;
    }
	.search-box input:focus {
		border-color: #3FBAE4;
	}
    .search-box i {
        color: #a0a5b1;
        font-size: 19px;
		position: relative;
		top: 2px;
		left: -10px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child {
        width: 130px;
    }
    table.table td a button{
        color: #a0a5b1;
        display: inline-block;
        margin: 0 5px;
    }
    
	table.table td a.view {
        color: #03A9F4;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td button.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }    
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
		padding: 0 10px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	// Animate select box length
	var searchInput = $(".search-box input");
	var inputGroup = $(".search-box .input-group");
	var boxWidth = inputGroup.width();
	searchInput.focus(function(){
		inputGroup.animate({
			width: "300"
		});
	}).blur(function(){
		inputGroup.animate({
			width: boxWidth
		});
	});
});
</script>
</head>
<body>
    <div id="app">
       
                        @guest
                        @yield('authenticat')
                        @else
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
                                    <a class="dropdown-item" href="{{ route('parameters') }}">Parameters</a>
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