

<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>
  

<div class="row" >
            <input type="hidden" name="users_id" id="userss_id" value=" {{ $user->id }}">
			   {{ Form::open() }}
               <div class="col form-group modal-form">
                    <label>Project :		 </label>
					  <select  id="projects" name="projects" class="form-control " style="width: 100%;">
					  <option value="0" disable="true" selected="true"> Select project </option>
					  @foreach($projects as $key =>$value)
					  <option value="{{ $value->id }}">{{ $value->project_name }}</option>
							@endforeach
					  </select>
		      </div>
               <div class="col form-group modal-form">
                    <label>Tache : </label>
					<select name="taches" id="taches"class="form-control"style="width:100px">
					<option value="0" disable="true" selected="true"> Select tache </option>
					</select>
			    </div>
               <div class="col form-group modal-form">
                    <label>Program : </label>
					<select name="programs" id="programs"class="form-control"style="width:100px">
					<option value="0" disable="true" selected="true"> Select program </option>
					</select>
			    </div>
               <div class="col form-group modal-form">
                    <label>Perimetre : </label>
					  <select  id="perimetres" name="perimetres" class="form-control" style="width: 100%;">
					  <option value="0" disable="true" selected="true"> Select perimetre </option>
					  </select>
			   </div>
               {{ Form::close() }}
		
  </div>
	  <button type="submit" class="btn btn-primary ">Save</button>




<script type="text/javascript">
  $('#projects').on('change', function(e){
     console.log(e);
        var project_id = e.target.value;
        $.get('/json-user-taches?project_id=' + project_id,function(data) {
       console.log(data);
       $('#taches').empty();
          $('#taches').append('<option value="0" disable="true" selected="true"> Select Tache </option>');

          $('#programs').empty();
          $('#programs').append('<option value="0" disable="true" selected="true"> Select Program </option>');

          $('#perimetres').empty();
          $('#perimetres').append('<option value="0" disable="true" selected="true"> Select Perimetre </option>');

          $.each(data, function(index, tachesObj){
            $('#taches').append('<option value="'+ tachesObj.id +'">'+ tachesObj.tache +'</option>');
          })
        });
      });
  $('#taches').on('change', function(e){
     console.log(e);
        var tache_id = e.target.value;
        $.get('/json-user-programs?tache_id=' + tache_id,function(data) {
       console.log(data);
          $('#programs').empty();
          $('#programs').append('<option value="0" disable="true" selected="true"> Select Programs </option>');

          $('#perimetres').empty();
          $('#perimetres').append('<option value="0" disable="true" selected="true"> Select Perimetres </option>');

          $.each(data, function(index, programsObj){
            $('#programs').append('<option value="'+ programsObj.id +'">'+ programsObj.program +'</option>');
          })
        });
      });

      $('#programs').on('change', function(e){
        console.log(e);
        var programs_id = e.target.value;
        $.get('/json-user-perimetres?programs_id=' + programs_id,function(data) {
    console.log(data);
          $('#perimetres').empty();
          $('#perimetres').append('<option value="0" disable="true" selected="true"> Select Perimetres </option>');

          $.each(data, function(index, perimetresObj){
            $('#perimetres').append('<option value="'+ perimetresObj.id +'">'+ perimetresObj.perimetre +'</option>');
          })
        });
      });

</script>