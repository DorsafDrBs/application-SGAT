@extends('manager')


@section('manager')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>
    </div>


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
					    	<h2 class="text-center">Process : <b> @foreach ($process as $proc)
                                                         {{ $proc->name}}
                                                   @endforeach </b></h2>
                 <h3 class="text-center">Project : <b> {{ $project->project_name }} </b></h3>
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
            <th>Taches</th>
            <th>Programs</th>
            <th>Perimetres</th>
            <th width="180px">Action</th>
         </tr>
        </thead>
      <tbody> 
	     @foreach ($associations as $association)
	     <tr>
	        <td>{{ ++$i }}</td>
          <td>{{ $association->tache }}</td>
          <td> {{ $association->program }} </td>
          <td> {{ $association->perimetre }} </td>
              <td>
              
                <a  href="{{ route('tachesindicators.indexindic',$association->id)}}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
           
                  @can('project-edit')
                    <a data-myid="{{$association->id}}"
                    data-myperimetre="{{$association->perimetre}}"
                    data-mytache="{{ $association->tache }}"data-myprogram="{{ $association->program }}"
                  data-toggle="modal" data-target="#edit" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    @endcan 
                    @method('DELETE')
                    @can('project-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['projects.destroy',$project->id],'style'=>'display:inline']) !!}
                <button type="submit"  href="{{ URL::route('projects.destroy',$project->id)}}"methode="DELETE"width="20px" class="delete"  data-toggle="tooltip"><i class="material-icons ">&#xE872;</i></button>
                {!! Form::close() !!}
                    @endcan  
               </td>
	     </tr>
	     @endforeach
      </tbody>
    </table>
   </div>
   <div class="clearfix">
   {!! $associations->render() !!}
    </div>
   </div>
 <!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add New Indicator to {{ $project->project_name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('projects.store_taches')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('projects.form')
                   
	  
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit  indicator of {{ $project->project_name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('projects.update_indic','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      	<input type="text" name="association_id" id="association_id" value="">
                  @include('projects.form')
	     
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<script>
$('#edit').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
  
    var perimetres=button.data('myperimetre')
    var programs=button.data('myprogram')
    var taches=button.data('mytache')
    var modal=$(this)
    modal.find('.modal-body #association_id').val(association_id);
    modal.find('.modal-body #perimetres').val(perimetres);
    modal.find('.modal-body #programs').val(programs);
    modal.find('.modal-body #taches').val(taches);
}) 
/*$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var associationd_id=button.data('associationid')
    var modal=$(this)
    modal.find('.modal-body #associationd_id').val(associationd_id);
 
})
*/
</script>
@endsection