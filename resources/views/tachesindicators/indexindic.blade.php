@extends('manager')
@section('manager')


<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
                        @can('project-create')
                        <a class="btn btn-primary rounded border bottom" data-toggle="modal" data-target="#myModal"> Create</a>
                @endcan
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Project : <b> {{$info->project_name}} </b></h2>
                        <hp class="text-center">Tache : <b> {{$info->tache}} </b>/ Program :<b> {{$info->program}} </b>/ Perimetre :<b> {{$info->perimetre}} </b></p>
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
            <th>Indicators</th>
            <th>Targets</th>
          
            <th width="80px">Action</th>
        </tr>
        </thead>
        <tbody> 
	     @foreach($data as $dt) 
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>{{$dt->name}}</td>
	        <td>{{$dt->operator_cp}}{{$dt->target}}{{$dt->unit}}</td>
           
	 <td>
     @can('indic-proc-edit')
                <a  data-myindic="{{$dt->indic_id}}" data-myoperator="{{$dt->operator_cp}}" 
                 data-mytarget="{{$dt->target}}"data-myunit="{{$dt->unit_id}}"
                  data-myorange="{{$dt->orange}}" data-myid="{{$dt->id}}"   data-toggle="modal" data-target="#edit" class="edit" title="edit"><i class="material-icons">&#xE254;</i></a>
               @endcan
                @can('indic-proc-delete')
			<button  data-indicid="{{$dt->id}}" data-toggle="modal" data-target="#delete" width="20px" class="delete"><i class="material-icons ">&#xE872;</i></button>
							@endcan
      </td>
	 </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="clearfix">

    </div>
</div>

 <!-- Modal -->
 <div class="modal fade  bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add New Indicator to {{ $info->project_name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('tachesindicators.storeindics')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('tachesindicators.form')
                   
	  
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit indicator </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('tachesindicators.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="indicator_id" id="assoc_id" value="">
                  @include('tachesindicators.form')
	     
	       
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
      <form action="{{route('tachesindicators.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p> Are you sure you want to delete this?</p>
	      		<input type="hidden" name="indicator_id" id="assocd_id" value="">
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
    var assoc_id=button.data('myid')
    var target=button.data('mytarget')
    var indic_id=button.data('myindic')
    var project_id=button.data('myproject')
    var target=button.data('mytarget')
    var unit_id=button.data('myunit')
    var operator_cp=button.data('myoperator')
    var orange=button.data('myorange')
   
    var modal=$(this)
    modal.find('.modal-body #assoc_id').val(assoc_id);
    modal.find('.modal-body #indic_id').val(indic_id);
    modal.find('.modal-body #project_id').val(project_id);
    modal.find('.modal-body #target').val(target);
    modal.find('.modal-body #unit_id').val(unit_id);
    modal.find('.modal-body #operator_cp').val(operator_cp);
    modal.find('.modal-body #orange').val(orange);
   
}) 
$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var assocd_id=button.data('indicid')
    var modal=$(this)
    modal.find('.modal-body #assocd_id').val(assocd_id);
 
})

</script>
@endsection