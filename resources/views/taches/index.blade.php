
 @extends('manager')
@section('manager')

<div class="container">
        <div class="table-wraptache">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
            @can('tache-create')
                <a class="btn btn-primary rounded border bottom" data-toggle="modal" data-target="#myModal"> Create</a>
                @endcan
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center"> <b> Taches </b></h2>
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

    <table id="table"  class="table table-bordered">
      <thead>
        <tr>
            <th>No</th>
            <th>Taches</th>
    
           
            <th width="180px">Actions</th>
        </tr>
	    @foreach ($taches as $tache)
	    </thead>
      <tr>
	        <td>{{ ++$i }}</td>
          <td >{{ $tache->tache }}</td>


	        <td>
          @can('tache-edit')
                <a  data-mytache="{{$tache->tache}}"  data-toggle="modal" data-target="#edit" class="edit" title="edit"><i class="material-icons">&#xE254;</i></a>
               @endcan
                @can('tache-delete')
									<button  data-tacheid="{{$tache->id}}" data-toggle="modal" data-target="#delete" width="20px" class="delete"><i class="material-icons ">&#xE872;</i></button>
							@endcan
              	</td>
	        </td>
	    </tr>
	    @endforeach
      </tbody>
    </table>

    </div>
    <div class="clearfix">
    
    </div>
 </div>
	
 <!--Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-form" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Add new tache</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('taches.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('taches.form')
	     
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
      <h4 class="modal-title" id="myModalLabel">Edit tache </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('taches.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" tache="tache_id" id="tache_id" value="">
                  @include('taches.form')
	     
	        <button type="submit" class="btn btn-primary">Save</button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Confirm</h4>
      </div>
      <form action="{{route('taches.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p> Are you sure you want to delete this?</p>
	      		<input type="hidden" tache="tacheimetre_id" id="tached_id" value="">
	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Close</button>
	        <button type="submit" class="btn btn-warning">Yes, Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>  
<script>
$('#edit').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
    var tache=button.data('mytache')
    var modal=$(this)
    modal.find('.modal-body #tache').val(tache);

    
}) 
$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
    var tached_id=button.data('tacheid')
    var modal=$(this)
    modal.find('.modal-body #tached_id').val(tached_id);
 
})

</script>
@endsection