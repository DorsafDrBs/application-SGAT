@extends('manager')


@section('manager')
<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
                        @can('project-create')
                <a class="btn btn-success rounded border" href="{{ route('projects.create') }}"> Create</a>
                @endcan
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Projects <b></b></h2>
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
            <th>Processuses</th>
            <th>Projets</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
	    @foreach ($projects as $project)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $project->name }}</td>
	        <td>{{ $project->project_name }}</td>
          
	        <td>
                    <a  href="{{ route('projects.show',$project->id) }}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                    @can('project-edit')
                    <a  href="{{ route('projects.edit',$project->id) }}"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    @endcan
          
                    @method('DELETE')
                    @can('project-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['projects.destroy', $project->id],'style'=>'display:inline']) !!}
                <button type="submit"  href="{{ URL::route('projects.destroy',$project->id) }}"methode="DELETE"width="20px" class="delete"  data-toggle="tooltip"><i class="material-icons ">&#xE872;</i></button>
                {!! Form::close() !!}
                    @endcan
                
	        </td>
	    </tr>
	    @endforeach
        </tbody>
    </table>
    </div>
    <div class="clearfix">
  {!! $projects->links() !!}
    </div>

</div>
@endsection