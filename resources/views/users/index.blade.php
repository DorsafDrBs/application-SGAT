@extends('manager')


@section('manager')

<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
            <a class="btn btn-primary rounded border bottom" href="{{ route('users.create') }}"> Create</a>
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Users <b></b></h2>
					</div>
                    <div class="col-sm-4">
                        <div class="search-box">
							<div class="input-group">
								<span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
								<input type="text" class="form-control" placeholder="Search&hellip;">
							</div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
  <table class="table table-bordered">
   <thead>
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="180px">Actions</th>
 </tr>
 </thead>
    <tbody>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td >
       <a href="{{ route('users.show',$user->id) }}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
       <a href="{{ route('users.edit',$user->id) }}"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
       {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id]]) !!}
       <button type="submit"  href="{{ URL::route('users.destroy',$user->id) }}"methode="DELETE"width="20px" class="delete"  data-toggle="tooltip"><i class="material-icons ">&#xE872;</i></button>
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
 </tbody>
</table>
</div>
<div class="clearfix">
      
{!! $data->render() !!}
</div>
</div>

@endsection