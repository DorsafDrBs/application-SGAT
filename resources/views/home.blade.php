@extends('layouts.app')

@section('content')

<script>
	let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	let X;
	let Yval;
	let Ytar;
	let titre;
	let name;
	let per="M";
	let month;
	let year;
	let cper;
	let idchart;
	let months;
	let mygraphs = [];

	function updateChart(mygraph, per)
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

		mygraph['months'].forEach(function(month) {
			
			sumval+=month["value"];
			sumtar+=month["target"];
			i++;
			
			if(i%moisper==0)
			{ 
				if(per=="M") {
					X.push(monthName[new Date(month["created_at"]).getMonth()]);
				}
				else { 
					X.push(per+cp);
				}
				Yval.push(Math.ceil((sumval/moisper)  * 100) / 100);
				Ytar.push(Math.ceil((sumtar/moisper)  * 100) / 100);
				cp++;
				sumval=0;
				sumtar=0;
			}
		});
			
		var chart=Highcharts.chart(mygraph['idchart'], {
			chart: {
				zoomType: 'xy'
			},
			title: {
				text: mygraph['titre'] // title 
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
					text: mygraph['name'], // name of kpi
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
			
			xAxis: [{
				categories: X, // CREATED AT . IL FAUT SELECTIONNER les noms des mois !!
				crosshair: true
			}],
			credits: {
    enabled: false
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
	}
</script>
		
  <!-- container -->

<div class="container-fluid">

<div class="row">
	<div class="col-lg-6 col-md-4 col-sm-6 col-xs-6 demo">
		<div class="demo-container">
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 footer-container d-flex">
				<a  data-toggle="dropdown" class="nav-link dropdown-toggle text-info mt-auto p-2 " href="#">Filtres <b class="caret"></b></a>
				    <ul class="dropdown-menu" >	
					<li><a href="#" value="Q"   class="dropdown-item cper text-info">Weekly</a></li>				
					 <li><a href="#" value="M"   class="dropdown-item cper text-info">Mensual</a></li>
					 <li><a  href="#" value="T"  class="dropdown-item cper text-info">Trimestrial</a></li>
					 <li><a  href="#" value="S"  class="dropdown-item cper text-info">Semesterial</a></li>
				     </ul>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 image-container">
			 <div id="demo" class="carousel slide" data-ride="carousel">
				   <ul class="carousel-indicators"> 
				        <li data-target="#demo" data-slide-to="0" class="active"></li>
                    </ul>
				<?php foreach($datap as $project) { ?>
					
			      <?php foreach($project['indics'] as $indic) { ?>
					
					<div class="carousel-inner">
                       <div class="card carousel-item active">
	                      <div id="containerp<?=$indic['idg'] ?>" style="min-width: 230px; height: 270px; margin: 0 auto"> </div>
                        </div>
					
							 <script>
								 titre = '<?= "{$indic['name']} Projet {$project['name']}" ?>';
								 name = '<?= "{$indic['name']}" ?>';
								 idchart = 'containerp<?="{$indic['idg']}"?>';
								 
								 months = [];
								 <?php foreach($indic['mont ,hs'] as $row) {?>
								 months.push({"value":<?="{$row->value}"?>, "target":<?="{$row->target}"?>, "created_at":<?= "'{$row->created_at}'" ?>});
								 <?php } ?>
								 
								 mygraphs.push({"idchart":idchart, "titre":titre, "name":name, "months":months});

							 </script> 
					</div>
		        <?php }	} ?>

							 <script>
								 mygraphs.forEach(function (mygraph)
								  {
									 updateChart(mygraph, per);
								 });
								 
								 $(".cper").click(function () {
									 per = $(this).attr("value");
									 mygraphs.forEach(function (mygraph) {
										 updateChart(mygraph, per);
									 });
								 });
							 </script>
				     <a class="carousel-control-prev bg-blue" href="#demo" data-slide="prev"> 
                         <span class="carousel-control-prev-icon">prev</span>
                     </a>
                     <a class="carousel-control-next" href="#demo" data-slide="next">
                         <span class="carousel-control-next-icon"></span>
                    </a>	
			  </div> 
			</div>
			<div class="clearfix"></div>
		</div>
	</div>



			<div class="clearfix visible-sm visible-xs"></div>	
	<div class="col-lg-12 col-md-10 col-sm-10 col-xs-10 demo">
			<div class="demo-container">
				<div class="col-lg-12  footer-container d-flex">
                          <h3 class="mr-auto p-2" >Processes <?=$data['name'] ?> </h3>
				         <!-- Button trigger modal -->
                          <a href="#"class="p-2 text-info bg- " data-toggle="modal" data-target="#exampleModal">Filtrer</a>   
				</div>
				<div class="col-lg-12 image-container d-flex">
					<?php foreach($data['indics'] as $row) { ?>
					   
						    <div class="p-2" id="container<?=$row->id ?>" style="width:300px;height:250px;"> 
							</div>
	                        <script type="text/javascript">
		                          month = monthName[new Date(<?= "'{$row->created_at}'" ?>).getMonth()];
                                   year = new Date(<?= "'{$row->created_at}'" ?>).getFullYear();
                                  titre = '<?= "{$row->name}" ?> - ' + month + ' ' + year;

                                  var dom = document.getElementById("container<?="{$row->id}"?>");
                                  var myChart = echarts.init(dom);
                                  var app = {};

                                   option = {
									tooltip: {
	                                  formatter: "{a} <br/>{b} : {c}%"
	                                          },                                 
								     pointer: {
	                                       length: '80%',
	                                        width: 7,
	                                        color: 'auto'
	                                        },
                                      title: { text: titre,     
											 show: true,
											 left: '50.67%',
											 right: '30.67%',
                                             top: '90%',
                                             textAlign: 'center',
	                                         textStyle: {
												fontFamily: 'sans-serif',
	                                            color: '#010456',
	                                            fontSize: 16
												} 
											 },
                                     series: [
                                              {
												name: 'process',
                                               type: 'gauge',
			                                    center: ["50%", "50%"],
											   radius: "80%",
											   startAngle: 140,
                                               endAngle: -140,
											   splitNumber: 10,
											   min: 0,
	                                           max: 100,
	                                          precision: 0,
											   axisLine : {
                                                     show : true,
                                                     lineStyle : { 
                                                         color : [ 
                                                              [0.5, "#DA462C" ],
                                                              [ 0.9, "#FF9618" ],
                                                              [ 1,"#20AE51" ]
                                                              ],
													     width : 25
													         }
														   },
											  axisTick: {
	                                                     show: true,
	                                                      splitNumber: 5,
	                                                     length: 8,
	                                                     lineStyle: {
	                                                               color: '#eee',
	                                                               width: 1,
	                                                               type: 'solid'
	                                                                }
	                                                     },
														 axisLabel: {
	                                                                 show: true,
																	 formatter: function(v) 
																	   {
																		  switch (v + '') 
																		   {
	                                                                         case '0':
	                                                                              return '0';
	                                                                         case '20':
	                                                                             return '20';
	                                                                         case '40':
	                                                                              return '40';
	                                                                         case '60':
	                                                                             return '60';
	                                                                         case '80':
	                                                                             return '80';   
	                                                                         default:
	                                                                             return '';
	                                                                        }
	                                                                     }
	                                                                  },
											   
											   detail: {
	                                                     show: true,
	                                                     backgroundColor: 'rgba(0,0,0,0)',
	                                                     borderWidth: 0,
	                                                     borderColor: '#ccc',
	                                                     width: 100,
	                                                     height: 40,
	                                                    offsetCenter: ['-60%', 10],
	                                                     formatter: '{value}%',
	                                                     textStyle: {
	                                                                 color: 'auto',
	                                                                  fontSize: 30
														             }
													    },
                                               data: [{value: <?="{$row->value}"?>}]
                                                },
                                              ]
											};
											
										   if (option && typeof option === "object")
											   {  myChart.setOption(option, true);  }
                             </script>
					   
					<?php } ?>
				 </div>

				<div class="clearfix"></div>
			 </div>
	</div>
</div>
	  <!-- Modal filter for gauge -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-form" role="document">
     <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Search</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
        </div>
        <div class="modal-body">
                 <form class="form-horizontal" role="form" method="POST" action="{{ route('home') }}">
						{{ csrf_field() }}
							<div class="row">
							<div class="form-group col">
						<div class="input-group">
								  <label>Process:
								  <select name="fproc" class="form-control select2" style="width: 100%;">
								  @foreach($procs as $proc)
									<option value="{{$proc->id}}" <?=$proc->id==$fproc?'selected':'' ?> >{{$proc->name}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
								</div>
								<div class="form-group col">
								<div class="input-group">
								  <label>Month:
								  <select name="fmois" class="form-control select2" style="width: 100%;">
								  @foreach($mois as $moi)
									<option value="{{$moi->nmoi}}" <?=$moi->nmoi==$fmois?'selected':'' ?> >{{$moi->nmoi}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
								</div>
								<div class="form-group col">
								<div class="input-group">
								  <label>Year:
								  <select name="fanne" class="form-control select2" style="width: 100%;">
								  @foreach($annes as $anne)
									<option value="{{$anne->nanne}}" <?=$anne->nanne==$fanne?'selected':'' ?> >{{$anne->nanne}}</option>
								  @endforeach
								  </select>
								 </label>
								</div>
								</div>
						
	                         <button type="submit" class="btn btn-primary btn-block">Search</button>
	                     </div>
	            </form>    
	     </div>
     </div>
  </div>
</div> 
  <!-- /Modal filter for gauge-->
  </div> 

	
@endsection