@extends('layouts.app')

@section('content')


<style>
    
/* New Styles */

</style>

  <!-- Main content -->
<div class="container">

        <h3 class="text-center text-dark"> Process cartographie  of SOGECLAIR aerospace</h3>

	  <div class="row ">
		<div class="col-sm-2 rounded bg-secondary  border border-white shadow  ">
		<p class="rotate  text-white text-center">	INTERESTED PARTIES; CUSTOMERS & COMPANY CONTEXT</p>
		</div>
		<div class="col ">
	    <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
	<h3>	MANAGEMENT PROCESS</h3>
				<div class="row">							
				<?php foreach($datam as $mg) { ?>
					<div class="col rounded mb-2 mr-sm-2 shadow text-white border border-white text-center" style="background-color:#00bbfe;">
					<?= $mg['name'] ?> 
				  <div class="col">
				  <?= $mg['detail'] ?>
							</div>
						<i class="fa fa-arrow-circle-right " data-target="#management<?=$mg['idm'] ?>"  data-toggle="modal"  style="background-color:#00bbfe;"></i>
					</div>
				<div class="modal fade" id="management<?="{$mg['idm']}"?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">  Process <span id="modal-myvar"></span>: </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<?php foreach($mg['indicators'] as $indicator) { ?>
                                            <div class="modal-body">
                                            <p id="management-data" name="name" id="name"  ><?="'{$indicator->name}'"?></p>
                                            </div> 
											<?php }?>
                                        </div>
                                    </div>
                                </div>
				<?php }?>
               </div>
			 </div>
            <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
			<h3>REALIZATION PROCESS	</h3>
				<div class="row">
				<?php foreach($datar as $index=> $rs) { 
				if ($index==0){?>
					<div class="col-md-4 rounded border border-white  mb-2 mr-sm-2 text-white shadow border border-white text-center"  style="background-color:#00bbfe;">
					<?= $rs['name'] ?> 
					<div class="col">
								<ul>
									<li><?= $rs['detail'] ?></li>
							
								</ul><i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#lrealisation<?=$rs['idr'] ?>"  style="background-color:#00bbfe;"></i>
							</div> 
					
                    </div>  <div class="modal fade" id="lrealisation<?="{$rs['idr']}"?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">  Process <span id="modal-myvar"></span>: </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<?php foreach($rs['indicators'] as $indicator) { ?>
                                            <div class="modal-body">
                                            <p id="management-data" name="name" id="name"  ><?="'{$indicator->name}'"?></p>
                                            </div> 
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                            
		
				<?php }}?>
					 <div class="col">
						<?php foreach($datar as $index=>$rs) { 
						if ($index!=0){	 ?>
						<div class="col-md-12 rounded border border-white  mb-2 mr-sm-2 text-white shadow border border-white text-center"  style="background-color:#00bbfe;">
							<div class="col-md-5">
							<?= $rs['name'] ?> 
							</div>
							<div class="col">
								<ul>
									<li><?= $rs['detail'] ?></li>
							
								</ul>
								<i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#realisation<?=$rs['idr'] ?>"  style="background-color:#00bbfe;"></i>
						</div>
							</div> 
							
							<div class="modal fade" id="realisation<?="{$rs['idr']}"?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">  Process <span id="modal-myvar"></span>: </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<?php foreach($rs['indicators'] as $indicator) { ?>
                                            <div class="modal-body">
                                            <p id="management-data" name="name" id="name"  ><?="'{$indicator->name}'"?></p>
                                            </div> 
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                            
		
				<?php }}?>
					
						</div>
					</div>
			
			</div>
            <div class="col mb-2 mr-sm-2 bg-light border border-muted rounded text-center">
			<h3>SUPPORT PROCESS	</h3>
				<div class="row">
				<?php foreach($datas as $sp) { ?>
				<div class="col rounded border border-white  mb-2 mr-sm-2 text-white shadow" style="background-color:#00bbfe;">
				  <?= $sp['name'] ?> 
					    <div class="col">
								<ul>	<li><?= $sp['detail'] ?> </li>	</ul>
								<i class="fa fa-arrow-circle-right " data-toggle="modal" data-target="#support<?=$sp['ids'] ?>"  style="background-color:#00bbfe;"></i>
						</div>
				</div>
		
							<div class="modal fade" id="support<?="{$sp['ids']}"?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
											<h4 class="modal-title" id="myModalLabel">  Process <span id="modal-myvar"></span>: </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<?php foreach($sp['indicators'] as $indicator) { ?>
                                            <div class="modal-body">
                                            <p id="management-data" name="name" id="name"  ><?="'{$indicator->name}'"?></p>
                                            </div> 
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                            
		
				<?php }?>
			 </div>
		 </div>
		</div>
		<div class="col-2 rounded bg-secondary text-center text-white shadow text-rotate">
	INTERESTED PARTIES & CUSTOMERS SATISFACTION
		</div>
	</div>
	

</div>



@endsection