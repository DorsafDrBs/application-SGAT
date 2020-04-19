@extends('manager')


@section('manager')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}   
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
          
            @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
        
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
            <a class="btn btn-primary rounded border bottom"  title="create" data-toggle="modal" data-target="#create" href="#"> Create</a>
						</div>						
					</div>
                    <div class="col-sm-4">
						<h2 class="text-center"> {{ $user->name }} 's Projects <b></b></h2>
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
   <th>Project</th>
   <th>Taches</th>
   <th>Programs</th>
   <th>Perimetres</th>
  <th width="120px">Actions</th>
 </tr>
 </thead>
    <tbody>
 @foreach ($users as $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->project_name }}</td>
    <td>{{ $user->tache }}</td>
    <td>{{ $user->program }}   </td>
    <td>{{ $user->perimetre }}   </td>
    <td >
    
    </td>
  </tr>
 @endforeach
 </tbody>
</table>
</div>
<div class="clearfix">
      
{!! $users->render() !!}
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-form" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Add new user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('users.store_projet')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('users.formP')
         
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->



</div>
@endsection