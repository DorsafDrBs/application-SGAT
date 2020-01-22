@extends('manager')


@section('manager')
<div class="container">
        <div class="table-wrapper">			
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
						<div class="show-entries">
                        @can('process-create')
                <a class="btn btn-success rounded border" href="{{ route('process.create') }}"> Create</a>
                @endcan
						</div>						
					</div>
					<div class="col-sm-4">
						<h2 class="text-center">Processes <b></b></h2>
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
            <th>Details</th>
            <th>Family</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
	    @foreach ($processes as $process)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $process->name }}</td>
	        <td>{{ $process->detail }}</td>
            <td>{{ $process->famille }}</td>
	        <td>
                <form action="{{ route('process.destroy',$process->id) }}" method="POST">
                    <a  href="{{ route('process.show',$process->id) }}"class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                    @can('process-edit')
                    <a  href="{{ route('process.edit',$process->id) }}"class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('process-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['process.destroy', $process->id]]) !!}
       <button type="submit"  href="{{ URL::route('process.destroy',$process->id) }}"methode="DELETE"width="20px" class="delete"  data-toggle="tooltip"><i class="material-icons ">&#xE872;</i></button>
        {!! Form::close() !!}
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
        </tbody>
    </table>
    </div>
    <div class="clearfix">
               
                {!! $processes->links() !!}

            </div>
        </div>

</div>
@endsection