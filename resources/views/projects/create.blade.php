@extends('manager')
@section('manager')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create new project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('projects.store') }}" method="POST">
    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
            <label>Processuses:
            <select  name="proc_id" class="form-control select2" style="width: 300%;">
                 @foreach($processes as $process)
                 <option value="{{$process->id}}">{{$process->name}}</option>
                 @endforeach
            </select>
            </label>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Projets:</strong>
		            <textarea class="form-control" style="height:150px; width:300px;" name="project_name" placeholder="projet ..."></textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>
    </form>
    <div class="row">
             <div class="col-lg-4 form-group modal-form">
                    <label>Processe:
					  <select  id="process_id" name="process_id[]"  class="form-control select2 " style="width:300%;">
						@foreach($processes as $process)
						 <option value="{{$process->id}}">{{$process->name}}</option>
						@endforeach
					  </select>
					 </label>
			 </div>
             <div class="col-lg-4 form-group modal-form">
                    <label>Project:
					<div class="input-group">
					<input type="text" class="form-control" name="project_name" id="project_name"   >
				 </div>
					 </label>
			 </div>
    </div>
  <!-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Project:</strong>
            {!! Form::select('projects[]', $projects,[], array('class' => 'form-control','id'=>'project')) !!}
        </div>
    </div>-->

@endsection