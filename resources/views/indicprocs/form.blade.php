<div class="form-group">
						<div class="input-group">
							
							<input type="text" class="form-control" name="name"  id="name" placeholder="Indicator's name" required="required">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							
							<input type="text" class="form-control" name="detail" id="detail"  placeholder="Details" required="required">
						</div>
					</div>
                      <div class="form-group">
                     
                       <label>Process:
                        <select  name="process_id" class="form-control select2" style="width: 300%;">
                          @foreach($processes as $process)
                           <option value="{{$process->id}}">{{$process->name}}</option>
                          @endforeach
                        </select>
                       </label>
		                 </div>