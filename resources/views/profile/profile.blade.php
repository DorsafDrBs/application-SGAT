
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
<style>
.card {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}
.card {
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 2px;
  background-clip: padding-box;
  min-height:500px;
}
.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 17px;
}
.card .card-image img {
  border-radius: 2px 2px 0 0;
  background-clip: padding-box;
  min-width:305px;
  max-width:400px;
  position: relative;
}

.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 16px;
}

</style>
<div class="container-fluid">
  <div class="row">
        
    <div class="col-sm-3">
      <div class="card  ">
        <div class="card-image">
          <img class="img-responsive" src="/uploads/images/{{Auth::user()->picture }}">
          <h3 class="text-center">{{ Auth::user()->name }} </h3>
          <div class="card-body">
        <p class="text-center"> <?=Auth::user()->getRoleNames()[0]?></p>
        <a href="#" data-toggle="modal" data-target="#exampleModal"class="btn btn-primary btn-block "><b>Edit</b></a>
        </div> </div>
        </div>
    </div>
       <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
         <div class="modal-content">
              <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                <div class="col-lg-12 col-md-offset-2">
                 <img src="/uploads/images/{{ Auth::user()->picture }}" style="width:300px; height:300px; ">
                </div>
             </div>
             <div  class="modal-footer">
             <form method="post" enctype="multipart/form-data" action="{{route('profile.update')}}" >
                @csrf
                <input type="file" name="picture">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                 <button type="button" class="btn btn-primary">Save changes</button>
             </form>
             </div>
          </div>
         </div>
      </div>
       <!-- /Modal -->
    <div class="col-md-9 ">
      <div class="card ">
        <div class="card-body">
          <div class="row">
				  	<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 title">
							<h2>ABOUT <b class="text-info">ME </B></h2>
					  </div>
						<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
					     <h2><b> {{ Auth::user()->name }} </b></h2>
               <h2><?=Auth::user()->getRoleNames()[0]?></h2>
               <p>Email:{{ Auth::user()->email }} </p>
               <p>Phone: {{ Auth::user()->phone }} </p>
            </div>	
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                <?php foreach($dataproc as $proc) { ?>  
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-6 demo  ">
                    <div class="demo-container ">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-container">
                        <h3> Projects of process <?=$proc['name'] ?> </h3>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-white ">
                        <?php foreach($proc['projects'] as $proj) { ?>
                          <a  href="#" class="list-group-item list-group-item-action"> <?="'{$proj->project_name}'"?></a>
                        <?php }?>
                      </div>
                    </div> 
                   </div>  
                 <?php }?> 
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
    <!-- Charts -->	
  <div class="col-md-12">
    <div class="card ">
    <div class="card-body ">
        <div class="row">
            <!-- Form -->	
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 demo">    
          <div class="demo-container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-white">
							<div id="container<?=$indic['idg'] ?>"style="min-width: 310px; height: 300px; margin: 0 auto"></div>
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
										},
                    credits: {
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
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-container"><h3 class="">Logarithmic axis</h3></div>
							<div class="clearfix"></div>
						</div>
			    </div>
       <?php }	}	?>
      </div>  
    </div>
     <!-- /.endforeach -->
    </div>  
   </div> 
  </div>  
 </div>
   <!-- /Charts -->	   
  <div class="col">
    <div class="card ">
      <div class="card-body">
      
      <!-- row 2 -->
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
       </div> 
       <!-- /.row -->
     </div>
     </div> </div> </div>
 </div>
 <!-- /.row -->

</section>
<!-- /.content -->

    @endsection
  