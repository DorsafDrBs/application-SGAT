             <div class="form-group">
                    <label>Process:
					  <select  id="process_id" name="process_id" class="form-control select2" style="width: 300%;">
						@foreach($processes as $process)
						 <option value="{{$process->id}}">{{$process->name}}</option>
						@endforeach
					  </select>
					 </label>
			 </div>
			 <div class="form-group">
			 	  <div class="input-group">
						<input type="text" class="form-control" name="detail" id="detail"  placeholder="Indicator" required="required">
			    	</div>
			 </div>
			 <div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" name="name"  id="name" placeholder="Indicator's designation" required="required">
					</div>
			 </div>
			 <div class="form-group">
                    <label>Periodicity:
					  <select  id="periodicity" name="periodicity" class="form-control select2" style="width: 300%;">
						
						 <option value="Monthly">Monthly</option>
						 <option value="Quarterly">Quarterly</option>
						 <option value="Semestral">Semestral</option>
						 <option value="Yearly">Yearly</option>
					  </select>
					 </label>
			 </div>
			 <div class="row">
        	 <div class="col form-group">
				 <div class=" input-group">
					<input type="text" class="form-control" name="target" id="target"  placeholder="Target" required="required">
				 </div>
		 	 </div>
			  <div class="col form-group">
			
					  <select  name="unit_id" id="unit_id"class="form-control select2"  style="width: 300%;">
					  
					  @foreach($units as $unit)
						 <option value="{{$unit->id}}">{{$unit->name}}</option>
						@endforeach
					  </select>
			
		 	 </div>
			  </div>
			  <div class="row">
			  <div class="col form-group">
				 <div class="input-group">
					<input type="text" class="form-control" name="min" id="min"  placeholder="Min" required="required">
				 </div>
		 	 </div>
			  <div class="col form-group">
				 <div class="input-group">
					<input type="text" class="form-control" name="max" id="max"  placeholder="Max" required="required">
				 </div>
		 	 </div>
			  </div>
			 
			  <div class="form-group">
				 <div class="input-group">
					<input type="text" class="form-control" name="orange" id="orange"  placeholder="Orangé" required="required">
				 </div>
		 	 </div>
			  
			 <div class="form-group">
				 <div class="input-group">
					<input type="text" class="form-control" name="datasource" id="datasource"  placeholder="Data Source" required="required">
				 </div>
		 	 </div>