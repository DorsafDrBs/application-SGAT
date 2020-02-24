<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\indicatorsproj;
use DB;
use PHPExcel_IOFactory;
use Carbon\Carbon;
  // Include PHPExcel_IOFactory (EXCEL)
include public_path().'/PHPExcel/PHPExcel/IOFactory.php';
class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inserted data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
 //take the file path
		$inputFileName = 'C:\xampp\htdocs\laravel\application-SGAT\public\inputExcel\Input_DATA_File_VFinal.xlsx ';

		// Read your Excel workbook
		try 
		{
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		 } 
		catch(Exception $e)
		 {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		 }

         try {
         // Get worksheet dimensions 
		$sheet = $objPHPExcel->getSheet(0);  //getSheetByName()
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
     
    }
    catch (Exception $e) {
        echo 'Sheet is not exists!';
    }
        // Read all rows of data into an array  
// get the column headings as a simple array indexed by column name
$rows = $sheet->rangeToArray('B5:' .$highestColumn.$highestRow, NULL, TRUE, TRUE);
     // Loop through each row of the worksheet in turnz
      // ** Show row data array 
      $ligne=1; 
       foreach($rows as $row)
        {	
            $proj=DB::table('projects')->where('project_name',$row[5])->first();
            $otd=DB::table('indicatorsprojs')->where('name','OTD')->first();
		      	$rft=DB::table('indicatorsprojs')->where('name','RFT')->first();
		      	$efficacite=DB::table('indicatorsprojs')->where('name','Efficacité')->first();
                  $efficience_estime=DB::table('indicatorsprojs')->where('name','Efficience Estimée')->first();
                  $efficience_facture=DB::table('indicatorsprojs')->where('name','Efficience Facturée')->first();
                  $seuil_rentabilite=DB::table('indicatorsprojs')->where('name','Seuil de rentabilité')->first();
                  $production=DB::table('indicatorsprojs')->where('name','PRODUCTION')->first();
          //liste of tache's project
            $taches=DB::table('projet_tache')
            ->select('projet_tache.tache_id','projet_tache.id')
           
                     ->join('projects','projects.id','projet_tache.project_id')
                     ->where('projects.project_name',$row[5])
                     ->first();
                    
  // test if project on the rows selected has tache
 if(empty($taches))
{ //project don't has tache
  $test_rft=DB::table('indicatorsproj_value')
  ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
  ->join('projects','projects.id','indicatorsproj_value.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
  ->where('indicatorsprojs.name',$rft->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$row[2])
  ->count();
  
  if($test_rft>0)
       {echo "rft data existed \n";}
  else { 
         if($row[7] != "/" && $row[7]>0)
             {   $val_rft=(((int)$row[7]-(int)$row[14])/(int)$row[7])*100;
                DB::table('indicatorsproj_value')
                ->insert(['target' => '95',
                           'value' => $val_rft, 
                           
                       'indicatorsproj_id'=>$rft->id,
                       'annee'=>$row[0],
                       'semaine'=>$row[1],
                       'mois'=>$row[2],
                       'projects_id' =>$proj->id,
                       'trimestre'=>$row[3],
                       'created_at'=> Carbon::now(),
                      ]);
                     echo "rft data inserted successfully \n";
             }
         else if($row[8] != "/" && $row[8]>0)
             {  $val_rft=(((int)$row[8]-(int)$row[14])/(int)$row[8])*100; 
                DB::table('indicatorsproj_value')
                ->insert(['target' => '95',
                           'value' => $val_rft, 
                           
                       'indicatorsproj_id'=>$rft->id,
                       'annee'=>$row[0],
                       'semaine'=>$row[1],
                       'mois'=>$row[2],
                       'projects_id' =>$proj->id,
                       'trimestre'=>$row[3],
                       'created_at'=> Carbon::now(),
                      ]);
                      echo "rft data inserted successfully \n";
             }
         else if($row[6] > 0)
             {  $val_rft=(((int)$row[6]-(int)$row[14])/(int)$row[6])*100; 
                DB::table('indicatorsproj_value')
                ->insert(['target' => '95',
                           'value' => $val_rft, 
                       'indicatorsproj_id'=>$rft->id,
                       'annee'=>$row[0],
                       'semaine'=>$row[1],
                       'mois'=>$row[2],
                       'projects_id' =>$proj->id,
                       'trimestre'=>$row[3],
                       'created_at'=> Carbon::now(),
                      ]);
                      echo "rft data inserted successfully \n"; }

            
        }
           $test_otd=DB::table('indicatorsproj_value')
                  ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
                  ->join('projects','projects.id','indicatorsproj_value.projects_id')
                  ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
                  ->where('indicatorsprojs.name',$otd->name)
                  ->where('projects.project_name',$row[5])
                  ->where('indicatorsproj_value.annee',$row[0])
                  ->where('indicatorsproj_value.semaine',$row[1])
                  ->where('indicatorsproj_value.mois',$row[2])
                  ->count();
         if($test_otd>0)
              {echo "otd data existed \n";}
         else {
            
            $val_otd=(((int)$row[6]-(int)$row[20])/(int)$row[6])*100;
          
              DB::table('indicatorsproj_value')->insert([
                'projects_id' =>$proj->id,
                'value' => $val_otd, 
              'target' => '95',
              'indicatorsproj_id'=>$otd->id,
              'annee'=>$row[0],
              'semaine'=>$row[1],
              'mois'=>$row[2],
              'trimestre'=>$row[3],

              'created_at'=> Carbon::now(),
               ]);
               echo "otd data inserted successfully \n";
          
         }		
        }
 else { //project  has tache

   switch($taches):
                 case 'T100':
                    $tache=DB::table('taches')
                    ->select('tache','id')
                    ->where('tache','T100')
                    ->get();
            $val_rft=(((int)$row[9]-(int)$row[15])/(int)$row[9])*100; 
            $val_otd=(((int)$row[9]-(int)$row[21])/(int)$row[9])*100;
            DB::table('indicatorsproj_value')
             	 ->insert(['projects_id' =>$proj->id,
		                     'value' => $val_rft, 
		                     'target' => '95',
                             'indicatorsproj_id'=>$rft->id,
                             'tache_id'=>$tache->id,
                             'annee'=>$row[0],
                             'semaine'=>$row[1],
                             'mois'=>$row[2],
                             'trimestre'=>$row[3],
		                     'created_at'=> Carbon::now(),
                        ])
                        ->insert([ 'projects_id' =>$proj->id,
                            'value' => $val_otd, 
                            'target' => '95',
                            'indicatorsproj_id'=>$otd->id,
                            'tache_id'=>$tache->id,
                            'annee'=>$row[0],
                            'semaine'=>$row[1],
                            'mois'=>$row[2],
                            'trimestre'=>$row[3],
                            'created_at'=> Carbon::now(),
                             ]);
                             echo " rft and otd data T100 inserted successfully \n";
                     break;
                 case 'T200':
                    $tache=DB::table('taches')
                    ->select('tache','id')
                    ->where('tache','T200')
                    ->get();
                     $val_rft=(((int)$row[10]-(int)$row[16])/(int)$row[10])*100; 
                     $val_otd=(((int)$row[10]-(int)$row[22])/(int)$row[10])*100;
                     DB::table('indicatorsproj_value')
                     ->insert(['projects_id' =>$proj->id,
                                'value' => $val_rft, 
                                'target' => '95',
                                'indicatorsproj_id'=>$rft->id,
                                'tache_id'=>$tache->id,
                                'annee'=>$row[0],
                                'semaine'=>$row[1],
                                'mois'=>$row[2],
                                'trimestre'=>$row[3],
                                'created_at'=> Carbon::now(),
                           ])
                           ->insert([ 'projects_id' =>$proj->id,
                               'value' => $val_otd, 
                               'target' => '95',
                               'indicatorsproj_id'=>$otd->id,
                               'tache_id'=>$tache->id,
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                                ]);
                                echo "rft and otd data T200 inserted successfully \n";
                     break;
                 case 'T300':
                      $tache=DB::table('taches')
                    ->select('tache','id')
                    ->where('tache','T300')
                    ->get();
                    $val_rft=(((int)$row[11]-(int)$row[17])/(int)$row[11])*100; 
                     $val_otd=(((int)$row[11]-(int)$row[23])/(int)$row[11])*100;
                     DB::table('indicatorsproj_value')
                     ->insert(['projects_id' =>$proj->id,
                                'value' => $val_rft, 
                                'target' => '95',
                                'indicatorsproj_id'=>$rft->id,
                                'tache_id'=>$tache->id,
                                'annee'=>$row[0],
                                'semaine'=>$row[1],
                                'mois'=>$row[2],
                                'trimestre'=>$row[3],
                                'created_at'=> Carbon::now(),
                           ])
                           ->insert([ 'projects_id' =>$proj->id,
                               'value' => $val_otd, 
                               'target' => '95',
                               'indicatorsproj_id'=>$otd->id,
                               'tache_id'=>$tache->id,
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                                ]);
                  echo "rft and otd data T300 inserted successfully \n";
                     break;
                 case'DQ1':
                    $tache=DB::table('taches')
                    ->select('tache','id')
                    ->where('tache','DQ1')
                    ->get();
                    $val_rft=(((int)$row[12]-(int)$row[18])/(int)$row[12])*100; 
                     $val_otd=(((int)$row[12]-(int)$row[24])/(int)$row[12])*100;
                     DB::table('indicatorsproj_value')
                     ->insert(['projects_id' =>$proj->id,
                                'value' => $val_rft, 
                                'target' => '95',
                                'indicatorsproj_id'=>$rft->id,
                                'tache_id'=>$tache->id,
                                'annee'=>$row[0],
                                'semaine'=>$row[1],
                                'mois'=>$row[2],
                                'trimestre'=>$row[3],
                                'created_at'=> Carbon::now(),
                           ])
                           ->insert([ 'projects_id' =>$proj->id,
                               'value' => $val_otd, 
                               'target' => '95',
                               'indicatorsproj_id'=>$otd->id,
                               'tache_id'=>$tache->id,
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                                ]);
                                echo "rft and otd data DQ1 inserted successfully \n"; 
                      break;
                      case'E2E':
                        $tache=DB::table('taches')
                        ->select('tache','id')
                        ->where('tache','E2E')
                        ->get();
                        $val_rft=(((int)$row[13]-(int)$row[19])/(int)$row[13])*100; 
                        $val_otd=(((int)$row[13]-(int)$row[25])/(int)$row[13])*100;
                         DB::table('indicatorsproj_value')
                         ->insert(['projects_id' =>$proj->id,
                                    'value' => $val_rft, 
                                    'target' => '95',
                                    'indicatorsproj_id'=>$rft->id,
                                    'tache_id'=>$tache->id,
                                    'annee'=>$row[0],
                                    'semaine'=>$row[1],
                                    'mois'=>$row[2],
                                    'trimestre'=>$row[3],
                                    'created_at'=> Carbon::now(),
                               ])
                               ->insert([ 'projects_id' =>$proj->id,
                                   'value' => $val_otd, 
                                   'target' => '95',
                                   'indicatorsproj_id'=>$otd->id,
                                   'tache_id'=>$tache->id,
                                   'annee'=>$row[0],
                                   'semaine'=>$row[1],
                                   'mois'=>$row[2],
                                   'trimestre'=>$row[3],
                                   'created_at'=> Carbon::now(),
                                    ]);
                      echo"rft and otd data E2E inserted successfully \n"; 
                          break;
                 default:
                     
                    endswitch;  
      }
  //******************************************************************* */  		
  if (($row[26] > 0) && ($row[27]>0) && ($row[29]>0))
    { $test_hours=DB::table('hours')
        ->join('projects','projects.id','hours.project_id')
        ->where('projects.project_name',$row[5])
        ->where('hours.annee',$row[0])
        ->where('hours.semaine',$row[1])
        ->where('hours.mois',$row[2])
        ->count();
 if($test_hours>0)
        {echo "hours data existed \n ";}
   else { 
        // insert hours
           DB::table('hours')->insert([
            'project_id' =>$proj->id,
            'h_r_rl' => $row[26], 
            'h_r_est' => $row[27],
            'h_fact'=>$row[26],
            'annee'=>$row[0],
            'semaine'=>$row[1],
            'mois'=>$row[2],
            'trimestre'=>$row[3],
            'created_at'=> Carbon::now(),
             ]);
             echo"hours data inserted successfully \n";
           }
           $test_seuil_rentabilite=DB::table('indicatorsproj_value')
           ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
           ->join('projects','projects.id','indicatorsproj_value.projects_id')
           ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
           ->where('indicatorsprojs.name',$seuil_rentabilite->name)
           ->where('projects.project_name',$row[5])
           ->where('indicatorsproj_value.annee',$row[0])
           ->where('indicatorsproj_value.semaine',$row[1])
           ->where('indicatorsproj_value.mois',$row[2])
           ->count();
 if($test_seuil_rentabilite>0)
          {  echo "Seuil de rentabilité data existed \n";  }
else{
     $val_seuil_rentabilite=(((int)$row[29])*42.5)*4;
      DB::table('indicatorsproj_value')
      ->insert([ 'projects_id' =>$proj->id,
       'value' => $val_seuil_rentabilite, 
       'target' => '97',
       'indicatorsproj_id'=>$seuil_rentabilite->id,
       'annee'=>$row[0],
       'semaine'=>$row[1],
       'mois'=>$row[2],
       'trimestre'=>$row[3],
       'created_at'=> Carbon::now(),
        ]);
        echo"Seuil de rentabilité data inserted successfully \n";
       } 
          $test_efficacite=DB::table('indicatorsproj_value')
             ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
             ->join('projects','projects.id','indicatorsproj_value.projects_id')
             ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
             ->where('indicatorsprojs.name',$efficacite->name)
             ->where('projects.project_name',$row[5])
             ->where('indicatorsproj_value.annee',$row[0])
             ->where('indicatorsproj_value.semaine',$row[1])
             ->where('indicatorsproj_value.mois',$row[2])
             ->count();
   if($test_efficacite>0)
            {  echo "efficacite data existed \n";  }
  else{
	   $val_efficacite=(((int)$row[27])/((int)$row[26]));
		DB::table('indicatorsproj_value')
		->insert([ 'projects_id' =>$proj->id,
	     'value' => $val_efficacite, 
	     'target' => '97',
         'indicatorsproj_id'=>$efficacite->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
	     'created_at'=> Carbon::now(),
          ]);
          echo"efficacite data inserted successfully \n";
         } 
  $test_efficience_estime=DB::table('indicatorsproj_value')
  ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
  ->join('projects','projects.id','indicatorsproj_value.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
  ->where('indicatorsprojs.name',$efficience_estime->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$row[2])
  ->count();
  if($test_efficience_estime>0)
         {echo "efficience estimée  data existed \n";}
  else{
     $val_efficience_estime=(((int)$row[27])/ $val_seuil_rentabilite);
	     DB::table('indicatorsproj_value')
	      ->insert(['projects_id' =>$proj->id,
		  'value' => $val_efficience_estime, 
		  'target' => '97',
          'indicatorsproj_id'=>$efficience_estime->id,
          'annee'=>$row[0],
          'semaine'=>$row[1],
          'mois'=>$row[2],
          'trimestre'=>$row[3],
		  'created_at'=> Carbon::now(),
           ]);
           echo" efficience estimée data inserted successfully \n";
    }
    $test_efficience_facture=DB::table('indicatorsproj_value')
  ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
  ->join('projects','projects.id','indicatorsproj_value.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
  ->where('indicatorsprojs.name',$efficience_facture->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$row[2])
  ->count();
  if($test_efficience_facture>0)
         {echo "efficience facturée data existed \n ";}
  else{
     $val_efficience_facture=(((int)$row[26])/ $val_seuil_rentabilite);
	     DB::table('indicatorsproj_value')
	      ->insert(['projects_id' =>$proj->id,
		  'value' => $val_efficience_facture, 
		  'target' => '97',
          'indicatorsproj_id'=>$efficience_facture->id,
          'annee'=>$row[0],
          'semaine'=>$row[1],
          'mois'=>$row[2],
          'trimestre'=>$row[3],
		  'created_at'=> Carbon::now(),
           ]);
           echo" efficience facturée data inserted successfully \n";
    }
    
    }
    else
    { if ($row[26]=='' OR $row[26]=="/" )
       { echo " your file missed data in cell "+$row[26] ;  }
       else if ($row[27]=='' OR $row[27]=="/")
       { echo " your file missed data in cell "+$row[27] ;  }
       else if ($row[29]=='' OR $row[29]=="/")
       { echo "your file missed data in callules :"+$row[26]+","+$row[27]+"and"+$row[27];}
     
       
    }
     if ($row[28]>0 && $row[28]!="/")
    { $test_production=DB::table('indicatorsproj_value')
     ->select('indicatorsproj_value.projects_id','indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois')
     ->join('projects','projects.id','indicatorsproj_value.projects_id')
     ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
     ->where('indicatorsprojs.name',$production->name)
     ->where('projects.project_name',$row[5])
     ->where('indicatorsproj_value.annee',$row[0])
     ->where('indicatorsproj_value.semaine',$row[1])
     ->where('indicatorsproj_value.mois',$row[2])
     ->count();
     if($test_production>0)
            {echo " PRODUCTION data existed \n ";}
     else{
       
          DB::table('indicatorsproj_value')
           ->insert(['projects_id' =>$proj->id,
         'value' => $row[28], 
         'target' => '97',
             'indicatorsproj_id'=>$production->id,
             'annee'=>$row[0],
             'semaine'=>$row[1],
             'mois'=>$row[2],
             'trimestre'=>$row[3],
         'created_at'=> Carbon::now(),
              ]);
              echo" PRODUCTION data inserted successfully \n";
       } }
} 
}

} 