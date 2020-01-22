<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\indicatorsproc;
use App\indicatorsproj;
use App\indicatorsusers;
use DB;
use PHPExcel_IOFactory;
use Illuminate\Console\Command;
use Carbon\Carbon;
  /** PHPExcel_IOFactory */
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

		// Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
        $highestRow= $sheet->getHighestRow();
		// Read all rows of data into an array

		$rows = $sheet->rangeToArray('B5:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

		// Loop through each row of the worksheet in turn
 foreach ($rows as $row)
 {  
			// ** Show row data array 
            $proj=DB::table('projects')->where('project_name',$row[5])->first();
            $otd=DB::table('indicatorsprojs')->where('name','OTD')->first();
			$rft=DB::table('indicatorsprojs')->where('name','RFT')->first();
			$efficacite=DB::table('indicatorsprojs')->where('name','Efficacité')->first();
			$efficience=DB::table('indicatorsprojs')->where('name','Efficience')->first();
   // insert hours
 
   if($row[6] > 0){
   
         $val_otd=(((int)$row[6]-(int)$row[8])/(int)$row[6])*100;
         $val_rft=(((int)$row[6]-(int)$row[7])/(int)$row[6])*100;

      DB::table('indicatorsproj_value')->insert([
      
         'value' => $val_otd, 
         'target' => '95',
         'indicatorsproj_id'=>$otd->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
         'projects_id' =>$proj->id,

         'created_at'=> Carbon::now(),
		  ]);
	  DB::table('indicatorsproj_value')
		 ->insert(['projects_id' =>$proj->id,
		 'value' => $val_rft, 
		 'target' => '95',
         'indicatorsproj_id'=>$rft->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
		 'created_at'=> Carbon::now(),
		  ]);
	}
			  		
    else if ($row[9] > 0 && $row[10] > 0)
    {
        DB::table('hours')->insert([
            'project_id' =>$proj->id,
            'h_r_rl' => '218', 
            'h_r_est' => '218',
            'h_fact'=>'219',
            'annee'=>$row[0],
            'semaine'=>$row[1],
            'mois'=>$row[2],
            'trimestre'=>$row[3],
            'created_at'=> Carbon::now(),
             ]);
	   $efficacite=(((int)$row[9])/42)*100;
	
    	$efficience=(((int)$row[10])/42)*100;

		DB::table('indicatorsproj_value')
		->insert([ 'projects_id' =>$proj->id,
	     'value' => $efficacite, 
	     'target' => '97',
         'indicatorsproj_id'=>$efficacite->id,
         'annee'=>$row[0],
         'semaine'=>$row[1],
         'mois'=>$row[2],
         'trimestre'=>$row[3],
	     'created_at'=> Carbon::now(),
	      ]);
	  DB::table('indicatorsproj_value')
	     ->insert(['projects_id' =>$proj->id,
		  'value' => $efficience, 
		  'target' => '97',
          'indicatorsproj_id'=>$efficience->id,
          'annee'=>$row[0],
          'semaine'=>$row[1],
          'mois'=>$row[2],
          'trimestre'=>$row[3],
		  'created_at'=> Carbon::now(),
		   ]);
	}
 }
          $this->info('data inserted successfully');
    }
}
