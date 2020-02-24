
 @extends('manager')
@section('manager')

<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
   
                <a class="btn btn-primary rounded border bottom" data-toggle="modal" data-target="#myModal"> Create</a>
            
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Process <b> Indicators </b></h2>
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
            <th>Indicators</th>
            <th>Details</th>
            <th width="180px">Actions</th>
        </tr>
	    @foreach ($indicprocess as $indic)
	    </thead>
      <tr>
	        <td>{{ ++$i }}</td>
	        <td >{{ $indic->name }}</td>
	        <td >{{ $indic->detail }}</td>
	        <td>
          @can('indic-proc-edit')
                <a  data-myname="{{$indic->name}}" data-mydetail="{{$indic->detail}}" data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#edit" class="edit" title="edit"><i class="material-icons">&#xE254;</i></a>
               @endcan
                @can('indic-proc-delete')
									<button  data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#delete" width="20px" class="delete"><i class="material-icons ">&#xE872;</i></button>
							@endcan
              	</td>
	        </td>
	    </tr>
	    @endforeach
      </tbody>
    </table>

    </div>
    <div class="clearfix">
      {!! $indicprocess->links() !!}
    </div>
 </div>
	

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-form" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel">Add new indicator</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('indicprocs.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('indicprocs.form')
	     
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
      <h4 class="modal-title" id="myModalLabel">Edit indicator </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('indicprocs.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="indicator_id" id="indic_id" value="">
                  @include('indicprocs.form')
	     
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
      <form action="{{route('indicprocs.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p> Are you sure you want to delete this?</p>
	      		<input type="hidden" name="indicator_id" id="indicd_id" value="">
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
    var name=button.data('myname')
    var detail=button.data('mydetail')
    var indic_id=button.data('indicid')
    var modal=$(this)
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #detail').val(detail);
    modal.find('.modal-body #indic_id').val(indic_id);
 
})
$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var indicd_id=button.data('indicid')
    var modal=$(this)
    modal.find('.modal-body #indicd_id').val(indicd_id);
 
})

</script>
@endsection