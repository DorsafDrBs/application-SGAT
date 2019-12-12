@extends('manager')
@section('manager')

     <div class="row">
  <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
   <h2 class="card-title">Gérer les indicateurs de performance</h2>  
</div>
</div>
</div>

 <div class="row">
    <div class="col-lg-4">
     <div class="card" style="width: 18rem;">
       <div class="card-body">
         <h5 class="card-title">Indicators of processus</h5>
         <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
         @can('indic-proc-list')
         <a href="{{route('indicprocs.index')}}" class="btn btn-primary">Ajouter</a>
         @endcan
        </div>
      </div>
     </div>
    <div class="col-lg-4">
     <div class="card" style="width: 18rem;">
       <div class="card-body">
       <h5 class="card-title">Indicators of projets</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
       <a href="{{route('indicprojs.index')}}" class="btn btn-primary" >Ajouter</a>
       </div>
      </div>
    </div>
   <div class="col-lg-4 ">
     <div class="card" style="width: 18rem;">
      <div class="card-body">
       <h5 class="card-title">Indicators of utilisateurs</h5>
       <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
       <a href="{{route('indicusers.index')}}" class="btn btn-primary" >Ajouter</a>
       </div>
     </div>
     </div>
   </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
         <h5 class="card-title"> the data of the process indicators</h5>
         <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
         <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Ajouter</a>
        </div>
      </div>
   </div>
  <div class="col-lg-4">
     <div class="card" style="width: 18rem;">
       <div class="card-body">
       <h5 class="card-title"> the data of the projects indicators</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
       <a href="#" class="btn btn-primary"data-toggle="modal" data-target="#staticBackdrop2" >Ajouter</a>
     </div>
    </div>
  </div>
   <div class="col-lg-4 ">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
         <h5 class="card-title">the data of the users indicators</h5>
         <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
         <a href="#" class="btn btn-primary"data-toggle="modal" data-target="#staticBackdrop3">Ajouter</a>
       </div>
      </div>
     </div>
</div>
<!-- Button trigger modal -->

<!-- Modal1 -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Import Process Indicators Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your contribution.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <form action="{{ route('indicators.index.importExcel') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">{{ csrf_field() }}
      <div class="modal-body">  
       <div class="form-group">
           <label for="exampleInputFile">Excel file entry</label>
          <input type="file"name="import_file" id="InputFile">
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cansel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>          
      </div>
 </form>
    </div>
  </div>
</div>

<!-- Modal2-->
<div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Import Projects Indicators Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> I There were some problems with your contribution.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <form action="{{ route('indicators.index.importerExcelprojet') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">{{ csrf_field() }}
      <div class="modal-body">  
       <div class="form-group">
           <label for="exampleInputFile">Excel file entry</label>
          <input type="file"name="import_file" id="InputFile">
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>          
      </div>
 </form>
    </div>
  </div>
</div>
<!-- Modal3-->
<div class="modal fade" id="staticBackdrop3" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Import Users Indicators Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>  There were some problems with your contribution.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <form action="{{ route('indicators.index.importerExcelcollabo') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">{{ csrf_field() }}
      <div class="modal-body">  
       <div class="form-group">
           <label for="exampleInputFile">Excel file entry</label>
          <input type="file"name="import_file" id="InputFile">
       </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>          
      </div>
 </form>
    </div>
  </div>
</div>

@endsection