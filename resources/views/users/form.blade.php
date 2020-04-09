
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" class="form-control" name="name"  id="name" placeholder="Users's name" required="required">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <div class="input-group">	
			<input type="text" class="form-control" name="email"  id="email" placeholder="Users's email" required="required">
		</div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <input type="password" class="form-control" name="password"  id="password" placeholder="Users's password" required="required">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <input type="password" class="form-control" name="confirm-password"  id="confirm-password" placeholder="Confirm Password" required="required">
            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','id'=>'role','multiple')) !!}
        </div>
    </div>
   
</div>
