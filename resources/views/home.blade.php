@extends('layouts.app')

@section('content')

<script>
	let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	let X;
	let Yval;
	let Ytar;
	let titre;
	let name;let per="T";
	let month;
	let year;
	let cper;
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

  <h3 class="card-title">Processus <?=$data['name'] ?> </h3>
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
    <form class="form-horizontal" role="form" method="POST" action="{{ route('home') }}">
							{{ csrf_field() }}
							
							<div class="row">
								<div class="form-group col">
								  <label>Processus:
								  <select name="fproc" class="form-control select2" style="width: 100%;">
								  @foreach($procs as $proc)
									<option value="{{$proc->id}}" <?=$proc->id==$fproc?'selected':'' ?> >{{$proc->name}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
				
								<div class="form-group col">
								  <label>Mois:
								  <select name="fmois" class="form-control select2" style="width: 100%;">
								  @foreach($mois as $moi)
									<option value="{{$moi->nmoi}}" <?=$moi->nmoi==$fmois?'selected':'' ?> >{{$moi->nmoi}}</option>
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
						

      <div class="modal-footer">
	  <button type="submit" class="btn btn-primary align">Chercher</button>
	  </div>
	</form>      </div>
    </div>
  </div>
</div> 
    </div>
			<div class="card-body">
					<?php foreach($data['indics'] as $row) { ?>
						<div class="float-left mr-1">
							
						<div id="container<?=$row->id ?>" style="width:250px;height:270px;"></div>
	
		  <script type="text/javascript">
		  
		  month = monthName[new Date(<?= "'{$row->created_at}'" ?>).getMonth()];
							year = new Date(<?= "'{$row->created_at}'" ?>).getYear();
							titre = '<?= "{$row->name}" ?> - ' + month + ' ' + 2019;

var dom = document.getElementById("container<?="{$row->id}"?>");
var myChart = echarts.init(dom);
var app = {};


option = {
   
     title: { text: titre,     
	    show: true,
	      offsetCenter: ['-65%', 0],
	      textStyle: {
	        color: '#3f3e42',
	        fontSize: 19
	      } },
    series: [
        {startAngle: 200,
                 endAngle: -20,
				 splitNumber: 10,

                 axisLine : {
                     show : true,
                     lineStyle : { 
                         color : [ 
                             [0.5, "#DA462C" ],
                             [ 0.9, "#FF9618" ],
                             [ 1,"#20AE51" ]
                         ],
                         width : 25}
                     },
            name: '50%',
            type: 'gauge',
			center: ["50%", "45%"],
                 radius: "80%",
            detail: {formatter:'{value}%'},
            data: [{value: <?="{$row->value}"?>, name: '97%'}]
        }
    ]
};


if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
</script>
				
						</div>
					<?php } ?>
				</div>
	
      </div>
			<!-- /.card -->
      </div>
            <div class="card">
              <div class="card-header no-border">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
			
                </div>
              </div>
              <div class="card-body p-0">
                               
								
								<?php foreach($datap as $project) { ?>
								
								<h1>Projet: <?=$project['name'] ?></h1>
								
								<?php foreach($project['indics'] as $indic) { ?>
								
								<div id="containerp<?=$indic['idg'] ?>" style="min-width: 290px; height: 300px; margin: 0 auto"></div>
								<script>

									titre = '<?= "{$indic['name']} Projet {$project['name']}" ?>';
									name = '<?= "{$indic['name']}" ?>';
								

									var chart=Highcharts.chart('containerp<?="{$indic['idg']}"?>', {
										chart: {
											zoomType: 'xy'
										},
										title: {
											text: titre // title 
										},
										
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
										
									});
									function updateChart(chart) 
									{	
										X = [];
									Yval = [];
									Ytar = [];
									let i=0;
									let cp=1;
									let moisper;
									let sumval=0;
									let sumtar=0;
							switch(per) {
                                           case "T":
                                              moisper=3;
											
                                              break;
	                                        case "S":
                                              moisper=6;	  
                                              break;
                                            default:
                                               moisper=1;	 
                                       }
									 
								 
									<?php foreach($indic['months'] as $row) {?>
									sumval+=<?="{$row->value}"?>;
									sumtar +=<?="{$row->target}"?>;
									i++;

									if(i%moisper==0)
									{ 
							if(per=="M"){
								        X.push(monthName[new Date(<?= "'{$row->created_at}'" ?>).getMonth()]);
										
										}
							else        { 
										X.push(per+cp);
										}
										Yval.push(sumval/moisper);
										Ytar.push(sumtar/moisper);
									
										cp++;
										sumval=0;
										sumtar=0;
									}
									<?php } ?>
									chart.update({
										xAxis: [{
											categories: X, // CREATED AT . IL FAUT SELECTIONNER les noms des mois !!
											crosshair: true
										}],
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
									}
								
									updateChart(chart);
									$(".cper").click(function () {
							  per = $(this).attr("value");
						alert(per);
						updateChart(chart );
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