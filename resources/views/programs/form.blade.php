<div class="col form-group modal-form">
                    <label>Program :
					  <select  id="tache_id" name="tache_id" class="form-control select2" style="width: 100%;">
						@foreach($taches as $tache)
						 <option value="{{$tache->id}}">{{$tache->tache}}</option>
						@endforeach
					  </select>
					 </label>
			    </div>
					<div class="form-group">
						<div class="input-group">
							
							<input type="text" class="form-control" name="program" id="program"  placeholder="Perimetre" required="required">
						</div>
					</div>