                       <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputname2">Name </label>
                            <input type="text" class="form-control sm-input" name="name"  id="name"   placeholder="Entrer le nom de l'indicateur">
                       </div>
                      <div class="col-3 form-group ">
                            <label class="sr-only" for="exampleInputdetail2">Detail</label>
                            <input type="text" class="form-control sm-input" name="detail"  id="detail"  placeholder="Entrer un detail">
                      </div> 
                      <div class="col-xs-12 col-sm-12 col-md-12">
                       <label>Process:
                        <select  name="process_id" class="form-control select2" style="width: 300%;">
                          @foreach($processes as $process)
                           <option value="{{$process->id}}">{{$process->name}}</option>
                          @endforeach
                        </select>
                       </label>
		                 </div>