@extends('layouts.app')

@section('content')

<script>
	let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	let X;
	let Yval;
	let Ytar;
	let titre;
	let name;
	let per="T";
	let month;
	let year;
	let cper;
	let idchart;
	let months;
	let mygraphs = {};
</script>
  <!-- Main content -->
  <div class="content"><a  data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Filtres <b class="caret"></b></a>
				<ul class="dropdown-menu" >					
					<li><a href="#" value="M"   class="dropdown-item cper">Mensuelle</a></li>
					<li><a  href="#" value="T"  class="dropdown-item cper">Trimestrielle</a></li>
					<li><a  href="#" value="S"  class="dropdown-item cper">Semesterielle</a></li>
				</ul>
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-lg-6">
            <div class="card">
			<div class="card-header no-border">

  <h3 class="card-title">Processus  </h3>
                <div class="card-tools">
									<!-- Button trigger modal -->
<button type="button"class="btn" style="background-color:#6ed3f4;" data-toggle="modal" data-target="#exampleModal">
  Filtrer
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chercher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       </div>
    </div>
  </div>
</div> 
    </div>
			<div class="card-body">
			
				</div>
	
      </div>
			<!-- /.card -->
      </div>
            <div class="card">
              <div class="card-header no-border">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/affichage/affichage4') }}">
							{{ csrf_field() }}
							
							<div class="row">
								<div class="form-group col">
								  <label>Processus:
								  <select name="fprocs[]" multiple class="form-control select2" style="width: 100%;">
								  @foreach($procs as $proc)
									<option value="{{$proc->id}}" <?=in_array($proc->id, $fprocs)?'selected':'' ?> >{{$proc->designation}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
				
								<div class="form-group col">
								  <label>Indicateur:
								  <select name="findics[]" multiple class="form-control select2" style="width: 100%;">
								  @foreach($indis as $indic)
									<option value="{{$indic->id}}" <?=in_array($indic->id, $findics)?'selected':'' ?> >{{$indic->name}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
								
								<div class="form-group col">
								  <label>Projet:
								  <select name="fprojs[]" multiple class="form-control select2" style="width: 100%;">
								  @foreach($projs as $proj)
									<option value="{{$proj->id}}" <?=in_array($proj->id, $fprojs)?'selected':'' ?> >{{$proj->name}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>

								<div class="form-group col">
								  <label>Collaborateur:
								  <select name="fcolls[]" multiple class="form-control select2" style="width: 100%;">
								  @foreach($colls as $coll)
									<option value="{{$coll->id}}" <?=in_array($coll->id, $fcolls)?'selected':'' ?> >{{$coll->name_coll}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>

								<div class="form-group col">
								  <label>Mois:
								  <select name="fmois[]" multiple class="form-control select2" style="width: 100%;">
								  @foreach($mois as $moi)
									<option value="{{$moi->nmoi}}" <?=in_array($moi->nmoi, $fmois)?'selected':'' ?> >{{$moi->nmoi}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>

								<div class="form-group col">
								  <label>Année:
								  <select name="fanne" class="form-control select2" style="width: 100%;">
								  @foreach($annes as $anne)
									<option value="{{$anne->nanne}}" <?=$anne->nanne==$fanne?'selected':'' ?> >{{$anne->nanne}}</option>
								  @endforeach
								  </select>
								 </label>
								</div>
							</div>
							<div class="form-group text-right">
								<button type="submit" class="btn btn-primary">Chercher</button>
							</div>
						</form>
					
				
                </div>
              </div>
              <div class="card-body p-0">
              <?php foreach($data as $projet) { ?>
								
								<h1>Projet: <?=$projet['name'] ?></h1>
								
								<?php foreach($projet['indics'] as $indic) { ?>
                                   
								<div id="container<?=$indic['idg'] ?>" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
								<script>
									X = [];
									Yval = [];
									Ytar = [];
									titre = '<?= "{$indic['name']} Projet {$projet['name']} " ?>';
									name = <?= "'{$indic['name']}'" ?>;

									<?php foreach($indic['collabs'] as $row) { ?>
										X.push(<?= "'{$row->name}'" ?>);
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
								<?php
									}
								}
								?>	            
							
								
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header no-border">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Projets</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">

                </div>
                <!-- /.d-flex -->
             </div>       
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header no-border">
                <h3 class="card-title">Online Store Overview</h3>
                <div class="card-tools">
               
                </div>
              </div>
              <div class="card-body">
              <div class="d-flex">
              </div>
                <!-- /.d-flex -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
   
@endsection