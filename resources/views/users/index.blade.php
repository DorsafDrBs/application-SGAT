@extends('manager')


@section('manager')

<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
            <a class="btn btn-primary rounded border bottom"  title="create" data-toggle="modal" data-target="#create" href="#"> Create</a>
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
  
   <th width="120px">Actions</th>
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
    <a  href="{{ route('users.show',$user->id )}}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
               
       <a data-usersid="{{$user->id}}" data-myname="{{$user->name}}" data-myemail="{{$user->email}}"  class="edit" title="Edit" data-toggle="modal" data-target="#edit" href="#"><i class="material-icons">&#xE254;</i></a>
     		<button  data-usersid="{{$user->id}}" data-toggle="modal" data-target="#delete" width="20px" class="delete"><i class="material-icons ">&#xE872;</i></button>
						
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
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-form" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Add new user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('users.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('users.form')
          <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-form" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit user </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('users.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="user_id" id="users_id" value="">
                  @include('users.form')
                  <a type="submit" class="btn btn-primary">Save</a>
	      
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title text-center" id="myModalLabel">Confirm</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>
      <form action="{{route('users.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p> Are you sure you want to delete this user ?</p>
	      		<input type="hidden" name="user_id" id="usersd_id" value="">
	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Close</button>
	        <button type="submit"href="{{ URL::route('users.destroy',$user->id) }}"methode="DELETE" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<script>

$('#edit').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
    var name=button.data('myname')
    var email=button.data('myemail')
    var users_id=button.data('usersid')
    var modal=$(this)
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #email').val(email);
    modal.find('.modal-body #users_id').val(users_id);
 
})
$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var usersd_id=button.data('usersid')
    var modal=$(this)
    modal.find('.modal-body #usersd_id').val(usersd_id);
 
})

</script>
@endsection