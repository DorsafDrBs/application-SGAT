@extends('layouts.app')

@section('content')
 
<style>
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
<script>
	let monthName = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
	let X;
	let Hreel;
	let Hestime;
    let Hfacture;
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
		Hreel = [];
		Hestime = [];
        Hfacture = [];
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
			let h_r_rl=row["h_r_rl"];
			let h_r_est=row["h_r_est"];
            let h_r_fact=row["h_r_fact"];
			let nbper=row[per];
			
			if (nbper in sumvals) {
				sumvals[nbper]["h_r_rl"] += h_r_rl;
				sumvals[nbper]["h_r_est"] += h_r_est;
                sumvals[nbper]["h_r_fact"] += h_r_fact;
				sumvals[nbper]["cnt"] += 1;
			}
			else {
				sumvals[nbper] = {h_r_rl: h_r_rl,h_r_est: h_r_est, h_r_fact: h_r_fact, cnt: 1};
			}
		});
		
		Object.entries(sumvals).forEach (([nbper, row]) => {
			let lb = prefix + nbper;
			if(per=="mois") {
				lb = monthName[new Date(nbper).getMonth()];
			}
			
			X.push(lb);
			Hreel.push(Math.ceil((row["h_r_rl"]/row["cnt"]) * 100) / 100);
			Hestime.push(Math.ceil((row["h_r_est"]/row["cnt"]) * 100) / 100);
            Hfacture.push(Math.ceil((row["h_r_fact"]/row["cnt"]) * 100) / 100);
		});
		
		var chart=Highcharts.chart(mygraph['idchart'], {
    chart: {
        type: 'bar'
    },
    title: {
        text: titre
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories:X,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (hours)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' hours'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Heures realisées',
        data: Hreel // 
    }, {
        name: 'Heures Estimée ',
        data: Hestime
    }, {
        name: 'Heures Facturées',
        data: Hfacture
    }]
});
    }
    </script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>

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
  <?php foreach($datah as $project) { ?>
     <?php foreach($project['weeks'] as $week) { ?>
		<div class="col-lg-12" >
	        <div class="col-lg-12" height="500px"id="containerp<?=$week['idh'] ?>" style="min-width: 300px; height: 300px; margin: 0 auto"> </div>
         <script>
            
	         year = <?= "'{$week['annee']}'" ?>;
	         titre = '<?= "Projet {$project['name']}" ?> '+ year;
		     idchart = 'containerp<?="{$week['idh']}"?>';
			    months = [];
		   <?php foreach($week['months'] as $row) {?>
             months.push({"h_r_rl":<?="{$row->h_r_rl}"?>, "h_r_est":<?="{$row->h_r_est}"?>, "h_fact":<?= "'{$row->h_fact}'" ?>,
                         "project_name":<?="'{$row->project_name}'"?>,"tache":<?="'{$row->tache}'"?>,"program":<?="'{$row->program}'"?>,
						 "perimetre":<?="'{$row->perimetre}'"?>,  "semaine":<?= "'{$row->semaine}'" ?>, "mois":<?="{$row->mois}"?>, 
                         "annee":<?= "'{$row->annee}'" ?>, "trimestre":<?="{$row->trimestre}"?>});
		   <?php } ?>
				 mygraphs.push({"idchart":idchart, "titre":titre, "name":name, "months":months});
         </script> 
			</div>
         </div>
    <?php }	} ?>
                <script>
					  mygraphs.forEach(function (mygraph)
						  {	 updateChart(mygraph, per);  });
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

