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
    protected $description = 'inserted collaborator data';

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
       // Include PHPExcel_IOFactory (EXCEL)
 

		$inputFileName = 'C:\xampp\htdocs\laravel\application-SGAT\public\inputExcel\Input_DATA_File.xlsx ';

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
$rows = $sheet->rangeToArray('B5:' .$highestColumn.$highestRow, NULL, TRUE, TRUE);
     foreach($rows as $row)
        {	
            // Loop through each row of the worksheet in turn
          
            // ** Show row data array 
            $users=DB::table('users')->where('name',$row[6])->first();
            $proj=DB::table('projects')->where('project_name',$row[5])->first();
            $otd=DB::table('indicatorusers')->where('name','OTD')->first();
			$rft=DB::table('indicatorusers')->where('name','RFT')->first();
			$efficacite=DB::table('indicatorusers')->where('name','Efficacité')->first();
			$efficience=DB::table('indicatorusers')->where('name','Efficience')->first();
          
    
   if($row[7] > 0)
 {
      $test_otd=DB::table('indicatorsusers_value')
             ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois')
             ->join('projects','projects.id','indicatorsusers_value.projects_id')
             ->join('indicatorusers','indicatorusers.id','indicatorsusers_value.indicatorusers_id')
             ->where('indicatorusers.name',$otd->name)
             ->where('projects.project_name',$row[5])
             ->where('indicatorsusers_value.annee',$row[0])
             ->where('indicatorsusers_value.semaine',$row[1])
             ->where('indicatorsusers_value.mois',$row[2])
             ->count();
  if($test_otd>0)
        {echo "otd data existed";}
  else {
         $val_otd=(((int)$row[6]-(int)$row[8])/(int)$row[6])*100;
        
         DB::table('indicatorsusers_value')->insert([
         'value' => $val_otd, 
         'target' => '95',
         'indicatorusers_id'=>$otd->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
         'projects_id' =>$proj->id,
         'created_at'=> Carbon::now(),
          ]);
          $this->info('otd data inserted successfully');
       }
          $test_rft=DB::table('indicatorsusers_value')
          ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois')
          ->join('projects','projects.id','indicatorsusers_value.projects_id')
          ->join('indicatorusers','indicatorusers.id','indicatorsusers_value.indicatorusers_id')
          ->where('indicatorusers.name',$rft->name)
          ->where('projects.project_name',$row[5])
          ->where('indicatorsusers_value.annee',$row[0])
          ->where('indicatorsusers_value.semaine',$row[1])
          ->where('indicatorsusers_value.mois',$row[2])
          ->count();
  if($test_rft>0)
       {echo "rft data existed";}
  else { 
         $val_rft=(((int)$row[6]-(int)$row[7])/(int)$row[6])*100;
	     DB::table('indicatorsusers_value')
		 ->insert(['projects_id' =>$proj->id,
		 'value' => $val_rft, 
		 'target' => '95',
         'indicatorusers_id'=>$rft->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
		 'created_at'=> Carbon::now(),
          ]);
          $this->info('rft data inserted successfully');
	    }
   }		  		
  if ($row[9] > 0)
        { $test_hours=DB::table('hours')
            ->join('projects','projects.id','hours.project_id')
            ->where('projects.project_name',$row[5])
            ->where('hours.annee',$row[0])
            ->where('hours.semaine',$row[1])
            ->where('hours.mois',$row[2])
            ->count();
            if($test_hours>0)
            {echo "hours data existed";}
       else { 
            // insert hours
               DB::table('hours')->insert([
                'project_id' =>$proj->id,
                'h_r_rl' => $row[9], 
                'h_r_est' => $row[10],
                'h_fact'=>$row[11],
                'annee'=>$row[0],
                'semaine'=>$row[1],
                'mois'=>$row[2],
                'trimestre'=>$row[3],
                'created_at'=> Carbon::now(),
                 ]);
                 $this->info('hours data inserted successfully');
               }
          $test_efficacite=DB::table('indicatorsusers_value')
             ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois')
             ->join('projects','projects.id','indicatorsusers_value.projects_id')
             ->join('indicatorusers','indicatorusers.id','indicatorsusers_value.indicatorusers_id')
             ->where('indicatorusers.name',$efficacite->name)
             ->where('projects.project_name',$row[5])
             ->where('indicatorsusers_value.annee',$row[0])
             ->where('indicatorsusers_value.semaine',$row[1])
             ->where('indicatorsusers_value.mois',$row[2])
             ->count();
   if($test_efficacite>0)
            {  echo "efficacite data existed";  }
  else{
	   $val_efficacite=(((int)$row[9])/42)*100;
		DB::table('indicatorsusers_value')
		->insert([ 'projects_id' =>$proj->id,
	     'value' => $val_efficacite, 
	     'target' => '97',
         'indicatorusers_id'=>$efficacite->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
	     'created_at'=> Carbon::now(),
          ]);
          $this->info('efficacite data inserted successfully');
         } 
  $test_efficience=DB::table('indicatorsusers_value')
  ->select('indicatorsusers_value.projects_id','indicatorsusers_value.annee','indicatorsusers_value.semaine','indicatorsusers_value.mois')
  ->join('projects','projects.id','indicatorsusers_value.projects_id')
  ->join('indicatorusers','indicatorusers.id','indicatorsusers_value.indicatorusers_id')
  ->where('indicatorusers.name',$efficience->name)
  ->where('projects.project_name',$row[5])
  ->where('indicatorsusers_value.annee',$row[0])
  ->where('indicatorsusers_value.semaine',$row[1])
  ->where('indicatorsusers_value.mois',$row[2])
  ->count();
  if($test_efficience>0)
         {echo "data existed";}
  else{
     $val_efficience=(((int)$row[10])/42)*100;
	     DB::table('indicatorsusers_value')
	      ->insert(['projects_id' =>$proj->id,
		  'value' => $val_efficience, 
		  'target' => '97',
          'indicatorusers_id'=>$efficience->id,
          'annee'=>$row[0],
          'semaine'=>$row[1],
          'mois'=>$row[2],
          'trimestre'=>$row[3],
		  'created_at'=> Carbon::now(),
           ]);
           $this->info(' efficience data inserted successfully');
    }
	}
 
         }

    }
}
