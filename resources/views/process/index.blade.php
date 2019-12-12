@extends('manager')


@section('manager')
    <div class="row">
    <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
     <h2 class="card-title">Processes</h2>  
</div>

</div>
    
</div>
<div class="-sm m-0 float-right">
                @can('process-create')
                <a class="btn btn-success rounded border" href="{{ route('process.create') }}"> Create</a>
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
            <th>Name</th>
            <th>Details</th>
            <th>Family</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($processes as $process)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $process->name }}</td>
	        <td>{{ $process->detail }}</td>
            <td>{{ $process->famille }}</td>
	        <td>
                <form action="{{ route('process.destroy',$process->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('process.show',$process->id) }}">Show</a>
                    @can('process-edit')
                    <a class="btn btn-primary" href="{{ route('process.edit',$process->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('process-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $processes->links() !!}


@endsection