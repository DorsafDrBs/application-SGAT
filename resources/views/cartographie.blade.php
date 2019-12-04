@extends('layouts.app')

@section('content')


<style>
    
/* New Styles */

</style>

  <!-- Main content -->
<div class="container">

        <h3 class="text-center text-dark"> Cartographie des processus simplifiée de SOGECLAIR aerospace</h3>

	  <div class="row ">
		<div class="col-sm-2 rounded bg-secondary  border border-white shadow  ">
		<p class="rotate  text-white text-center">	INTERESTED PARTIES; CUSTOMERS & COMPANY CONTEXT</p>
		</div>
		<div class="col ">
	    <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
	<h3>	MANAGEMENT PROCESS</h3>
				<div class="row">							
				@foreach($managements as $management)
					<div class="col rounded mb-2 mr-sm-2 shadow text-white border border-white text-center" style="background-color:#00bbfe;">
                  {{$management->name}}
				  <div class="col">
						  {{$management->detail}}
							</div>
							 <a class="infoU" name="fprocs">
							<i class="fa fa-arrow-circle-right "  value="{{$management->id}}"  data-toggle="modal" data-target="#myCourse" data-id="{{$management->id}}" style="background-color:#00bbfe;"></i>
					</a>
					</div>
					
				@endforeach 
				<script>
				$(document).ready(function () {

$(".infoU").click(function (e) {
	
	$currID = $(this).attr("data-id");
	$.post("cartographie.blade.php", {id: $currID}, function (data) {
		$('#management-data').html(data);
		}
	);
});
});</script>
				<div class="modal fade" id="myCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">  Processus <span id="modal-myvar"></span>: </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="management-data">{{$management->id}}
                    </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                              </div>

		
			</div>
            <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
			<h3>REALIZATION PROCESS	</h3>
				<div class="row">
					@foreach($realisations as $index=> $realisation)
					@if ($index==0)
					<div class="col-md-4 rounded border border-white  mb-2 mr-sm-2 text-white shadow border border-white text-center"  style="background-color:#00bbfe;">
					{{$realisation->name}}
					<div class="col">
								<ul>
									<li>{{$realisation->detail}}</li>
							
								</ul><i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#myCourse"  style="background-color:#00bbfe;"></i>
							</div> 
					
                    </div>  @endif
						@endforeach <div class="col">
					@foreach($realisations as $index=> $realisation)
					@if ($index!=0)	
						<div class="col-md-12 rounded border border-white  mb-2 mr-sm-2 text-white shadow border border-white text-center"  style="background-color:#00bbfe;">
							<div class="col-md-5">
							{{$realisation->name}}
							</div>
							<div class="col">
								<ul>
									<li>{{$realisation->detail}}</li>
							
								</ul>
								<i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#myCourse"  style="background-color:#00bbfe;"></i>
						</div>
							</div> 
							
					
						@endif
						@endforeach 
						</div>
					</div>
			
			</div>
            <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
			<h3>SUPPORT PROCESS	</h3>
				<div class="row">
				@foreach($supports as $support)
					<div class="col rounded border border-white  mb-2 mr-sm-2 text-white shadow" style="background-color:#00bbfe;">
                    {{$support->name}}
					
					<div class="col">
								<ul>
									<li>{{$support->detail}}</li>
							
								</ul>
								<i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#myCourse"  style="background-color:#00bbfe;"></i>
						</div>
							</div> 
				
					@endforeach 
				</div>
			</div>
		</div>
		<div class="col-2 rounded bg-secondary text-center text-white shadow text-rotate">
	INTERESTED PARTIES & CUSTOMERS SATISFACTION
		</div>
	</div>
	

</div>



@endsection