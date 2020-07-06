<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\indicatorsproj;
use DB;
use PHPExcel_IOFactory;
use Carbon\Carbon;
 //Include PHPExcel_IOFactory (EXCEL);
//include public_path().'/PHPExcel/PHPExcel/IOFactory.php';
class MapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert indicators data of projects map nantes ';

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
$rows = $sheet->rangeToArray('B4:' .$highestColumn.$highestRow, NULL, TRUE, TRUE);
     // Loop through each row of the worksheet in turnz
      // ** Show row data array 
      $ligne=1; 
     
$bigcols = ["TTA","OTD", "RFT"];

$ind2cols = [];
$col2inds = [];
$anneefound = false;
$firstline = true;
foreach ($rows as $i => $row) {
	if (!$anneefound) {
		# Headers rows
		$lastkey = "";
		foreach ($row as $j => $cell) {
			$cell = trim($cell);
			if (!empty($cell))
				$lastkey = $cell;   

			if (!empty($lastkey)) {
				if (!array_key_exists($j, $ind2cols))
					$ind2cols[$j] = [];
				if (!in_array($lastkey, $ind2cols[$j]))
					$ind2cols[$j][] = $lastkey;
				
				if ($firstline) {
					if (!array_key_exists($lastkey, $col2inds))
						$col2inds[$lastkey] = [];
					$col2inds[$lastkey][] = $j;
				}
			
                if ($lastkey=="Année")
                {	$anneefound = true;
                }  
			}
		}
		
		if ($firstline && !empty($lastkey))
			$firstline = false;

	} else {
		# Data rows
		foreach ($bigcols as $bigcol) {
			foreach ($col2inds[$bigcol] as $j) {
				$value = $row[$j];
				$collvl1 = $ind2cols[$j][0];
				$collvl2 = $ind2cols[$j][1];
				$collvl3 = $ind2cols[$j][2];
				$collvl4 = $ind2cols[$j][3];
				if(!empty($value))
                
             {
				 // echo "$value $collvl1 $collvl2 $collvl3 $collvl4 ";
				$verif=DB::table('associat_indics')
				->select('associat_indics.id','projects.project_name','taches.tache','programs.program','perimetres.perimetre','indicatorsprojs.name','associat_indics.target')
				->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
				->join('units','units.id','associat_indics.unit_id')
				->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
				->join('projects','projects.id','project_has_taches.projects_id')
				->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
				->join('programs','programs.id','perimetres.programs_id')
				->join('taches','taches.id','programs.taches_id')
				
				->where('indicatorsprojs.name',$collvl1)
				->where('projects.project_name',$row[5])
				->where('programs.program',$collvl2)
				->where('taches.tache',$collvl4)
				->where('perimetres.perimetre',$collvl3)
				->get();
			
			foreach ($verif as $v) 
			{ 
				echo "Semaine:"; print_r($row[1]);echo "\n";
				print_r($verif);
				echo "value:"; print_r($value);
		//	echo "$value $collvl1 $collvl2 $collvl3 $collvl4 \n";
			 DB::table('indicatorsproj_value')
			 ->insert([ 'associat_indic_id' =>$v->id,
						'target' => $v->target,
						'value' => $value,  
						'annee'=>$row[0],
						'semaine'=>$row[1],
						'mois'=>$row[2],
						'trimestre'=>$row[3],
						 'created_at'=> Carbon::now(),
					  ]);
				  echo " data inserted successfully \n";
		 
			}
	  		
				}
              
			}
        }
	} 
  } 
 }
}