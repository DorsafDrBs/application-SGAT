@extends('manager')


@section('manager')
<div class="row">
  
  <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
   <h2 class="card-title">Les roles</h2>  
</div>

</div>
  
</div>
            <div class="-sm m-0 float-right">
        @can('role-create')
            <a class="btn btn-success rounded border" href="{{ route('roles.create') }}"> Créer </a>
            @endcan
            </div>
     

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}


@endsection