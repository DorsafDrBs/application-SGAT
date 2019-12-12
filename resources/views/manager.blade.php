@extends('layouts.app')

@section('content')
<div class="container">
   <!-- Main Menu area start-->
   <div class="col-m6 rounded ">
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">parameter</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-blue" href="{{ route('users.index') }}">Users</a>
    <a class="p-2 text-blue" href="{{ route('roles.index') }}">Roles</a>
    <a class="p-2 text-blue" href="{{ route('process.index') }}">Processses</a>
    <a class="p-2 text-blue" href="{{ route('projects.index') }}">Projects</a>
    <a class="p-2 text-blue" href="{{ route('indicators.index') }}"> indicators</a>
  </nav>
</div>
    <!-- Main Menu area End-->
   
@yield('manager')
</div>
@endsection
