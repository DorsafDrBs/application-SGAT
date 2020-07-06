<?php foreach($datah as $project) { ?>
<?php foreach($project['weeks'] as $week) { ?>
<figure class="highcharts-figure">

    <div  id="container<?=$row->id ?>"></div>

<script>
                                    X = [];
									Yval = [];
									Ytar = [];
                                    <?php foreach($week['hours'] as $row) {?>
                                    	X.push(monthName[new Date(<?= "'{$row->month}'" ?>).getMonth()]);
										Yval.push(<?="{$row->value}"?>);
										Ytar.push(<?="{$row->target}"?>);
           week=<?= "'{$week['semaine']}'" ?>;
            month = <?= "'{$week['mois']}'" ?>;
	       year = <?= "'{$week['annee']}'" ?>;
	       titre = '<?= "Projet {$project['name']}" ?> Semaine '+week+' '+ month + ' ' + year;
								 name = '<?= "{$project['name']}" ?>';
								 idchart = 'containerp<?="{$week['idh']}"?>';
								 
								 months = [];
                                 X = [];
								
								 months.push({"h_r_rl":<?="{$row->h_r_rl}"?>, "h_r_est":<?="{$row->h_r_est}"?>, "h_fact":<?= "'{$row->h_fact}'" ?>, "semaine":<?= "'{$row->semaine}'" ?>, "mois":<?="{$row->mois}"?>, "annee":<?= "'{$row->annee}'" ?>, "trimestre":<?="{$row->trimestre}"?>});
								
                                 
							 </script> 
                              <?php } ?>
					</figure>
		        <?php }	} ?>