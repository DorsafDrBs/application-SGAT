
				<div class="col form-group modal-form">
                    <label>Program :
					  <select  id="programs_id" name="programs_id" class="form-control select2" style="width: 100%;">
						@foreach($programs as $program)
						 <option value="{{$program->id}}">{{$program->program}}</option>
						@endforeach
					  </select>
					 </label>
			    </div>	<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" name="perimetre" id="perimetre"  placeholder="Perimetre" required="required">
						</div>
					</div>