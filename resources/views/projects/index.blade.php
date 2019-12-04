@extends('manager')


@section('manager')
    <div class="row">
  
    <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
     <h2 class="card-title">Les projets</h2>  
</div>

</div>
    
</div>

                <div class="-sm m-0 float-right">
                @can('project-create')
                <a class="btn btn-success rounded border" href="{{ route('projects.create') }}"> Créer</a>
                @endcan
                </div>
            

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Processuses</th>
            <th>Projets</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($projects as $project)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $project->name }}</td>
	        <td>{{ $project->project_name }}</td>
          
	        <td>
                <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">Show</a>
                    @can('project-edit')
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('project-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $projects->links() !!}


@endsection