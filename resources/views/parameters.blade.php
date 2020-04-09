@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css?family=Exo:700');
@import url('https://fonts.googleapis.com/css?family=Abel');
body {

  -webkit-transform: perspective(900px);
  -webkit-transform-style: preserve-3d;
}
.title{
  width=100%;
  text-align: center;
}
.title h1{
  font-size:50px;
  font-family: 'Exo', sans-serif;
}
.card1 {
  text-align:center;
  position: absolute;
  left: 80px;
  width: 200px;
  height: 250px;
  margin-top: 10px;
  margin-bottom: 10px;
  background: linear-gradient(rgb(37, 175, 35),rgb(32, 140, 57));
  transition:.6s;
  
  transform: rotatex(75deg) translatey(-200px) translatez(-100px);
  box-shadow: 0px 20px 60px rgba(0,0,0, 0.5);
}
.card1:hover{
  transform: rotatex(0deg);
  transform: rotatez(0deg);
  transition:.6s;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
}
.card1 img{
  transform: translateY(15px);
  width:200px;
  height:120px;
}
h3{
  font-size:25px;
  font-family: 'Abel', sans-serif;
  color:rgb(0,0,0);
  text-shadow: 0 0 2px rgb(255,255,255);
  transform: translatey(10px);
  text-align:center;

}

p{
  
  font-family: 'Abel', sans-serif;
  color: white;
  text-align:center;
  width:220px;
  transform: translatex(12px);
}


.card2 {
  text-align:center;
  position: absolute;
  left: 310px;
  width: 200px;
  height: 250px;
  margin-top: 10px;
  margin-bottom: 10px;
  background: linear-gradient(rgb(93,94,170),rgb(93,66,103));
  animation: animate 1s linear infinite;
  transition:.6s;
  
  transform: rotatex(75deg) translatey(-200px) translatez(-100px);
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.5);
}
.card2:hover{
   transform: rotatex(0deg);
  transition:.6s;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
}
.card2 img{
  transform: translateY(15px);
  width:180px;
  height:150px;
}
.card3 {
  text-align:center;
  position: absolute;
  left: 540px;
  width: 200px;
  height: 250px;;
  margin-top: 10px;
  margin-bottom: 10px;
  background: linear-gradient(#ff5252, #b33939);
  transition:.6s;
  
  transform: rotatex(75deg) translatey(-200px) translatez(-100px);
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.5);
}
.card3:hover{
   transform: rotatex(0deg);
  transition:.6s;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
}
.card3 img{
  transform: translateY(15px);
  width:200px;
  height:120px;
}
.card4 {
  text-align:center;
  position: absolute;
  left: 770px;
  width: 200px;
  height: 250px;
  margin-top: 10px;
  margin-bottom: 10px;
  background: linear-gradient(rgb(37, 166, 188),rgb(0, 123, 255));
  transition:.6s;
  
  transform: rotatex(75deg) translatey(-200px) translatez(-100px);
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.5);
}
.card4:hover{
   transform: rotatex(0deg);
  transition:.6s;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
}
.card4 img{
  transform: translateY(15px);
  width:200px;
  height:120px;
}
.card5 {
  text-align:center;
  position: absolute;
  left: 1000px;
  width: 200px;
  height: 250px;
  margin-top: 10px;
  margin-bottom: 10px;
  background: linear-gradient(rgb(234, 205, 86), rgb(209, 148, 50));
  transition:.6s;
  
  transform: rotatex(75deg) translatey(-200px) translatez(-100px);
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.5);
}
.card5:hover{
   transform: rotatex(0deg);
  transition:.6s;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
}
.card5 img{
  transform: translateY(15px);
  width:200px;
  height:120px;
}
</style>

<div class="title">
  <h1><span style="color: #0099ff">Parameters</span></h1>
</div>
<div class="card1">
  <img src="" alt="">
  <h3><a style="color: #ffffff" href="{{ route('users.index') }}">Users</a></h3>
</div>
<div class="card2">
  <img src="" alt="">
  <h3><a style="color: #ffffff" href="{{ route('roles.index') }}">Roles</a></h3>
</div>
<div class="card3">
  <img src="" alt="">
  <h3> <a style="color: #ffffff" href="{{ route('process.index') }}">Processses</a></h3>
</div>
<div class="card4">
  <img src="" alt="">
  <h3><a style="color: #ffffff" href="{{ route('projects.index') }}">Projects</a></h3>
</div>
<div class="card5">
  <img src="" alt="">
  <h3> <a style="color: #ffffff" href="{{ route('indicators.index') }}"> indicators</a></h3>
</div>
@endsection
