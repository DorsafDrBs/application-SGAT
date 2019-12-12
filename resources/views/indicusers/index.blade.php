
 @extends('manager')
@section('manager')
<div class="row">
    <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
     <h2 class="card-title">Indicators of users</h2>  
</div>

</div>
    
</div>
<div class="-sm m-0 float-right">
              
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">	Create</button>
                
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


 <br/>
    <table id="table"  class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Indicators</th>
            <th>Details</th>
            <th width="280px">Actions</th>
        </tr>
	    @foreach ($indicusers as $indic)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td >{{ $indic->name }}</td>
	        <td >{{ $indic->detail }}</td>
	        <td>
                <button class="btn btn-info" data-myname="{{$indic->name}}" data-mydetail="{{$indic->detail}}" data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#edit">Edit</button>
									/
									<button class="btn btn-danger" data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#delete">Delete</button>
								</td>
	        </td>
	    </tr>
	    @endforeach
    </table>

    </div>
    {!! $indicprocess->links() !!}
  

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add New Indicator </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('indicusers.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('indicusers.form')
                      
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Submit</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit indicator </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('indicusers.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="indicator_id" id="indic_id" value="">
                  @include('indicusers.form')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Submit</button>
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
        <h4 class="modal-title text-center" id="myModalLabel">Confirme</h4>
      </div>
      <form action="{{route('indicusers.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
        Are you sure you want to delete this?
				</p>
	      		<input type="hidden" name="indicator_id" id="indicd_id" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cansel</button>
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