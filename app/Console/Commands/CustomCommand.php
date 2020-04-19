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
		$inputFileName = 'C:\xampp\htdocs\laravel\application-SGAT\public\inputExcel\Input_DATA_File_VFinalMAJ.xlsx ';

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
$rows = $sheet->rangeToArray('B8:' .$highestColumn.$highestRow, NULL, TRUE, TRUE);
     // Loop through each row of the worksheet in turnz
      // ** Show row data array 
      $ligne=1; 
       foreach($rows as $row)
        {	  $mois=DB::table('mois')->where('mois',$row[2])->first();
             $trimestre=DB::table('trimestre')->where('trimestre',$row[3])->first();
           
            $proj=DB::table('projects')->where('project_name',$row[5])->first();
            $otd=DB::table('indicatorsprojs')->where('name','OTD')->first();
		      	$rft=DB::table('indicatorsprojs')->where('name','RFT')->first();
		      	$efficacite=DB::table('indicatorsprojs')->where('name','Efficacité')->first();
            $efficience_estime=DB::table('indicatorsprojs')->where('name','Efficience Estimée')->first();
            $efficience_facture=DB::table('indicatorsprojs')->where('name','Efficience Facturée')->first();
            $seuil_rentabilite=DB::table('indicatorsprojs')->where('name','Seuil de rentabilité')->first();
            $production=DB::table('indicatorsprojs')->where('name','PRODUCTION')->first();
            $tta=DB::table('indicatorsprojs')->where('name','TTA')->first();
            $rto=DB::table('indicatorsprojs')->where('name','RTO')->first();
          //liste of tache's project
            $data_taches=DB::table('project_has_taches')
             ->select('taches.tache','perimetres.perimetre','programs.program')
      
             ->join('projects','projects.id','project_has_taches.projects_id')
             ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
             ->join('programs','programs.id','perimetres.programs_id')
             ->join('taches','taches.id','programs.taches_id')
             ->where('projects.project_name',$row[5])
             ->get();
           
    foreach($data_taches as $taches){
  // test if project on the rows selected has tache
 if($taches->tache == 'No Taches')
{ //project has "No taches" (taches->id =0)
  // Select data of RFT and test if existed in DB
  print_r($row[5]); 
  print_r($taches->tache); 
  print_r($row[1]); 
  $test_rft=DB::table('indicatorsproj_value')
  ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
  ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
  ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
  ->join('projects','projects.id','project_has_taches.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
  ->where('indicatorsprojs.name',$rft->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$mois->id)
  ->count();
  if($test_rft>0)
       {
     echo "  rft data existed \n";}
  else {  
     $data_rft=DB::table('associat_indics')
    ->select('associat_indics.id','associat_indics.target')
    ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
    ->join('projects','projects.id','project_has_taches.projects_id')
    ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
    ->where('indicatorsprojs.name',$rft->name)
    ->where('projects.project_name',$row[5])
    ->first();
     //test if there is data in col "Nombre des livrables consommés au production" to calculate RFT value
         if($row[7] != "/" && $row[7]>0 && $row[8]=="/")     
             {   
                    $val_rft=number_format(((((int)$row[7]-(int)$row[14])/(int)$row[7])*100), 2 );
                DB::table('indicatorsproj_value')
                ->insert([ 'associat_indic_id' =>$data_rft->id,
                           'target' => $data_rft->target,
                           'value' => $val_rft,  
                           'annee'=>$row[0],
                           'semaine'=>$row[1],
                           'mois'=>$mois->id,
                           'trimestre'=>$trimestre->id,
                            'created_at'=> Carbon::now(),
                         ]);
                     echo "rft data inserted successfully \n";
             }
             //test if there is data in col "Nbre des livrables relachées" to calculate RFT value
         else if($row[8] != "/" && $row[8]>0 && $row[7]=="/")
             {  $val_rft=number_format(((((int)$row[8]-(int)$row[14])/(int)$row[8])*100), 2 );
                DB::table('indicatorsproj_value')
                ->insert(['associat_indic_id' =>$data_rft->id,
                          'target' => $data_rft->target,
                          'value' => $val_rft, 
                          'annee'=>$row[0],
                          'semaine'=>$row[1],
                          'mois'=>$mois->id,
                          'trimestre'=>$trimestre->id,
                          'created_at'=> Carbon::now(),
                         ]);
                      echo "rft data inserted successfully \n";
             } // calculate RFT value with col "Nbre des Livrable"
         else if($row[6] > 0 && $row[7]=="/" && $row[8]=="/")
             {  $val_rft=number_format(((((int)$row[6]-(int)$row[14])/(int)$row[6])*100), 2 );
                DB::table('indicatorsproj_value')
                ->insert(['associat_indic_id' =>$data_rft->id,
                       'target' => $data_rft->target,
                       'value' => $val_rft, 
                       'annee'=>$row[0],
                       'semaine'=>$row[1],
                       'mois'=>$mois->id, 
                       'trimestre'=>$trimestre->id,
                       'created_at'=> Carbon::now(),
                      ]);

                      echo "rft data inserted successfully \n"; 
                    }
        } 
        // Select data of OTD and test if existed in DB
           $test_otd=DB::table('indicatorsproj_value')
                  ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
                  ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
                  ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
                  ->join('projects','projects.id','project_has_taches.projects_id')
                  ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                  ->where('indicatorsprojs.name',$otd->name)
                  ->where('projects.project_name',$row[5])
                  ->where('indicatorsproj_value.annee',$row[0])
                  ->where('indicatorsproj_value.semaine',$row[1])
                  ->where('indicatorsproj_value.mois',$mois->id)
                  ->count();
         if($test_otd>0)
              {      echo "otd data existed \n";}
         else {
          $data_otd=DB::table('associat_indics')
          ->select('associat_indics.id','associat_indics.target')
          ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
          ->join('projects','projects.id','project_has_taches.projects_id')
          ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
          ->where('indicatorsprojs.name',$otd->name)
          ->where('projects.project_name',$row[5])
          ->first(); 
            $val_otd=number_format(((((int)$row[6]-(int)$row[20])/(int)$row[6])*100), 2 );
          
           DB::table('indicatorsproj_value')->insert([
                      'associat_indic_id' =>$data_otd->id,
                       'target' => $data_otd->target,
                       'value' => $val_otd, 
                       'annee'=>$row[0],
                       'semaine'=>$row[1],
                       'mois'=>$mois->id,
                       'trimestre'=>$trimestre->id,
                       'created_at'=> Carbon::now(),
                      ]);
                      print_r($row[1]); 
               echo" otd data inserted successfully \n";
          
         }		
        }
 else if(($taches->perimetre == 'No Perimetres')&& ($taches->tache != 'No Taches') &&(($taches->program == 'No Programs')||($taches->program != 'No Programs')))
 { // MAP project  has taches but haven't programs and perimetres       add condition
    // Insert FRT data of MAP Projects if not existed 
    print_r($row[5]); 
    print_r($taches->tache); 
    print_r($row[1]); 
     $test_rft=DB::table('indicatorsproj_value')
                  ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
                  ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
                  ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
                  ->join('projects','projects.id','project_has_taches.projects_id')
                  ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                  ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                  ->join('programs','programs.id','perimetres.programs_id')
                  ->join('taches','taches.id','programs.taches_id')
                  ->where('taches.tache',$taches->tache)
                  ->where('indicatorsprojs.name',$rft->name)
                  ->where('projects.project_name',$row[5])
                  ->where('indicatorsproj_value.annee',$row[0])
                  ->where('indicatorsproj_value.semaine',$row[1])
                  ->where('indicatorsproj_value.mois',$mois->id)
                  ->count();
               
         if($test_rft>0)
              {echo "rft "+ $taches->tache + "data existed \n";}
         else {
           $data_rft=DB::table('associat_indics')
          ->select('associat_indics.id','associat_indics.target')
          ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
          ->join('projects','projects.id','project_has_taches.projects_id')
          ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
          ->where('indicatorsprojs.name',$rft->name)
          ->where('projects.project_name',$row[5])
          ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
          ->join('programs','programs.id','perimetres.programs_id')
          ->join('taches','taches.id','programs.taches_id')
          ->where('taches.tache',$taches->tache)
          ->first();

          switch($taches->tache):
                  case 'T100':
                       $val_rft=number_format(((((int)$row[9]-(int)$row[15])/(int)$row[9])*100), 2 );
                      DB::table('indicatorsproj_value')
                     	 ->insert([ 'associat_indic_id' =>$data_rft->id, 
                         'target' => $data_rft->target,
		                     'value' => $val_rft, 
		                      'annee'=>$row[0],
                          'semaine'=>$row[1],
                          'mois'=>$mois->id,
                          'trimestre'=>$trimestre->id,
		                     'created_at'=> Carbon::now(),
                        ]);
                          echo " rft "+ $taches->tache + " data inserted successfully \n";
                  break;
                  case 'T200':
                      $val_rft=number_format(((((int)$row[10]-(int)$row[16])/(int)$row[10])*100), 2 );
                            DB::table('indicatorsproj_value')
                                ->insert([ 'associat_indic_id' =>$data_rft->id,
                                          'target' => $data_rft->target,
                                           'value' => $val_rft, 
                                           'annee'=>$row[0],
                                           'semaine'=>$row[1], 
                                           'mois'=>$mois->id,
                                           'trimestre'=>$trimestre->id,
                                           'created_at'=> Carbon::now(),
                                       ]);
                                 echo "rft "+ $taches->tache + " data inserted successfully \n";
                  break;
                  case 'T300':
                       $val_rft=number_format(((((int)$row[11]-(int)$row[17])/(int)$row[11])*100), 2 );
                            DB::table('indicatorsproj_value')
                                ->insert(['associat_indic_id' =>$data_rft->id,
                                           'target' => $data_rft->target,
                                           'value' => $val_rft, 
                                           'annee'=>$row[0],
                                           'semaine'=>$row[1],
                                           'mois'=>$mois->id,
                                           'trimestre'=>$trimestre->id,
                                           'created_at'=> Carbon::now(),
                                      ]);
                                
                             echo "rft" + $taches->tache + "  data inserted successfully \n";
                  break;
                  case'DQ1':
                     $val_rft=number_format(((((int)$row[12]-(int)$row[18])/(int)$row[12])*100), 2 );
                           DB::table('indicatorsproj_value')
                                ->insert(['associat_indic_id' =>$data_rft->id,
                                          'target' => $data_rft->target,
                                           'value' => $val_rft,   
                                           'annee'=>$row[0],
                                           'semaine'=>$row[1],
                                           'mois'=>$mois->id,
                                           'trimestre'=>$trimestre->id,
                                           'created_at'=> Carbon::now(),
                                       ]);
                              echo "rft "+ $taches->tache + " data inserted successfully \n"; 
                  break;
                  case'E2E':
                      $val_rft=number_format(((((int)$row[13]-(int)$row[19])/(int)$row[13])*100), 2 );
                            DB::table('indicatorsproj_value')
                                    ->insert(['associat_indic_id' =>$data_rft->id,
                                               'target' => $data_rft->target,
                                               'value' => $val_rft, 
                                               'annee'=>$row[0],
                                               'semaine'=>$row[1],
                                               'mois'=>$mois->id,
                                               'trimestre'=>$trimestre->id,
                                               'created_at'=> Carbon::now(),
                                          ]);
                            echo"rft"+ $taches->tache + "  data E2E inserted successfully \n"; 
                  break;
                   default:
                    echo"add code case tache: {condition}  break ;if you added a new tache \n"; 
                   endswitch;  
              }    // Insert OTD data of MAP Projects if not existed 
                         $data_otd=DB::table('indicatorsproj_value')
                             ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
                             ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
                             ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
                             ->join('projects','projects.id','project_has_taches.projects_id')
                             ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                             ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                             ->join('programs','programs.id','perimetres.programs_id')
                             ->join('taches','taches.id','programs.taches_id')
                             ->where('taches.tache',$taches->tache)
                             ->where('indicatorsprojs.name',$otd->name)
                             ->where('projects.project_name',$row[5])
                             ->where('indicatorsproj_value.annee',$row[0])
                             ->where('indicatorsproj_value.semaine',$row[1])
                             ->where('indicatorsproj_value.mois',$mois->id)
                             ->get();
                             $test_otd=$data_otd->count();
            if($test_otd>0)
                {echo "OTD"+ $taches->tache + " data existed \n";}
            else { 
              $data_otd=DB::table('associat_indics')
              ->select('associat_indics.id','associat_indics.target')
              ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
              ->where('indicatorsprojs.name',$otd->name)
              ->where('projects.project_name',$row[5])
              ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
              ->join('programs','programs.id','perimetres.programs_id')
              ->join('taches','taches.id','programs.taches_id')
              ->where('taches.tache',$taches->tache)
              ->first();
              switch($taches->tache):
              case 'T100':
                      $val_otd=number_format(((((int)$row[9]-(int)$row[21])/(int)$row[9])*100), 2 );
                     DB::table('indicatorsproj_value')
                      ->insert([ 'associat_indic_id' =>$data_otd->id,
                      'target' => $data_otd->target,
                      'value' => $val_otd, 
                      'annee'=>$row[0],
                      'semaine'=>$row[1],
                      'mois'=>$mois->id,
                      'trimestre'=>$trimestre->id,
                      'created_at'=> Carbon::now(),
                       ]);
                       echo " OTD "+ $taches->tache + "  data inserted successfully \n";
              break;
              case 'T200':
                   $val_otd=number_format(((((int)$row[10]-(int)$row[22])/(int)$row[10])*100), 2 );
                     DB::table('indicatorsproj_value')
                        ->insert(['associat_indic_id' =>$otd->id,
                               'target' => $data_otd->target,
                               'value' => $val_otd,  
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$mois->id,
                               'trimestre'=>$trimestre->id,
                               'created_at'=> Carbon::now(),
                                ]);
                                echo "OTD"+ $taches->tache + "  data  inserted successfully \n";
              break;
              case 'T300':
                     $val_otd=number_format(((((int)$row[11]-(int)$row[23])/(int)$row[11])*100), 2 );
                     DB::table('indicatorsproj_value')
                        ->insert([ 'associat_indic_id' =>$data_otd->id,
                               'target' => $data_otd->target,
                               'value' => $val_otd,  
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$mois->id,
                               'trimestre'=>$trimestre->id,
                               'created_at'=> Carbon::now(),
                                ]);
                  echo "OTD "+ $taches->tache + "data inserted successfully \n";
               break;
               case'DQ1':
                      $val_otd=number_format(((((int)$row[12]-(int)$row[24])/(int)$row[12])*100), 2 );
                      DB::table('indicatorsproj_value')
                        ->insert([ 'associat_indic_id' =>$otd->id,
                               'target' => $data_otd->target,
                               'value' => $val_otd,  
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$mois->id,
                               'trimestre'=>$trimestre->id,
                               'created_at'=> Carbon::now(),
                                ]);
                                echo "OTD"+ $taches->tache + " data  inserted successfully \n"; 
                      break;
                      case'E2E':
                        $val_otd=number_format(((((int)$row[13]-(int)$row[25])/(int)$row[13])*100), 2 );
                          DB::table('indicatorsproj_value')
                             ->insert([ 'associat_indic_id' =>$data_otd->id,
                                   'target' => $data_otd->target,
                                   'value' => $val_otd, 
                                   'annee'=>$row[0],
                                   'semaine'=>$row[1],
                                   'mois'=>$mois->id,
                                   'trimestre'=>$trimestre->id,
                                   'created_at'=> Carbon::now(),
                                    ]);
                      echo"OTD "+ $taches->tache + " data inserted successfully \n"; 
                          break;
                 default:
                 echo"add code case tache: {condition}  break ;if you added a new tache \n";  
                    endswitch;  
                  }     // Insert TTA data of MAP Projects if not existed 
                    $test_tta=DB::table('indicatorsproj_value')
                            ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
                             ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
                             ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
                             ->join('projects','projects.id','project_has_taches.projects_id')
                             ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                             ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                             ->join('programs','programs.id','perimetres.programs_id')
                             ->join('taches','taches.id','programs.taches_id')
                             ->where('taches.tache',$taches->tache)
                             ->where('indicatorsprojs.name',$tta->name)
                             ->where('projects.project_name',$row[5])
                             ->where('indicatorsproj_value.annee',$row[0])
                             ->where('indicatorsproj_value.semaine',$row[1])
                             ->where('indicatorsproj_value.mois',$mois->id)
                             ->count();
             if($test_otd>0)
                   {echo "TTA data existed \n";}
            else {
              $data_tta=DB::table('associat_indics')
              ->select('associat_indics.id','associat_indics.target')
              ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
              ->where('indicatorsprojs.name',$otd->name)
              ->where('projects.project_name',$row[5])
              ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
              ->join('programs','programs.id','perimetres.programs_id')
              ->join('taches','taches.id','programs.taches_id')
              ->where('taches.tache',$taches->tache)
              ->first();
              switch($taches->tache):
                case 'T100':
                    DB::table('indicatorsproj_value')
                        ->insert([ 'associat_indic_id' =>$data_tta->id,
                        'target' => $data_tta->target,
                        'value' => $row[36], 
                        'annee'=>$row[0],
                        'semaine'=>$row[1],
                        'mois'=>$mois->id,
                        'trimestre'=>$trimestre->id,
                        'created_at'=> Carbon::now(),
                         ]);
                         echo " TTA "+ $taches->tache + "  data inserted successfully \n";
                break;
                case 'T200':
                     $val_otd=number_format(((((int)$row[10]-(int)$row[22])/(int)$row[10])*100), 2 );
                       DB::table('indicatorsproj_value')
                         ->insert([ 'associat_indic_id' =>$data_tta->id,
                                 'target' => $data_tta->target,
                                 'value' =>$row[37],  
                                 'annee'=>$row[0],
                                 'semaine'=>$row[1],
                                 'mois'=>$mois->id,
                                 'trimestre'=>$trimestre->id,
                                 'created_at'=> Carbon::now(),
                                  ]);
                                  echo "TTA"+ $taches->tache + "  data  inserted successfully \n";
                break;
                case 'T300':
                       $val_otd=number_format(((((int)$row[11]-(int)$row[23])/(int)$row[11])*100), 2 );
                       DB::table('indicatorsproj_value')
                           ->insert([ 'associat_indic_id' =>$data_tta->id,
                                'target' => $data_tta->target,
                                 'value' => $row[38],  
                                 'annee'=>$row[0],
                                 'semaine'=>$row[1],
                                 'mois'=>$mois->id,
                                 'trimestre'=>$trimestre->id,
                                 'created_at'=> Carbon::now(),
                                  ]);
                    echo "TTA "+ $taches->tache + "data inserted successfully \n";
                 break;
                 case 'ANIF':
                  DB::table('indicatorsproj_value')
                      ->insert([ 'associat_indic_id' =>$data_tta->id,
                           'target' => $data_tta->target,
                            'value' => $row[39],  
                            'annee'=>$row[0],
                            'semaine'=>$row[1],
                            'mois'=>$mois->id,
                            'trimestre'=>$trimestre->id,
                            'created_at'=> Carbon::now(),
                             ]);
               echo "TTA "+ $taches->tache + "data inserted successfully \n";
            break;
                   default:
                   echo"add code case tache: {condition}  break ;if you added a new tache \n";  
                      endswitch;  
          
                }    // Insert RTO data of MAP Projects if not existed 
                $test_rto=DB::table('indicatorsproj_value')
                ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
                 ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
                 ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
                 ->join('projects','projects.id','project_has_taches.projects_id')
                 ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                 ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                 ->join('programs','programs.id','perimetres.programs_id')
                 ->join('taches','taches.id','programs.taches_id')
                 ->where('taches.tache',$taches->tache)
                 ->where('indicatorsprojs.name',$rto->name)
                 ->where('projects.project_name',$row[5])
                 ->where('indicatorsproj_value.annee',$row[0])
                 ->where('indicatorsproj_value.semaine',$row[1])
                 ->where('indicatorsproj_value.mois',$mois->id)
                 ->count();
        if($test_rto>0)
             {echo "RTO data existed \n";}
        else {
          $data_rto=DB::table('associat_indics')
              ->select('associat_indics.id','associat_indics.target')
              ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
              ->where('indicatorsprojs.name',$otd->name)
              ->where('projects.project_name',$row[5])
              ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
              ->join('programs','programs.id','perimetres.programs_id')
              ->join('taches','taches.id','programs.taches_id')
              ->where('taches.tache',$taches->tache)
              ->first();
         switch($taches->tache):
           case 'T100':
            DB::table('indicatorsproj_value')
            ->insert([ 'associat_indic_id' =>$data_rto->id,
            'target' => $data_rto->target,
            'value' => $row[32], 
            'annee'=>$row[0],
            'semaine'=>$row[1],
            'mois'=>$mois->id,
            'trimestre'=>$trimestre->id,
            'created_at'=> Carbon::now(),
             ]);
             echo " RTO"+ $taches->tache + "  data inserted successfully \n";
          break;
          case 'T200':
           DB::table('indicatorsproj_value')
             ->insert([ 'associat_indic_id' =>$data_rto->id,
                     'target' => $data_rto->target,
                     'value' =>$row[33],  
                     'annee'=>$row[0],
                     'semaine'=>$row[1],
                     'mois'=>$mois->id,
                     'trimestre'=>$trimestre->id,
                     'created_at'=> Carbon::now(),
                      ]);
                      echo "RTO"+ $taches->tache + "  data  inserted successfully \n";
    break;
    case 'T300':
            DB::table('indicatorsproj_value')
               ->insert([ 'associat_indic_id' =>$data_rto->id,
                    'target' => $data_rto->target,
                     'value' => $row[34],  
                     'annee'=>$row[0],
                     'semaine'=>$row[1],
                     'mois'=>$mois->id,
                     'trimestre'=>$trimestre->id,
                     'created_at'=> Carbon::now(),
                      ]);
        echo "rft "+ $taches->tache + "data inserted successfully \n";
     break;
     case 'ANIF':
      DB::table('indicatorsproj_value')
          ->insert([ 'associat_indic_id' =>$data_rto->id,
               'target' => $data_rto->target,
                'value' => $row[35],  
                'annee'=>$row[0],
                'semaine'=>$row[1],
                'mois'=>$mois->id,
                'trimestre'=>$trimestre->id,
                'created_at'=> Carbon::now(),
                 ]);
   echo "RTO "+ $taches->tache + "data inserted successfully \n";
break;
       default:
       echo"add code case tache: {condition}  break ;if you added a new tache \n";  
          endswitch;  

    }
  }
}
  //******************************************************************* */  		
  if (($row[28] > 0) && ($row[29]>0) )
  // Insert hours data after existance test
    { $test_hours=DB::table('hours')
        ->join('project_has_taches','project_has_taches.id','hours.project_id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->where('projects.project_name',$row[5])
        ->where('hours.annee',$row[0])
        ->where('hours.semaine',$row[1])
        ->where('hours.mois',$mois->id)
       ->count();
 if($test_hours>0)
        {echo "hours data existed \n ";}
   else {  
          
        // insert hours data
        $projs=DB::table('project_has_taches')
        ->select('project_has_taches.id')
         ->join('projects','projects.id','project_has_taches.projects_id')
         ->where('projects.project_name',$row[5])
        ->get();
        foreach($projs as $v)
    DB::table('hours')->insert([
            'project_id' =>$v->id,
            'h_r_rl' => $row[28], 
            'h_r_est' => $row[29],
            'h_fact'=>$row[28],
            'annee'=>$row[0],
            'semaine'=>$row[1],
            'mois'=>$mois->id,
            'trimestre'=>$trimestre->id,
            'created_at'=> Carbon::now(),
             ]);
             echo"hours data inserted successfully \n";
               
           }
            // Insert seuil_rentabilite data after existance test
           $test_seuil_rentabilite=DB::table('indicatorsproj_value')
            ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
            ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
            ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
            ->join('projects','projects.id','project_has_taches.projects_id')
            ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
                  ->where('indicatorsprojs.name',$seuil_rentabilite->name)
                  ->where('projects.project_name',$row[5])
                  ->where('indicatorsproj_value.annee',$row[0])
                  ->where('indicatorsproj_value.semaine',$row[1])
                  ->where('indicatorsproj_value.mois',$mois->id)
                  ->count();
                  
 if($test_seuil_rentabilite>0)
          {  echo "Seuil de rentabilité data existed \n";  }
else{
  $data_seuil_rentabilite=DB::table('associat_indics')
  ->select('associat_indics.id','associat_indics.target')
  ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
  ->join('projects','projects.id','project_has_taches.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
  ->where('indicatorsprojs.name',$seuil_rentabilite->name)
  ->where('projects.project_name',$row[5])
  ->first();
     $val_seuil_rentabilite=number_format(((((int)$row[31])*8.5)*5), 2 );
      DB::table('indicatorsproj_value')
      ->insert([ 'associat_indic_id' =>$data_seuil_rentabilite->id,
               'target' => $data_seuil_rentabilite->target,
               'value' => $val_seuil_rentabilite, 
               'annee'=>$row[0],
               'semaine'=>$row[1],
               'mois'=>$mois->id,
               'trimestre'=>$trimestre->id,
               'created_at'=> Carbon::now(),
               ]);
        echo"Seuil de rentabilité data inserted successfully \n";
       } 
          $test_efficacite=DB::table('indicatorsproj_value')
          ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
          ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
          ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
          ->join('projects','projects.id','project_has_taches.projects_id')
          ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
             ->where('indicatorsprojs.name',$efficacite->name)
             ->where('projects.project_name',$row[5])
             ->where('indicatorsproj_value.annee',$row[0])
             ->where('indicatorsproj_value.semaine',$row[1])
             ->where('indicatorsproj_value.mois',$mois->id)
             ->count();
                   
   if($test_efficacite>0)
            {  echo "efficacite data existed \n";  }
  else{
    $data_efficacite=DB::table('associat_indics')
    ->select('associat_indics.id','associat_indics.target')
    ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
    ->join('projects','projects.id','project_has_taches.projects_id')
    ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
    ->where('indicatorsprojs.name',$efficacite->name)
    ->where('projects.project_name',$row[5])
    ->first();

	   $val_efficacite=number_format(((((int)$row[29])/((int)$row[28]))), 2 );
		DB::table('indicatorsproj_value')
    ->insert([ 'associat_indic_id' =>$data_efficacite->id,
              'target' => $data_efficacite->target,
	            'value' => $val_efficacite,    
              'annee'=>$row[0],
              'semaine'=>$row[1],
              'mois'=>$mois->id,
              'trimestre'=>$trimestre->id,
	            'created_at'=> Carbon::now(),
             ]);
          echo"efficacite data inserted successfully \n";
         } 
  $test_efficience_estime=DB::table('indicatorsproj_value')
  ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
  ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
  ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
  ->join('projects','projects.id','project_has_taches.projects_id')
  ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
  ->where('indicatorsprojs.name',$efficience_estime->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$mois->id)
  ->count();
  if($test_efficience_estime>0)
         {echo "efficience estimée  data existed \n";}
  else{
    $data_efficience_estime=DB::table('associat_indics')
    ->select('associat_indics.id','associat_indics.target')
    ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
    ->join('projects','projects.id','project_has_taches.projects_id')
    ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
    ->where('indicatorsprojs.name',$efficience_estime->name)
    ->where('projects.project_name',$row[5])
    ->first();
    $val_seuil_rentabilite=number_format(((((int)$row[31])*8.5)*5), 2 );
     $val_efficience_estime=number_format(((((int)$row[29])/ $val_seuil_rentabilite)), 2 );
	     DB::table('indicatorsproj_value')
	      ->insert(['associat_indic_id' =>$data_efficience_estime->id,
                'target' => $data_efficience_estime->target,
                'value' => $val_efficience_estime, 
		            'annee'=>$row[0],
                'semaine'=>$row[1],
                'mois'=>$mois->id,
                'trimestre'=>$trimestre->id,
		            'created_at'=> Carbon::now(),
                ]);
           echo" efficience estimée data inserted successfully \n";
    }
    $test_efficience_facture=DB::table('indicatorsproj_value')
    ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
    ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
    ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
    ->join('projects','projects.id','project_has_taches.projects_id')
    ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
  ->where('indicatorsprojs.name',$efficience_facture->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsproj_value.annee',$row[0])
  ->where('indicatorsproj_value.semaine',$row[1])
  ->where('indicatorsproj_value.mois',$mois->id)
  ->count();
  if($test_efficience_facture>0)
         {echo "efficience facturée data existed \n ";}
  else{
    $data_efficience_facture=DB::table('associat_indics')
    ->select('associat_indics.id','associat_indics.target')
    ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
    ->join('projects','projects.id','project_has_taches.projects_id')
    ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
    ->where('indicatorsprojs.name',$efficience_facture->name)
    ->where('projects.project_name',$row[5])
    ->first();
    $val_seuil_rentabilite=number_format(((((int)$row[31])*8.5)*5), 2 );
     $val_efficience_facture=number_format(((((int)$row[30])/ $val_seuil_rentabilite)), 2 );
	     DB::table('indicatorsproj_value')
	      ->insert(['associat_indic_id' =>$data_efficience_facture->id,
                  'target' => $data_efficience_facture->target,  
                   'value' => $val_efficience_facture, 
		              'annee'=>$row[0],
                  'semaine'=>$row[1],
                  'mois'=>$mois->id,
                  'trimestre'=>$trimestre->id,
		              'created_at'=> Carbon::now(),
                   ]);
           echo" efficience facturée data inserted successfully \n";
    }
    
    }
    else
    { if ($row[30]=='' OR $row[28]=="/" )
       { echo " your file missed data in cell "+$row[28] ;  }
       else if ($row[29]=='' OR $row[29]=="/")
       { echo " your file missed data in cell "+$row[29] ;  }
      // else if ($row[28]=='' OR $row[28]=="/")
     //  { echo "your file missed data in callules :"+$row[28]+","+$row[27]+"and"+$row[27];}
     
    }
     if ($row[30]>0 && $row[30]!="/")
    { $test_production=DB::table('indicatorsproj_value')
     ->select('indicatorsproj_value.annee','indicatorsproj_value.semaine','indicatorsproj_value.mois','associat_indics.*')
     ->join('associat_indics','associat_indics.id','indicatorsproj_value.associat_indic_id')
     ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
     ->join('projects','projects.id','project_has_taches.projects_id')
     ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
     ->where('indicatorsprojs.name',$production->name)
     ->where('projects.project_name',$row[5])
     ->where('indicatorsproj_value.annee',$row[0])
     ->where('indicatorsproj_value.semaine',$row[1])
     ->where('indicatorsproj_value.mois',$mois->id)
     ->count();
     if($test_production>0)
            {echo " PRODUCTION data existed \n ";} 
     else{
      $data_production=DB::table('associat_indics')
      ->select('associat_indics.id','associat_indics.target')
      ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
      ->join('projects','projects.id','project_has_taches.projects_id')
      ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
      ->where('indicatorsprojs.name',$production->name)
      ->where('projects.project_name',$row[5])
      ->first();
      
          DB::table('indicatorsproj_value')
           ->insert(['associat_indic_id' =>$data_production->id,
                    'target' => $data_production->target,
                     'value' => $row[30], 
                     'annee'=>$row[0],
                     'semaine'=>$row[1],
                     'mois'=>$mois->id,
                     'trimestre'=>$trimestre->id,
                     'created_at'=> Carbon::now(),
                    ]);
              echo" PRODUCTION data inserted successfully \n";
       } 
      }
        }
    }
} 