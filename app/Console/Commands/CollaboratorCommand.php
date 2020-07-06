<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\indicatorsusers;
use DB;
use PHPExcel_IOFactory;
use Illuminate\Console\Command;
use Carbon\Carbon;
  /** PHPExcel_IOFactory */
//include public_path().'/PHPExcel/PHPExcel/IOFactory.php';
class CollaboratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:collaborator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inserted indicators data of users';

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
                $sheet = $objPHPExcel->getSheet(1);  //getSheetByName()
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
                {       	$users=DB::table('users')->where('name',$row[6])->first();
                          $mois=DB::table('mois')->where('mois',$row[2])->first();
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
  echo" Project  hasen't taches : ";
  print_r($row[5]); echo " \n tache :";
  print_r($taches->tache); echo " \n semaine: ";
  print_r($row[1]);echo " \n  ";
            $test_rft=DB::table('indicatorsusers_value')
            ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
            ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
            ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
            ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
            ->join('projects','projects.id','project_has_taches.projects_id')
            ->join('users','users.id','project_has_users.users_id')
            ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
            ->where('users.name',$row[6])
            ->where('indicatorsprojs.name',$rft->name)
            ->where('projects.project_name',$row[5])
            ->where('indicatorsusers_value.annee',$row[0])
            ->where('indicatorsusers_value.semaine',$row[1])
            ->where('indicatorsusers_value.mois',$row[2])
            ->count();
            if($test_rft>0)
                 {echo "rft data existed \n";}
            else { 
              $data_rft=DB::table('associat_users_indics')
              ->select('associat_users_indics.id','associat_users_indics.target')
              ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
              ->join('users','users.id','project_has_users.users_id')
             ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
              ->where('indicatorsprojs.name',$rft->name)
              ->where('users.name',$row[6])
              ->where('projects.project_name',$row[5])
              ->first();
                 //test if there is data in col "Nombre des livrables consommés au production" to calculate RFT value
                   if($row[8] != "/" && $row[8]>0 && $row[9]=="/")     
                       {   $val_rft=(((int)$row[8]-(int)$row[15])/(int)$row[8])*100; 
                          DB::table('indicatorsusers_value')
                          ->insert([ 'associat_users_indic_id' =>$data_rft->id,
                                     'target' => $data_rft->target,
                                     'value' => $val_rft,  
                                     'annee'=>$row[0],
                                     'semaine'=>$row[1],
                                     'mois'=>$row[2],
                                     'trimestre'=>$row[3],
                                      'created_at'=> Carbon::now(),
                                   ]);
                               echo "rft data inserted successfully \n";
                       }
                       //test if there is data in col "Nbre des livrables relachées" to calculate RFT value
                   else if($row[9] != "/" && $row[9]>0 && $row[8]=="/")
                       {  $val_rft=(((int)$row[9]-(int)$row[15])/(int)$row[8])*100; 
                          DB::table('indicatorsusers_value')
                          ->insert(['associat_users_indic_id' =>$data_rft->id,
                                    'target' => $data_rft->target,
                                    'value' => $val_rft, 
                                    'annee'=>$row[0],
                                    'semaine'=>$row[1],
                                    'mois'=>$row[2],
                                    'trimestre'=>$row[3],
                                    'created_at'=> Carbon::now(),
                                   ]);
                                echo "rft data inserted successfully \n";
                       } // calculate RFT value with col "Nbre des Livrable"
                   else if($row[7] > 0 && $row[8]=="/" && $row[9]=="/")
                       {  $val_rft=(((int)$row[7]-(int)$row[15])/(int)$row[7])*100; 
                          DB::table('indicatorsusers_value')
                          ->insert(['associat_users_indic_id' =>$data_rft->id,
                                 'target' => $data_rft->target,
                                 'value' => $val_rft, 
                                 'annee'=>$row[0],
                                 'semaine'=>$row[1],
                                 'mois'=>$row[2], 
                                 'trimestre'=>$row[3],
                                 'created_at'=> Carbon::now(),
                                ]);
                                echo "rft data inserted successfully \n"; 
                              }
                  } 
                  // Select data of OTD and test if existed in DB
                     $test_otd=DB::table('indicatorsusers_value')
                            ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                            ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                            ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                            ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                            ->join('projects','projects.id','project_has_taches.projects_id')
                            ->join('users','users.id','project_has_users.users_id')
                            ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                            ->where('users.name',$row[6])
                            ->where('indicatorsprojs.name',$otd->name)
                            ->where('projects.project_name',$row[5])
                            ->where('indicatorsusers_value.annee',$row[0])
                            ->where('indicatorsusers_value.semaine',$row[1])
                            ->where('indicatorsusers_value.mois',$row[2])
                            ->count();
                   if($test_otd>0)
                        {echo "otd data existed \n";}
                   else {
                    $data_otd=DB::table('associat_users_indics')
                    ->select('associat_users_indics.id','associat_users_indics.target')
                    ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                    ->join('users','users.id','project_has_users.users_id')
                   ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                    ->join('projects','projects.id','project_has_taches.projects_id')
                    ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                    ->where('indicatorsprojs.name',$otd->name)
                    ->where('users.name',$row[6])
                    ->where('projects.project_name',$row[5])
                    ->first();
                      $val_otd=(((int)$row[7]-(int)$row[21])/(int)$row[7])*100;
                    
                     DB::table('indicatorsusers_value')->insert([
                                'associat_users_indic_id' =>$data_otd->id,
                                 'target' => $data_otd->target,
                                 'value' => $val_otd, 
                                 'annee'=>$row[0],
                                 'semaine'=>$row[1],
                                 'mois'=>$row[2],
                                 'trimestre'=>$row[3],
                                 'created_at'=> Carbon::now(),
                                ]);
                         echo "otd data inserted successfully \n";
                    
                   }		
                  }
           else { // MAP project  has taches but haven't programs and perimetres       add condition
              // Insert FRT data of MAP Projects if not existed 
               $test_rft=DB::table('indicatorsusers_value')
               ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
               ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
               ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
               ->join('projects','projects.id','project_has_taches.projects_id')
               ->join('users','users.id','project_has_users.users_id')
               ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                            ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                            ->join('programs','programs.id','perimetres.programs_id')
                            ->join('taches','taches.id','programs.taches_id')
                            ->where('users.name',$row[6])
                            ->where('taches.tache',$taches->tache)
                            ->where('indicatorsprojs.name',$rft->name)
                            ->where('projects.project_name',$row[5])
                            ->where('indicatorsusers_value.annee',$row[0])
                            ->where('indicatorsusers_value.semaine',$row[1])
                            ->where('indicatorsusers_value.mois',$row[2])
                            ->count(); 
                   if($test_rft>0)
                        {echo "RFT data existed \n";}
                   else {
                      $data_rft=DB::table('associat_users_indics')
                    ->select('associat_users_indics.id','associat_users_indics.target')
                    ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                    ->join('users','users.id','project_has_users.users_id')
                   ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                    ->join('projects','projects.id','project_has_taches.projects_id')
                    ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                    ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                    ->join('programs','programs.id','perimetres.programs_id')
                    ->join('taches','taches.id','programs.taches_id')
                    ->where('taches.tache',$taches->tache)
                    ->where('indicatorsprojs.name',$rft->name)
                    ->where('users.name',$row[6])
                    ->where('projects.project_name',$row[5])
                    ->first();
                    switch($taches->tache):
                     
                            case 'T100':
                                 $val_rft=(((int)$row[10]-(int)$row[16])/(int)$row[10])*100; 
                                DB::table('indicatorsusers_value')
                                    ->insert([ 'associat_users_indic_id' =>$taches->id, 
                                   'target' => $data_rft->target,
                                       'value' => $val_rft, 
                                        'annee'=>$row[0],
                                    'semaine'=>$row[1],
                                    'mois'=>$row[2],
                                    'trimestre'=>$row[3],
                                       'created_at'=> Carbon::now(),
                                  ]);
                                    echo "RFT data inserted successfully \n";
                            break;
                            case 'T200':
                                $val_rft=(((int)$row[11]-(int)$row[17])/(int)$row[11])*100; 
                                      DB::table('indicatorsusers_value')
                                          ->insert([ 'associat_users_indic_id' =>$data_rft->id,
                                                    'target' => $data_rft->target,
                                                     'value' => $val_rft, 
                                                     'annee'=>$row[0],
                                                     'semaine'=>$row[1], 
                                                     'mois'=>$row[2],
                                                     'trimestre'=>$row[3],
                                                     'created_at'=> Carbon::now(),
                                                 ]);
                                           echo "RFT data inserted successfully \n";
                            break;
                            case 'T300':
                                 $val_rft=(((int)$row[12]-(int)$row[18])/(int)$row[12])*100; 
                                      DB::table('indicatorsusers_value')
                                          ->insert(['associat_users_indic_id' =>$data_rft->id,
                                                     'target' => $data_rft->target,
                                                     'value' => $val_rft, 
                                                     'annee'=>$row[0],
                                                     'semaine'=>$row[1],
                                                     'mois'=>$row[2],
                                                     'trimestre'=>$row[3],
                                                     'created_at'=> Carbon::now(),
                                                ]);
                                          
                                       echo "RFT  data inserted successfully \n";
                            break;
                            case'DQ1':
                               $val_rft=(((int)$row[13]-(int)$row[19])/(int)$row[13])*100; 
                                     DB::table('indicatorsusers_value')
                                          ->insert(['associat_users_indic_id' =>$data_rft->id,
                                                    'target' => $data_rft->target,
                                                     'value' => $val_rft,   
                                                     'annee'=>$row[0],
                                                     'semaine'=>$row[1],
                                                     'mois'=>$row[2],
                                                     'trimestre'=>$row[3],
                                                     'created_at'=> Carbon::now(),
                                                 ]);
                                        echo "RFT data inserted successfully \n"; 
                            break;
                            case'E2E':
                                $val_rft=(((int)$row[14]-(int)$row[20])/(int)$row[14])*100; 
                                      DB::table('indicatorsusers_value')
                                              ->insert(['associat_users_indic_id' =>$data_rft->id,
                                                         'target' => $data_rft->target,
                                                         'value' => $val_rft, 
                                                         'annee'=>$row[0],
                                                         'semaine'=>$row[1],
                                                         'mois'=>$row[2],
                                                         'trimestre'=>$row[3],
                                                         'created_at'=> Carbon::now(),
                                                    ]);
                                      echo"RFT data E2E inserted successfully \n"; 
                            break;
                             default:
                              echo"add code case tache: {condition}  break ;if you added a new tache \n"; 
                             endswitch;  
                        }    // Insert OTD data of MAP Projects if not existed 
                                   $test_otd=DB::table('indicatorsusers_value')
                                       ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                                       ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                                       ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                                       ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                                       ->join('projects','projects.id','project_has_taches.projects_id')
                                       ->join('users','users.id','project_has_users.users_id')
                                       ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                                       ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                                       ->join('programs','programs.id','perimetres.programs_id')
                                       ->join('taches','taches.id','programs.taches_id')
                                       ->where('users.name',$row[6])
                                       ->where('taches.tache',$taches->tache)
                                       ->where('indicatorsprojs.name',$otd->name)
                                       ->where('projects.project_name',$row[5])
                                       ->where('indicatorsusers_value.annee',$row[0])
                                       ->where('indicatorsusers_value.semaine',$row[1])
                                       ->where('indicatorsusers_value.mois',$row[2])
                                       ->count();
                      if($test_otd>0)
                          {echo "OTdata existed \n";}
                      else { 
                        $data_otd=DB::table('associat_users_indics')
                        ->select('associat_users_indics.id','associat_users_indics.target')
                        ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                        ->join('users','users.id','project_has_users.users_id')
                       ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                        ->join('projects','projects.id','project_has_taches.projects_id')
                        ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                        ->join('programs','programs.id','perimetres.programs_id')
                        ->join('taches','taches.id','programs.taches_id')
                        ->where('taches.tache',$taches->tache)
                        ->where('indicatorsprojs.name',$otd->name)
                        ->where('users.name',$row[6])
                        ->where('projects.project_name',$row[5])
                        ->first();
                        switch($taches->tache):
                        case 'T100':
                                $val_otd=(((int)$row[10]-(int)$row[22])/(int)$row[10])*100;
                               DB::table('indicatorsusers_value')
                                ->insert([ 'associat_users_indic_id' =>$data_otd->id,
                                'target' => $data_otd->target,
                                'value' => $val_otd, 
                                'annee'=>$row[0],
                                'semaine'=>$row[1],
                                'mois'=>$row[2],
                                'trimestre'=>$row[3],
                                'created_at'=> Carbon::now(),
                                 ]);
                                 echo " OTD data inserted successfully \n";
                        break;
                        case 'T200':
                             $val_otd=(((int)$row[11]-(int)$row[23])/(int)$row[11])*100;
                               DB::table('indicatorsusers_value')
                                  ->insert(['associat_users_indic_id' =>$otd->id,
                                         'target' => $data_otd->target,
                                         'value' => $val_otd,  
                                         'annee'=>$row[0],
                                         'semaine'=>$row[1],
                                         'mois'=>$row[2],
                                         'trimestre'=>$row[3],
                                         'created_at'=> Carbon::now(),
                                          ]);
                                          echo "OTD data  inserted successfully \n";
                        break;
                        case 'T300':
                               $val_otd=(((int)$row[12]-(int)$row[24])/(int)$row[12])*100;
                               DB::table('indicatorsusers_value')
                                  ->insert([ 'associat_users_indic_id' =>$data_otd->id,
                                         'target' => $data_otd->target,
                                         'value' => $val_otd,  
                                         'annee'=>$row[0],
                                         'semaine'=>$row[1],
                                         'mois'=>$row[2],
                                         'trimestre'=>$row[3],
                                         'created_at'=> Carbon::now(),
                                          ]);
                            echo "OTD data inserted successfully \n";
                         break;
                         case'DQ1':
                                $val_otd=(((int)$row[13]-(int)$row[25])/(int)$row[13])*100;
                                DB::table('indicatorsusers_value')
                                  ->insert([ 'associat_users_indic_id' =>$otd->id,
                                         'target' => $data_otd->target,
                                         'value' => $val_otd,  
                                         'annee'=>$row[0],
                                         'semaine'=>$row[1],
                                         'mois'=>$row[2],
                                         'trimestre'=>$row[3],
                                         'created_at'=> Carbon::now(),
                                          ]);
                                          echo "OTD data inserted successfully \n"; 
                                break;
                                case'E2E':
                                  $val_otd=(((int)$row[14]-(int)$row[26])/(int)$row[14])*100;
                                    DB::table('indicatorsusers_value')
                                       ->insert([ 'associat_users_indic_id' =>$data_otd->id,
                                             'target' => $data_otd->target,
                                             'value' => $val_otd, 
                                             'annee'=>$row[0],
                                             'semaine'=>$row[1],
                                             'mois'=>$row[2],
                                             'trimestre'=>$row[3],
                                             'created_at'=> Carbon::now(),
                                              ]);
                                echo"OTD data inserted successfully \n"; 
                                    break;
                           default:
                           echo"add code case tache: {condition}  break ;if you added a new tache \n";  
                              endswitch;  
                            }     // Insert TTA data of MAP Projects if not existed 
                              $test_tta=DB::table('indicatorsusers_value')
                                      ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                                      ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                                      ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                                      ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                                      ->join('projects','projects.id','project_has_taches.projects_id')
                                      ->join('users','users.id','project_has_users.users_id')
                                      ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                                       ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                                       ->join('programs','programs.id','perimetres.programs_id')
                                       ->join('taches','taches.id','programs.taches_id')
                                       ->where('users.name',$row[6])
                                       ->where('taches.tache',$taches->tache)
                                       ->where('indicatorsprojs.name',$tta->name)
                                       ->where('projects.project_name',$row[5])
                                       ->where('indicatorsusers_value.annee',$row[0])
                                       ->where('indicatorsusers_value.semaine',$row[1])
                                       ->where('indicatorsusers_value.mois',$row[2])
                                       ->count();
                       if($test_otd>0)
                             {echo "TTA data existed \n";}
                      else {
                        $data_tta=DB::table('associat_users_indics')
                        ->select('associat_users_indics.id','associat_users_indics.target')
                        ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                        ->join('users','users.id','project_has_users.users_id')
                       ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                        ->join('projects','projects.id','project_has_taches.projects_id')
                        ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                        ->join('programs','programs.id','perimetres.programs_id')
                        ->join('taches','taches.id','programs.taches_id')
                        ->where('taches.tache',$taches->tache)
                        ->where('indicatorsprojs.name',$tta->name)
                        ->where('users.name',$row[6])
                        ->where('projects.project_name',$row[5])
                        ->first();
                        switch($taches->tache):
                          case 'T100':
                              DB::table('indicatorsusers_value')
                                  ->insert([ 'associat_users_indic_id' =>$data_tta->id,
                                  'target' => $data_tta->target,
                                  'value' => $row[33], 
                                  'annee'=>$row[0],
                                  'semaine'=>$row[1],
                                  'mois'=>$row[2],
                                  'trimestre'=>$row[3],
                                  'created_at'=> Carbon::now(),
                                   ]);
                                   echo " TTA data inserted successfully \n";
                          break;
                          case 'T200':
                               
                                 DB::table('indicatorsusers_value')
                                   ->insert([ 'associat_users_indic_id' =>$data_tta->id,
                                           'target' => $data_tta->target,
                                           'value' =>$row[34],  
                                           'annee'=>$row[0],
                                           'semaine'=>$row[1],
                                           'mois'=>$row[2],
                                           'trimestre'=>$row[3],
                                           'created_at'=> Carbon::now(),
                                            ]);
                                            echo "TT data  inserted successfully \n";
                          break;
                          case 'T300':
                                 $val_otd=(((int)$row[11]-(int)$row[23])/(int)$row[11])*100;
                                 DB::table('indicatorsusers_value')
                                     ->insert([ 'associat_users_indic_id' =>$data_tta->id,
                                          'target' => $data_tta->target,
                                           'value' => $row[35],  
                                           'annee'=>$row[0],
                                           'semaine'=>$row[1],
                                           'mois'=>$row[2],
                                           'trimestre'=>$row[3],
                                           'created_at'=> Carbon::now(),
                                            ]);
                              echo "TTA data inserted successfully \n";
                           break;
                           case 'ANIF':
                            DB::table('indicatorsusers_value')
                                ->insert([ 'associat_users_indic_id' =>$data_tta->id,
                                     'target' => $data_tta->target,
                                      'value' => $row[36],  
                                      'annee'=>$row[0],
                                      'semaine'=>$row[1],
                                      'mois'=>$row[2],
                                      'trimestre'=>$row[3],
                                      'created_at'=> Carbon::now(),
                                       ]);
                         echo "TTA data inserted successfully \n";
                      break;
                             default:
                             echo"add code case tache: {condition}  break ;if you added a new tache \n";  
                                endswitch;  
                    
                          }    // Insert RTO data of MAP Projects if not existed 
                          $test_rto=DB::table('indicatorsusers_value')
                           ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                           ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                           ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                           ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                           ->join('projects','projects.id','project_has_taches.projects_id')
                           ->join('users','users.id','project_has_users.users_id')
                           ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                           ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                           ->join('programs','programs.id','perimetres.programs_id')
                           ->join('taches','taches.id','programs.taches_id')
                           ->where('users.name',$row[6])
                           ->where('taches.tache',$taches->tache)
                           ->where('indicatorsprojs.name',$rto->name)
                           ->where('projects.project_name',$row[5])
                           ->where('indicatorsusers_value.annee',$row[0])
                           ->where('indicatorsusers_value.semaine',$row[1])
                           ->where('indicatorsusers_value.mois',$row[2])
                           ->count();
                  if($test_rto>0)
                       {echo "RTO data existed \n";}
                  else {
                    $data_rto=DB::table('associat_users_indics')
                    ->select('associat_users_indics.id','associat_users_indics.target')
                    ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                    ->join('users','users.id','project_has_users.users_id')
                   ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                    ->join('projects','projects.id','project_has_taches.projects_id')
                    ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                    ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                    ->join('programs','programs.id','perimetres.programs_id')
                    ->join('taches','taches.id','programs.taches_id')
                    ->where('taches.tache',$taches->tache)
                    ->where('indicatorsprojs.name',$rto->name)
                    ->where('users.name',$row[6])
                    ->where('projects.project_name',$row[5])
                    ->first();
                   switch($taches->tache):
                     case 'T100':
                      DB::table('indicatorsusers_value')
                      ->insert([ 'associat_users_indic_id' =>$data_rto->id,
                      'target' => $data_rto->target,
                      'value' => $row[30], 
                      'annee'=>$row[0],
                      'semaine'=>$row[1],
                      'mois'=>$row[2],
                      'trimestre'=>$row[3],
                      'created_at'=> Carbon::now(),
                       ]);
                       echo " RTO data inserted successfully \n";
                    break;
                    case 'T200':
                     DB::table('indicatorsusers_value')
                       ->insert([ 'associat_users_indic_id' =>$data_rto->id,
                               'target' => $data_rto->target,
                               'value' =>$row[31],  
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                                ]);
                                echo "RTO data  inserted successfully \n";
              break;
              case 'T300':
                      DB::table('indicatorsusers_value')
                         ->insert([ 'associat_users_indic_id' =>$data_rto->id,
                              'target' => $data_rto->target,
                               'value' => $row[32],  
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                                ]);
                  echo "RTO data inserted successfully \n";
               break;
               default:
                 echo"add code case tache: {condition}  break ;if you added a new tache \n";  
                    endswitch;  
          
              }
            }
          }
            //******************************************************************* */  		
            if (($row[27] > 0) && ($row[28]>0) )
            // Insert hours data after existance test
              { $test_hours=DB::table('users_hours')
                ->join('project_has_users','project_has_users.id','users_hours.users_id')
                ->join('users','users.id','project_has_users.users_id')
                ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                ->join('projects','projects.id','project_has_taches.projects_id')
                  ->where('projects.project_name',$row[5])
                  ->where('users_hours.annee',$row[0])
                  ->where('users_hours.semaine',$row[1])
                  ->where('users_hours.mois',$row[2])
                  ->where('users.name',$row[6])
                  ->count();
           if($test_hours>0)
                  {echo "hours data existed \n ";}
             else {    
                $data=DB::table('project_has_users')
                 ->select('project_has_users.id')
                 ->join('users','users.id','project_has_users.users_id')
                 ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                 ->join('projects','projects.id','project_has_taches.projects_id')
                 ->where('projects.project_name',$row[5])
                 ->where('users.name',$row[6])
                 ->get();
                  // insert hours data
              DB::table('users_hours')->insert([
                      'users_id' =>$data->id,
                      'h_r_rl' => $row[27], 
                      'h_r_est' => $row[28],
                      'h_fact'=>$row[27],
                      'annee'=>$row[0],
                      'semaine'=>$row[1],
                      'mois'=>$row[2],
                      'trimestre'=>$row[3],
                      'created_at'=> Carbon::now(),
                       ]);
                       echo"hours data inserted successfully \n";
                     }
                      // Insert seuil_rentabilite data after existance test
                     $test_seuil_rentabilite=DB::table('indicatorsusers_value')
                      ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                      ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                      ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                      ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                      ->join('projects','projects.id','project_has_taches.projects_id')
                      ->join('users','users.id','project_has_users.users_id')
                      ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                            ->where('users.name',$row[6])
                            ->where('indicatorsprojs.name',$seuil_rentabilite->name)
                            ->where('projects.project_name',$row[5])
                            ->where('indicatorsusers_value.annee',$row[0])
                            ->where('indicatorsusers_value.semaine',$row[1])
                            ->where('indicatorsusers_value.mois',$row[2])
                            ->count();
                            
           if($test_seuil_rentabilite>0)
                    {  echo "Seuil de rentabilité data existed \n";  }
          else{ 
            $data_seuil_rentabilite=DB::table('associat_users_indics')
            ->select('associat_users_indics.id','associat_users_indics.target')
            ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
            ->join('users','users.id','project_has_users.users_id')
            ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
            ->join('projects','projects.id','project_has_taches.projects_id')
            ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
            ->where('indicatorsprojs.name',$seuil_rentabilite->name)
            ->where('users.name',$row[6])
            ->where('projects.project_name',$row[5])
            ->first();
                $val_seuil_rentabilite=(1*8.5)*7;
                DB::table('indicatorsusers_value')
                ->insert([ 'associat_users_indic_id' =>$data_seuil_rentabilite->id,
                         'target' => $data_seuil_rentabilite->target,
                         'value' => $val_seuil_rentabilite, 
                         'annee'=>$row[0],
                         'semaine'=>$row[1],
                         'mois'=>$row[2],
                         'trimestre'=>$row[3],
                         'created_at'=> Carbon::now(),
                         ]);
                  echo"Seuil de rentabilité data inserted successfully \n";
                 } 
                    $test_efficacite=DB::table('indicatorsusers_value')
                    ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                    ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                    ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                    ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                    ->join('projects','projects.id','project_has_taches.projects_id')
                    ->join('users','users.id','project_has_taches.users_id')
                    ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                       ->where('users.name',$row[6])
                       ->where('indicatorsprojs.name',$efficacite->name)
                       ->where('projects.project_name',$row[5])
                       ->where('indicatorsusers_value.annee',$row[0])
                       ->where('indicatorsusers_value.semaine',$row[1])
                       ->where('indicatorsusers_value.mois',$row[2])
                       ->count();
                             
             if($test_efficacite>0)
                      {  echo "efficacite data existed \n";  }
            else{
              $data_efficacite=DB::table('associat_users_indics')
              ->select('associat_users_indics.id','associat_users_indics.target')
              ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
              ->join('users','users.id','project_has_users.users_id')
              ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
              ->where('indicatorsprojs.name',$efficacite->name)
              ->where('users.name',$row[6])
              ->where('projects.project_name',$row[5])
              ->first();
                 $val_efficacite=(((int)$row[28])/((int)$row[27]));
                  DB::table('indicatorsusers_value')
                  ->insert([ 'associat_users_indic_id' =>$data_efficacite->id,
                        'target' => $data_efficacite->target,
                          'value' => $val_efficacite,    
                        'annee'=>$row[0],
                        'semaine'=>$row[1],
                        'mois'=>$row[2],
                        'trimestre'=>$row[3],
                          'created_at'=> Carbon::now(),
                       ]);
                    echo"efficacite data inserted successfully \n";
                   } 
            $test_efficience_estime=DB::table('indicatorsusers_value')
            ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
            ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
            ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
            ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
            ->join('projects','projects.id','project_has_taches.projects_id')
            ->join('users','users.id','project_has_taches.users_id')
            ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
            ->where('users.name',$row[6])
            ->where('indicatorsprojs.name',$efficience_estime->name)
            ->where('projects.project_name',$row[5])
            ->where('indicatorsusers_value.annee',$row[0])
            ->where('indicatorsusers_value.semaine',$row[1])
            ->where('indicatorsusers_value.mois',$row[2])
            ->count();
            if($test_efficience_estime>0)
                   {echo "efficience estimée  data existed \n";}
            else{
              $data_efficience_estime=DB::table('associat_users_indics')
              ->select('associat_users_indics.id','associat_users_indics.target')
              ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
              ->join('users','users.id','project_has_users.users_id')
              ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
              ->where('indicatorsprojs.name',$efficience_estime->name)
              ->where('users.name',$row[6])
              ->where('projects.project_name',$row[5])
              ->first();
               $val_efficience_estime=(((int)$row[28])/ $val_seuil_rentabilite);
                   DB::table('indicatorsusers_value')
                    ->insert(['associat_users_indic_id' =>$data_efficience_estime->id,
                          'target' => $data_efficience_estime->target,
                              'annee'=>$row[0],
                          'semaine'=>$row[1],
                          'mois'=>$row[2],
                          'trimestre'=>$row[3],
                              'created_at'=> Carbon::now(),
                          ]);
                     echo" efficience estimée data inserted successfully \n";
              }
         $test_efficience_facture=DB::table('indicatorsusers_value')
            ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
            ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
            ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
            ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
            ->join('projects','projects.id','project_has_taches.projects_id')
            ->join('users','users.id','project_has_taches.users_id')
            ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
            ->where('users.name',$row[6])
            ->where('indicatorsprojs.name',$efficience_facture->name)
            ->where('projects.project_name',$row[5])
            ->where('indicatorsusers_value.annee',$row[0])
            ->where('indicatorsusers_value.semaine',$row[1])
            ->where('indicatorsusers_value.mois',$row[2])
            ->count();
            if($test_efficience_facture>0)
                   {echo "efficience facturée data existed \n ";}
            else{
              $data_efficience_facture=DB::table('associat_users_indics')
              ->select('associat_users_indics.id','associat_users_indics.target')
              ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
              ->join('users','users.id','project_has_users.users_id')
              ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
              ->join('projects','projects.id','project_has_taches.projects_id')
              ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
              ->where('indicatorsprojs.name',$efficience_facture->name)
              ->where('users.name',$row[6])
              ->where('projects.project_name',$row[5])
              ->first();
               $val_efficience_facture=(((int)$row[29])/ $val_seuil_rentabilite);
                   DB::table('indicatorsusers_value')
                    ->insert(['associat_users_indic_id' =>$data_efficience_facture->id,
                            'target' => $data_efficience_facture->target,
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
              { if ($row[28]=='' OR $row[28]=="/" )
                 { echo " your file missed data in cell "+$row[28] ;  }
                 else if ($row[27]=='' OR $row[27]=="/")
                 { echo " your file missed data in cell "+$row[27] ;  }
                
              }
               if ($row[29]>0 && $row[29]!="/")
              { $test_production=DB::table('indicatorsusers_value')
                ->select('indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois','associat_users_indics.*')
                ->join('associat_users_indics','associat_users_indics.id','indicatorsusers_value.associat_users_indic_id')
                ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                ->join('projects','projects.id','project_has_taches.projects_id')
                ->join('users','users.id','project_has_taches.users_id')
                ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
               ->where('users.name',$row[6])
               ->where('indicatorsprojs.name',$production->name)
               ->where('projects.project_name',$row[5])
               ->where('indicatorsusers_value.annee',$row[0])
               ->where('indicatorsusers_value.semaine',$row[1])
               ->where('indicatorsusers_value.mois',$row[2])
               ->count();
               if($test_production>0)
                      {echo " PRODUCTION data existed \n ";} 
               else{
                $data_production=DB::table('associat_users_indics')
                ->select('associat_users_indics.id','associat_users_indics.target')
                ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                ->join('users','users.id','project_has_users.users_id')
                ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                ->join('projects','projects.id','project_has_taches.projects_id')
                ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                ->where('indicatorsprojs.name',$production->name)
                ->where('users.name',$row[6])
                ->where('projects.project_name',$row[5])
                ->first();
                    DB::table('indicatorsusers_value')
                     ->insert(['associat_users_indic_id' =>$data_production->id,
                              'target' => $data_seuil_rentabilite->target,
                               'value' => $row[29], 
                               'annee'=>$row[0],
                               'semaine'=>$row[1],
                               'mois'=>$row[2],
                               'trimestre'=>$row[3],
                               'created_at'=> Carbon::now(),
                              ]);
                        echo" PRODUCTION data inserted successfully \n";
                 } 
          } 
       }
          
    } 
 }