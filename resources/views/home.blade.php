@extends('layouts.app')

@section('content')
<style>
.dropdown-submenu {
  position: relative;
}
.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}

.filterDiv {
  float: left;
  
  width: 100px;

  text-align: center;
  margin: 2px;
  display: none;
}
.show {
  display: block;
}
 
</style>
<script>
	let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	let X;
	let Yval;
	let Ytar;
	let titre;
	let target;
    let week;
	let name;
	let month;
	let year;
	let cper;
	let idchart;
	let months;
	let mygraphs = [];
	let max;
	let per="semaine";

	function updateChart(mygraph, per)
	{	
		X = [];
		Yval = [];
		Ytar = [];
		let i=0;
		let prefix=per[0].toUpperCase();
		
		//per: annee, trimestre, mois, semaine
			let sumvals = {};
		
		mygraph['months'].forEach(function (row) {

			let cprofound=false;
	$("body .cpro").each(function (){
			let selectcpro = $(this);
		     let cproval=selectcpro.val();
		     let cproname=selectcpro.attr("name");
		 //value of select : type string (pas multiple)
		 if((typeof cproval=="string" || typeof cproval=="number") && row[cproname]===cproval)
		 {
			 cprofound=true;
			
		 }
		 else 
		 { console.log(cproval); 
			 cproval.forEach(function (val)
			{
			   if(row[cproname]==val)
			   {
				   cprofound=true;
				  return false ;
			   }
			});
		 }
		 return !cprofound;
			});
			if(!cprofound)
			return true;
			let value=row["value"];
			let target=row["target"];
			let nbper=row[per];
			
			if (nbper in sumvals) {
				sumvals[nbper]["value"] += value;
				sumvals[nbper]["target"] += target;
				sumvals[nbper]["cnt"] += 1;
			}
			else {
				sumvals[nbper] = {value: value, target: target, cnt: 1};
			}
		});
		
		Object.entries(sumvals).forEach (([nbper, row]) => {
			let lb = prefix + nbper;
			if(per=="mois") {
				lb = monthName[new Date(nbper).getMonth()];
			}
			
			X.push(lb);
			Yval.push(Math.ceil((row["value"]/row["cnt"]) * 100) / 100);
			Ytar.push(Math.ceil((row["target"]/row["cnt"]) * 100) / 100);
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
	<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
  
});
</script>	
  <!-- container -->
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
					   
						    <div class="col-sm-3 p-2" id="container<?=$row->id ?>" style="width:250px;height:250px;"> 
							</div>
	                        <script type="text/javascript">
		                          month = <?= "'{$row->mois}'" ?>;
                                   year = <?= "'{$row->annee}'" ?>;
								   week = <?= "'{$row->semaine}'" ?>;
                                  titre = '<?= "{$row->detail}" ?> - W'+ week+'-'+ month + ' ' + year;
								  target= 'Target :'+' '+<?="'{$row->operator_cp}'+'{$row->target}'+'{$row->unit}'"?>;
							
                                  var dom = document.getElementById("container<?="{$row->id}"?>");
                                  var myChart = echarts.init(dom);
                                  var app = {};

                                   option = {
									tooltip: {
	                                  formatter: "{a} <br/>{b} : {c}%"
	                                          },                                 
								     pointer: {
	                                       length: '70%',
	                                        width: 5,
	                                        color: 'auto'
	                                        },
                                      title: { text: titre +"\n"+ target ,
											 show: true,
											 left: '56.67%',
											 right: '30.67%',
                                             top: '70%',
										
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
											   startAngle: 200,
                                               endAngle: -20,
											   min:0,
									max:<?="{$row->max}"?>,
											 
	                                        
											   axisLine : {
                                                     show : true,
                                                     lineStyle : { 
														<?php if( ("{$row->operator_cp}"=="<") ||("{$row->operator_cp}"=="<=")||("{$row->target}"=="0")) {?>
                                                         color : [ 
                                                              [(<?="{$row->target}"?>+0.01)/100, "#20AE51" ],//vert
                                                             [ (<?="{$row->target}"?>+<?="{$row->orange}"?>)/100, "#FF9618" ],//jaune
                                                              [ <?="{$row->max}"?>, "#DA462C"]// rouge
															  ],
															  <?php } else if( ("{$row->operator_cp}"==">") ||("{$row->operator_cp}"==">=")||("{$row->operator_cp}"=="=")) {?>
															    color : [ 
                                                              [(<?="{$row->target}"?>-<?="{$row->orange}"?>)/100, "#DA462C" ],//rouge
                                                             [ (<?="{$row->target}"?>-0.05)/100, "#FF9618" ],//jaune
                                                              [ <?="{$row->max}"?>,"#20AE51" ]// vert
															  ],
															  <?php }  ?>
													     width : 24
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
														 
											   
											   detail: {
	                                                     show: true,
	                                                     backgroundColor: 'rgba(0,0,0,0)',
	                                                     borderWidth: 0,
	                                                     borderColor: '#ccc',
	                                                     width: 90,
	                                                     height: 40,
	                                                    offsetCenter: ['0%', 30],
	                                                     formatter: '{value}<?="{$row->unit}"?>',
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
									<option value="{{$moi->mois}}" <?=$moi->mois==$fmois?'selected':'' ?> >{{$moi->mois}}</option>
								  @endforeach
								  </select>
								  </label>
								</div>
								</div>
								<div class="form-group col">
								<div class="input-group">
								  <label>Week:
								  <select name="semaines" class="form-control select2" style="width: 100%;">
								  @foreach($semaines as $semaine)
									<option value="{{$semaine->semaine}}" <?=$semaine->semaine==$fsemaine?'selected':'' ?> >{{$semaine->semaine}}</option>
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
									<option value="{{$anne->annee}}" <?=$anne->annee==$fanne?'selected':'' ?> >{{$anne->annee}}</option>
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
	
			<!--modal filter for chart bar projects-->
	<div class="modal fade bd-example-modal-lg" id="filterModalproject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Modal title</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 
	   {{ Form::open() }}
	   <div class="row" >
               <div class="col-lg-4 form-group modal-form">
                    <label>Project :		
				 <select  id="projects" name="project_name" class="form-control cpro" style="width: 150%;">
					    
					     @foreach($projects as $key =>$value)
					       <option value="{{ $value->project_name }}">{{ $value->project_name }}</option>
					     @endforeach
					  </select>
					  </label>
		       </div>
		   <div class="col-lg-6 form-group modal-form ">
               <label>indicators
                   <select width="200%" id="indic_id" name="name" class="form-control name cpro input-lg" >
		            
		             @foreach($pjindicators as $indicator)
	                  <option  value="{{$indicator->name}}" >{{$indicator->name}}</option>
                     @endforeach
                   </select>
                </label>
        	</div>
      </div>
	<div class="row" >
	       <div class="col-lg-4  form-group modal-form">
                 <label>Tache :
				  <select name="tache" id="taches"class="form-control cpro"style="width:150px">
					
				  </select>
			   </label>
		   </div>
           <div class="col-lg-4  form-group modal-form">
                 <label>Program : 
				    <select name="program" id="programs"class="form-control cpro"style="width:150px">
					
					</select>
				</label>
			</div>
            <div class="col-lg-4  form-group modal-form">
                <label>Perimetre : 
				   <select  id="perimetre" name="perimetre" class="form-control cpro" style="width: 150%;">
		
				   </select>
			    </label>
			</div>
         {{ Form::close() }}
	   </div>
 <script type="text/javascript">
   $('#projects').on('change', function(e){
	 console.log(e);
	 
  
        var project_name = e.target.value;
        $.get('/json-home-taches?project_name=' + project_name,function(data) {
       console.log(data);
       $('#taches').empty();
          $('#taches').append('<option value="" disable="false" selected="true">  </option>');

          $('#programs').empty();
          $('#programs').append('<option value="" disable="false" selected="true">  </option>');

          $('#perimetres').empty();
       

          $.each(data, function(index, tachesObj){
            $('#taches').append('<option value="'+ tachesObj.tache +'">'+ tachesObj.tache +'</option>');
          })
        });
      });
   $('#taches').on('change', function(e){
     console.log(e);
        var tache_name = e.target.value;
        $.get('/json-home-programs?tache_name=' + tache_name,function(data) {
       console.log(data);
          $('#programs').empty();
          $('#programs').append('<option value="" disable="false" selected="true"> </option>');

          $('#perimetres').empty();

          $.each(data, function(index, programsObj){
            $('#programs').append('<option value="'+ programsObj.program +'">'+ programsObj.program +'</option>');
          })
        });
      });

    $('#programs').on('change', function(e){
        console.log(e);
        var programs_name = e.target.value;
        $.get('/json-home-perimetres?programs_name=' + programs_name,function(data) {
        console.log(data);
          $('#perimetres').empty();
         
          $.each(data, function(index, perimetresObj){
            $('#perimetres').append('<option value="'+ perimetresObj.perimetre +'">'+ perimetresObj.perimetre +'</option>');
          })
        });
      });
</script>
<div class="row"> 
<div class="col-lg-4 form-group modal-form"> 
     <label>Periode
	 <select name="periode"  class="form-control name cpro input-sm" >
	     <option  id="per" value="semaine" class=" cpro" >Weekly</option>
		 <option  id="per" value="mois"class=" cpro ">Monthly</option>
		 <option id="per" value="trimestre" class="cpro " >Trimestral</option>
		 <option id="per" value="semestre"class="cpro " >Semestral</option>
       </select>
      </label>
   </div>
   <div class="col-lg-4 form-group modal-form"> 
     <label>Years
      <select name="annee"  class="form-control name cpro input-sm" >
        @foreach($pjannee as $annes)
	     <option value="" >{{$annes->annee}}</option>
         @endforeach
       </select>
      </label>
   </div>
   <div class="col-lg-4 form-group modal-form ">
      <label>Weeks
      <select  name="semaine"multiple style="width: 200%;" class="form-control name cpro input-sm" >
	  @foreach($pjsemaine as $semaine)
	     <option value="" >{{$semaine->semaine}}</option>
         @endforeach
      </select>
      </label>
     </div>
</div>

</div>
</div>
<script>
	 $(document).ready(function(){

$(document).on('change','.projectindic',function(){
console.log("hmm its change");

	var proj_id=$(this).val();
	// console.log(proj_id);
	var div=$(this).parent();

	var op=" ";

	$.ajax({
		type:'get',
		url:'{!!URL::to('findProjectName')!!}',
		data:{'id':proj_id},
		success:function(dataind){
			console.log('success');

			//console.log(data);

			//console.log(data.length);
			op+='<option value="0" selected disabled>chose project</option>';
			for(var i=0;i<dataind.length;i++){
			op+='<option value="'+dataind[i].id+'">'+dataind[i].name+'</option>';
		   }

		   div.find('.name').html(" ");
		   div.find('.name').append(op);
		},
		error:function(){

		}
	});


	});

	});

	
</script>

      <div class="modal-footer modal-form">
        <button type="button" id="filtersearchbtn" class="btn btn-primary">Save changes</button>
		<script>
	
	$("body .filtersearchbtn").click(function () {
			 mygraphs.forEach(function (mygraph) {
										 updateChart(mygraph, per);
									 });
								 });
	 </script>
      </div>
    </div>
  </div>
  </div>
	<!--end modal filter -->
	
	<div  class = " container-fluid " >

<div class="row">
<div class="clearfix visible-sm visible-xs"></div>	
	<div class="col-lg-12 col-md-10 col-sm-10 col-xs-10 demo">
			<div class="demo-container">
				<div class="col-lg-12  footer-container d-flex">

       <h3 class="mr-auto p-2" >Projects </h3>
	   <a href="#"class="p-2 text-info bg- "  data-toggle="modal" data-target="#filterModalproject">Filter </a>
	 </div>  

  <div class="col-lg-12 ">
	 
				<?php foreach($datap as $project) { ?>
					
			      <?php foreach($project['indics'] as $indic) { ?>
					<div class="col-lg-12" >
	                      <div class="col-lg-12" height="500px"id="containerp<?=$indic['idg'] ?>" style="min-width: 300px; height: 300px; margin: 0 auto"> </div>
                      
							 <script>
								 titre = '<?= "{$indic['name']} Projet {$project['name']} {$project['tache']} " ?>';
								 name = '<?= "{$indic['name']}" ?>';
								 idchart = 'containerp<?="{$indic['idg']}"?>';
								 
								 months = [];
								 <?php foreach($indic['months'] as $row) {?>
								 months.push({"value":<?="{$row->value}"?>, "target":<?="{$row->target}"?>,"name":<?="'{$row->name}'"?>,
								 "project_name":<?="'{$row->project_name}'"?>,"tache":<?="'{$row->tache}'"?>,"program":<?="'{$row->program}'"?>,
								 "perimetre":<?="'{$row->perimetre}'"?>, "semaine":<?= "{$row->semaine}" ?>, "mois":<?="{$row->mois}"?>, 
								 "annee":<?= "{$row->annee}" ?>});
								 <?php } ?>
								 
								 mygraphs.push({"idchart":idchart, "titre":titre, "name":name, "months":months});

							 </script> 
					</div></div>
		        <?php }	} ?>

							 <script>
								 mygraphs.forEach(function (mygraph)
								 {
									 updateChart(mygraph, per);
								 });
								 
								 $("body #per").click(function () {
									 per = $(this).attr("value");
									
								 });
							 </script>
			</div>
			<div class="clearfix"></div>
		</div>
		</div>
		</div>
	</div>

@endsection