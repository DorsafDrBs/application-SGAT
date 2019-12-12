
 @extends('manager')
@section('manager')
<div class="row">
    <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<div class="col-lg-12">
     <h2 class="card-title">Les indicateurs des projets</h2>  
</div>

</div>
    
</div>
<div class="-sm m-0 float-right">
              
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 	Ajouter
</button>
          
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
            <th>Indicateurs</th>
            <th>Details</th>
            <th width="280px">Actions</th>
        </tr>
	    @foreach ($indicproj as $indic)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td >{{ $indic->name }}</td>
	        <td >{{ $indic->detail }}</td>
	        <td>
                <button class="btn btn-info" data-myname="{{$indic->name}}" data-mydetail="{{$indic->detail}}" data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#edit">Modifier</button>
									/
									<button class="btn btn-danger" data-indicid="{{$indic->id}}" data-toggle="modal" data-target="#delete">Supprimer</button>
								</td>
	        </td>
	    </tr>
	    @endforeach
    </table>

    </div>
    {!! $indicproj->links() !!}
  
    <script> /*
$(document).ready(function () {
    $(".open-AddBookDialog").click(function () {
        var a = $(this);

  var data-id = a.data('data-id')

  var modal = $('#modal')
  modal.find('#id').text(data-id)
  modal.find('#delete_btn_modal').attr('data-item_id',item_id)
  modal.modal('show');
    });
});
 var table = document.getElementById('table');
                
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

    
      
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Ajouter un nouvelle indicateur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('indicprojs.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('indicprojs.form')
                      
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
      <h4 class="modal-title" id="myModalLabel">Modifier un indicateur </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('indicprojs.update','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      		<input type="hidden" name="indicator_id" id="indic_id" value="">
                  @include('indicprojs.form')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
        <h4 class="modal-title text-center" id="myModalLabel">Confirmer</h4>
      </div>
      <form action="{{route('indicprojs.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
                Êtes-vous sûr de vouloir supprimer ceci?
				</p>
	      		<input type="hidden" name="indicator_id" id="indicd_id" value="">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Non, Annuler</button>
	        <button type="submit" class="btn btn-warning">Oui, Supprimer</button>
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