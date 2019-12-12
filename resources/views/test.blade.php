@extends('layouts.app')

@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">

 

  <!-- The slideshow -->
  <div class="col-lg-6 carousel-inner">
    <div class="card carousel-item active bg-yellow col-lg-4">
      <img src="la.jpg" alt="Los Angeles">
    </div>
    <div class="carousel-item bg-green">
      <img src="chicago.jpg" alt="Chicago">
    </div>
    <div class="carousel-item">
      <img src="ny.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev bg-blue" href="#demo" data-slide="prev"> 
    <span class="carousel-control-prev-icon">prev</span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
@endsection