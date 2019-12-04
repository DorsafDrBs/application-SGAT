
 @extends('manager')
@section('manager')
<div class="row">
    <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
     <h2 class="card-title">Les processuses</h2>  
</div>

</div>
    
</div>
<div class="-sm m-0 float-right">
                @can('process-create')
                <a class="btn btn-success rounded border" href="#process"> Créer</a>
                @endcan
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 <br/>
    <table id="table"  class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Indicateurs</th>
            <th>Details</th>
            <th width="280px">Actions</th>
        </tr>
	    @foreach ($indicprocess as $indic)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td >{{ $indic->name }}</td>
	        <td >{{ $indic->detail }}</td>
	        <td>
                <form action="{{ route('indicprocs.destroy',$indic->id) }}" method="POST">
                @can('process-edit')
                    <a class="btn btn-primary open-AddBookDialog"data-toggle="modal" data-id="{{$indic->id}}" data-target="#edit">Edit</a>
                    @endcan
                     @csrf
                    @method('DELETE')
                    @can('indic-proc-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    </div>
    {!! $indicprocess->links() !!}
  
    <script>
$(document).ready(function () {
    $(".open-AddBookDialog").click(function () {
        $('#bookId').val($(this).data('id'));
        $('#addBookDialog').modal('show');
    });
});
 /* var table = document.getElementById('table');
                
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    { 
                       rIndex = this.rowIndex;
                         document.getElementById("name").value = this.cells[1].innerHTML;
                         document.getElementById("detail").value = this.cells[2].innerHTML;
                    };*/
           
}
</script>

    <div class="modal fade" id="process">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un indicateur des processus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="form-inline"  action="{{ route('indicprocs.store') }}" method="POST">
    	@csrf

                          <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputname2">Nom </label>
                            <input type="text" class="form-control sm-input" name="name"  id="name"value="{ { old('') } }"  placeholder="Entrer le nom de l'indicateur">
                          </div>
                          <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputdetail2">Detail</label>
                            <input type="text" class="form-control sm-input" name="detail"value="{ { old('detail') } }"  id="detail"  placeholder="Entrer un detail">
                          </div>
                          @can('indic-proc-create')
                          <div class="col-3 inline">
                          <button type="submit" value="save" class="btn btn-success"> Ajouter</button>
                  
                          </div>
                          @endcan   
                    
                        </form>

               <!-- /.modal-body -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modifier un  indicateurs des processus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="form-inline"  action="{{ route('indicprocs.update',$indic->id) }}" method="POST">
    	@csrf

                          <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputname2">Nom </label>
                            <input type="text" class="form-control sm-input" name="name"  id="name"value="{ { old('') } }"  placeholder="Entrer le nom de l'indicateur">
                          </div>
                          <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputdetail2">Detail</label>
                            <input type="text" class="form-control sm-input" name="detail"value="{ { old('detail') } }"  id="detail"  placeholder="Entrer un detail">
                          </div>
                          @can('indic-proc-create')
                          <div class="col-3 inline">
                         
                          <button type="submit" value="update" id="myDIV"class="btn btn-success " > Modifier</button>
                          </div>
                          @endcan   
                    
                        </form>

               <!-- /.modal-body -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection