@extends('manager')


@section('manager')
<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
                        @can('role-create')
            <a class="btn btn-success rounded border" href="{{ route('roles.create') }}"> Create </a>
            @endcan
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Roles <b></b></h2>
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
     <th width="180px">Action</th>
  </tr>
  </thead>
    <tbody>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a  href="{{ route('roles.show',$role->id) }}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
            @can('role-edit')
             <a  href="{{ route('roles.edit',$role->id) }}"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
            @endcan
            @can('role-delete')
                <button type="submit" width="20px" class="delete"  data-roleid="{{$role->id}}" data-toggle="modal" data-target="#delete"><i class="material-icons ">&#xE872;</i></button>
            @endcan
            
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="clearfix">
  
{!! $roles->render() !!}
</div>
</div>
<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
  
        <h4 class="modal-title text-center" id="myModalLabel">Confirmer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('roles.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p> Are you sure you want to delete this?	</p>
	      		<input type="hidden" name="role_id" id="roled_id" value="">

	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cansel</button>
	        <button type="submit" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<script>
/*$('#edit').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
    var name=button.data('myname')
    var detail=button.data('mydetail')
    var indic_id=button.data('indicid')
    var modal=$(this)
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #detail').val(detail);
    modal.find('.modal-body #indic_id').val(indic_id);
 
})*/
$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var roled_id=button.data('roleid')
    var modal=$(this)
    modal.find('.modal-body #roled_id').val(roled_id);
 
})

</script>
@endsection