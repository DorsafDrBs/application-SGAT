
@extends('layouts.app')

@section('content')

          <script>
				let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
				let X;
				let Yval;
		    let Ytar;
				let titre;
				let name;
				</script>

 
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- col -->
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                @if ("/storage/images/{{ Auth::user()->picture }}")
                <img class="profile-user-img img-fluid img-circle"  src="{{ Auth::user()->picture }}"/>
    @else
            <p>No image found</p>
    @endif 
                </div>
                <h3 class="profile-username text-center"> {{ Auth::user()->name }} </h3>
                <p class="text-muted text-center">{{Auth::user()->role}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email : </b> <a class="float-right">{{Auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone :</b> <a class="float-right">{{Auth::user()->phone_number}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
          </div>
          <!-- /.col -->
          <!-- col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Indicators</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"> Projects</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Parameters</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <div class="row">
            <!-- Line chart -->	
            <div class="col-md-9">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('profile.index') }}">
            {{ csrf_field() }}
                <ul class="nav nav-pills" >
								  @foreach($projs as $proj)
									<li class="nav-item"><button type="submit" name="fprojs"  class="btn btn-outline-primary "  
                  value="{{$proj->id}}" > {{$proj->project_name}} </button></li>
								  @endforeach
								  </ul> 
                </form>
								</div>
                
                <?php foreach($data as $project) { ?>
                 
                <?php foreach($project['indics'] as $indic) { ?> 
                  <div class="col-md-6">
            <div class="card  card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bar-chart-o"></i>
                  <?= "{$indic['name']} Projet {$project['project_name']}" ?>
                </h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
             
								<div id="container<?=$indic['idg'] ?>" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
								<script>
									X = [];
									Yval = [];
									Ytar = [];
									titre = '<?= "{$indic['name']} Projet {$project['project_name']} " ?>' ;
									name = <?= "'{$indic['name']}'" ?>;

									<?php foreach($indic['collabs'] as $row) { ?>
										X.push(monthName[new Date(<?= "'{$row->created_at}'" ?>).getMonth()]);
										Yval.push(<?="{$row->value}"?>);
										Ytar.push(<?="{$row->target}"?>);
									<?php } ?>

									Highcharts.chart('container<?="{$indic['idg']}"?>', {
										chart: {
											zoomType: 'xy'
										},
										title: {
											text: titre // title 
										},credits: {
    enabled: false
  },
										xAxis: [{
											categories: X, // CREATED AT . IL FAUT SELECTIONNER les noms des mois !!
											crosshair: true
										}],
										yAxis: [{ // Primary yAxis, CREATED AT . IL FAUT SELECTIONNER les noms des mois !!
											min: 0,
											max: 100,
																						 
											labels: {
											 
												format: '{value}%',
												style: {
													color: Highcharts.getOptions().colors[1]
												}
											},
											title: {
												text: name, // name of kpi
												style: {
                     
													color: Highcharts.getOptions().colors[1]
												}
											}
										}],
										tooltip: {
											shared: true
										},
										legend: { // declaration
											layout: 'vertical',
											align: 'left',
											x:550,
											verticalAlign: 'top',
											y:0,
											floating: true,
											backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
										},
										series: [{
											name: 'Valeur',
											type: 'column',
										
											data: Yval, // TARGET DATA
											tooltip: {
												valueSuffix: '%'
											}

										}, {
											name: 'Target',
											type: 'spline',
									
											data: Ytar, // VALUE DATA
											tooltip: {
												valueSuffix: '%',
												
											}
										}]
									});
								</script>
              </div>
              <!-- /.card-body-->
            </div> 

            </div> 
            <!-- /.card -->
            <?php }	}	?>
             </div>  
       </div>
     <!-- /.tab-pane -->
 
     <!-- The timeline -->         
      <div class="tab-pane" id="timeline">       
  <div class="row"><?php foreach($dataproc as $proc) { ?>
     <div class="col-md-6">
        <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Projects of process <?=$proc['name'] ?>   </h3>
              </div>
                  <!-- /.card-header -->
              <div class="card-body"> 
              <div class="list-group">
              <?php foreach($proc['projects'] as $proj) { ?>
                <a  href="#" class="list-group-item list-group-item-action"> <?="'{$proj->project_name}'"?></a>
                <?php }?>
              </div>
              </div>
              <!-- /.card-body -->
        </div>
         <!-- /.card --> 
       
     </div>
      <!-- /.col -->  <?php }?>
   </div>
  <!-- /.row -->
    <div class="row"> 
     <div class="col-12">
<?php foreach($datac as $proj) { ?>

     <div class="card">
              <div class="card-header">
                 <h3 class="card-title">Users works in project <?=$proj['project_name'] ?> </h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
       <table class="table table-hover">
          <tr>
           <th>Nom</th>
           <th>E-mail</th>
         </tr>    
         <?php foreach($proj['collabs'] as $collab) { ?>
          <tr>
             <td><a class="text-muted"  href="{{ url('profile.index') }}/<?="{$collab['id']}"?>" style="color:dark;" ><?="{$collab['name']}"?></a></td>
             <td><?="{$collab['email']}"?>
            
         </tr>
             <?php }?>
       </table>
     </div>
   </div>
    
   <?php }?>
   </div>
  </div>  </div>
        <!-- /.row -->
  <!-- /.tab-pane -->
 <div class="tab-pane" id="settings">
   <div class="col-md-6">    
        <!-- navbar -->       
      <nav class="navbar navbar-default">
            <!-- container-fluid -->
	    	<div class="container-fluid">
		      	<div class="navbar-header">
			    	<a class="navbar-brand" href="#">Change profile picture</a>
		      	</div>
		   </div>
        <!-- /.container-fluid -->
         <!-- container -->
    	<div class="container">
      <div class="row justify-content-center">
            <form action="{{ route('profile.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="picture" id="pictureFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">  Please download a valid image file. The size of the image should not exceed 2 MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
     	</div>
        <!-- /.container -->
  	</nav>
     <!-- /.navbar -->
   </div>
     <!-- /.col -->
  </div>
  <!-- /.tab-pane -->
      
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @endsection
  