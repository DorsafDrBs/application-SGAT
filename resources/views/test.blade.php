@extends('layouts.app')

@section('content')
     <!--<td> @if(!empty($project->users()))
        @foreach($project->users() as $key=>$v)
           <label class="badge badge-success">{{ $v->name }}</label>
        @endforeach
      @endif </td>-->
<style>.highcharts-figure, .highcharts-data-table table {
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
</style>à
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?php foreach($data['indics'] as $row) { ?>
<figure class="highcharts-figure">
    <div  id="container<?=$row->id ?>"></div>
    
</figure>
<?php }?>
<script>
 month = <?= "'{$row->mois}'" ?>;
	  year = <?= "'{$row->annee}'" ?>;
	  titre = '<?= "Projet {$project['name']}" ?>'+ month + ' ' + year;;
								 name = '<?= "{$indic['name']}" ?>';
								 idchart = 'containerp<?="{$indic['idg']}"?>';
								 
								 months = [];
								 <?php foreach($indic['months'] as $row) {?>
								 months.push({"h_r_rl":<?="{$row->h_r_rl}"?>, "h_r_est":<?="{$row->h_r_est}"?>, "h_fact":<?= "'{$row->h_fact}'" ?>});
								 <?php } ?>
Highcharts.chart('container', {
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
        categories: ['Africa', 'America', 'Asia'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
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
        data: [107, 131, 635, 203]
    }, {
        name: 'Heures Facturées',
        data: [133, 156, 947, 408]
    }, {
        name: 'Heures Estimée',
        data: [814, 841, 3714, 727]
    }]
});
</script>
@endsection

@extends('manager')


@section('manager')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>process:</strong>
                @foreach ($process as $proc)
                {{ $proc->name}}
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Project:</strong>
                {{ $project->project_name }}
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    @can('project-create')
         <a class="btn btn-primary rounded border bottom" data-toggle="modal" data-target="#myModal"> Create</a>
        @endcan
    <table class="table table-bordered">
       
       <thead>
        <tr>
            <th>No</th>
            <th>Indicators</th>
            <th>Taches</th>
            <th>Programs</th>
            <th>Perimetres</th>
            <th>Targets</th>
        
            <th width="180px">Action</th>
        </tr>
        </thead>
        <tbody> 
	    @foreach ($groups as $association)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $association->name }}</td>
	        <td>{{ $association->tache }}</td>
            <td>{{ $association->program }}</td>
            <td>{{ $association->perimetre }}</td>
            <td>{{ $association->operator_cp }}{{ $association->target }}{{ $association->unit }}</td>
	 <td>
 
                    @can('project-edit')
                    <a data-myid="{{$association->id}}"data-myindic=" {{ $association->name }}" 
                    data-myassoc="{{$association->perimetre}}"
                    data-mytache="{{ $association->tache }}"data-myprogram="{{ $association->program }}"
                 data-mytarget="{{$association->target}}"data-myunit="{{$association->unit}}"
                 data-myoperator="{{$association->operator_cp}}"  data-myorange="{{$association->orange}}"
                 
                 
                  data-toggle="modal" data-target="#edit" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                    @endcan
          
                   
      </td>
	 </tr>
	    @endforeach
        </tbody>
    </table>
    </div>
    <div class="clearfix">

 <!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Add New Indicator to {{ $project->project_name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{route('projects.store_indic')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
          @include('projects.form')
                   
	  
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit  indicator of {{ $project->project_name }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <form action="{{route('projects.update_indic','test')}}" method="post">
      		{{method_field('patch')}}
      		{{csrf_field()}}
	      <div class="modal-body">
	      	<input type="hidden" name="association_id" id="association_id" value="">
                  @include('projects.form')
	     
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<script>
$('#edit').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
    var association_id=button.data('myid')
    var assoc_t_id=button.data('myassoc')
    var indic_id=button.data('myindic')
    var target=button.data('mytarget')
    var unit_id=button.data('myunit')
    var operator_cp=button.data('myoperator')
    var orange=button.data('myorange')
    var program=button.data('myprogram')
    var tache=button.data('mytache')

    var modal=$(this)
    modal.find('.modal-body #association_id').val(association_id);
    modal.find('.modal-body #assoc_t_id').val(assoc_t_id);
    modal.find('.modal-body #indic_id').val(indic_id);
    modal.find('.modal-body #target').val(target);
    modal.find('.modal-body #unit_id').val(unit_id);
    modal.find('.modal-body #operator_cp').val(operator_cp);
    modal.find('.modal-body #orange').val(orange);
    modal.find('.modal-body #program').val(program);
    modal.find('.modal-body #tache').val(tache);
}) 
/*$('#delete').on('show.bs.modal',function(event){
    var button=$(event.relatedTarget)
   
    var associationd_id=button.data('associationid')
    var modal=$(this)
    modal.find('.modal-body #associationd_id').val(associationd_id);
 
})
*/
</script>
@endsection