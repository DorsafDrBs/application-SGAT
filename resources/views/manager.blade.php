@extends('layouts.app')

@section('content')
<div class="container">
   <!-- Main Menu area start-->
   <div class="col-m6 rounded ">
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">parameter</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-blue" href="{{ route('users.index') }}">Users</a>
    @can('role-list') <a class="p-2 text-blue" href="{{ route('roles.index') }}">Roles</a>   @endcan
    @can('process-list')<a class="p-2 text-blue" href="{{ route('process.index') }}">Processses</a>   @endcan
    @can('project-list')<a class="p-2 text-blue" href="{{ route('projects.index') }}">Projects</a>   @endcan
     <a class="p-2 text-blue" href="{{ route('indicators.index') }}"> indicators</a>
     @can('tache-list')<a class="p-2 text-blue" href="{{ route('taches.index') }}"> Taches</a>   @endcan
     @can('program-list')<a class="p-2 text-blue" href="{{ route('programs.index') }}"> Programs</a>   @endcan
     @can('perimetre-list')<a class="p-2 text-blue" href="{{ route('perimetres.index') }}"> Perimetres</a>   @endcan
    
  </nav>
</div>
    <!-- Main Menu area End-->
   
@yield('manager')
</div>
@endsection
