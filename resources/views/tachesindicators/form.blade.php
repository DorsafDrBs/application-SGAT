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
  <input type="hidden" name="project_id" id="project_id" value=" {{ $info->id }}">
			   
			   <div class="col form-group modal-form">
                    <label>Indicators :		 </label>
					  <select  id="indic_id" name="indic_id" class="form-control " style="width: 100%;">
					 
					  @foreach($indicators as $key =>$value)
					  <option value="{{ $value->id }}">{{ $value->name }}</option>
							@endforeach
					  </select>
			   </div>

         <div class="col form-group modal-form">
         <label>Target :		 </label>
           <div class="input-group">	
        
        <input type="text" class="form-control" name="operator_cp"  id="operator_cp" required="required">
			<input type="text" class="form-control" name="target"  id="target" required="required">
	    	</div>
        </div>
		
         <div class="col form-group modal-form">
                    <label>		 </label>
					  <select  id="unit_id" name="unit_id" class="form-control " style="width: 100%;">
					
					  @foreach($units as $key =>$value)
					  <option value="{{ $value->id }}">{{ $value->name }}</option>
							@endforeach
					  </select>
			
			   </div>
         <div class="col form-group modal-form">
         <label>Orange :		 </label>
           <div class="input-group">	
        
        <input type="text" class="form-control" name="orange"  id="orange" required="required">
			
        </div>
			    </div> </div>
	 <button type="submit" class="btn btn-primary ">Save</button>
 
</script>