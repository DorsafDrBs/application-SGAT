<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\indicatorsproc;
use App\indicatorsproj;
use App\indicatorsusers;
use DB;
use PHPExcel_IOFactory;
use Carbon\Carbon;
include public_path().'/PHPExcel/PHPExcel/IOFactory.php';

class IndicatorsController extends Controller
{ 
	public function __construct()
  {
   $this->middleware('permission:indic-proc-list');
  $this->middleware('permission:indic-proc-create');
  $this->middleware('permission:indic-proc-edit',['only' => ['edit','update']]);
  $this->middleware('permission:indic-proc-delete', ['only' => ['destroy']]);
  $this->middleware('permission:indic-proj-list');
  $this->middleware('permission:indic-proj-create');
  $this->middleware('permission:indic-proj-edit',['only' => ['edit','update']]);
  $this->middleware('permission:indic-proj-delete', ['only' => ['destroy']]);
  $this->middleware('permission:indic-user-list');
  $this->middleware('permission:indic-user-create');
  $this->middleware('permission:indic-user-edit',['only' => ['edit','update']]);
  $this->middleware('permission:indic-user-delete', ['only' => ['destroy']]);
  }
 public function index()
{
   return view('indicators.index');
}

public function importExcel(Request $request)
{
        
      // Include PHPExcel_IOFactory (EXCEL)
   
		$inputFileName = Input::file('import_file')->getRealPath();

		// Read your Excel workbook
		try {
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

		// Read all rows of data into an array

		$rows = $sheet->rangeToArray('B7:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

		// Loop through each row of the worksheet in turn
		foreach ($rows as $row){ 
      // ** Show row data array 
      
      $process=DB::table('processes')->where('name',$row[4])->first();
	  $indics=DB::table('indicatorsprocs')->where('detail',$row[5])->first();
	  //dd($indics->id);
	  $test=DB::table('indicatorsproc_value')
	  ->select('indicatorsproc_value.process_id','indicatorsproc_value.annee','indicatorsproc_value.semaine','indicatorsproc_value.mois')
	  ->join('processes','processes.id','indicatorsproc_value.process_id')
	  ->join('indicatorsprocs','indicatorsprocs.id','indicatorsproc_value.indic_id')
	  ->where('indicatorsprocs.detail',$row[5])
	  ->where('processes.name',$row[4])
	  ->where('indicatorsproc_value.annee',$row[0])
	  ->where('indicatorsproc_value.semaine',$row[1])
	  ->where('indicatorsproc_value.mois',$row[2])
	  ->count();
	  //dd($test);
	  if($test >0)
		   {   return redirect()->route('indicators.index')
            ->with('success','Data existed.');}
	  else { 

			DB::table('indicatorsproc_value')
			->insert([ 'process_id' =>$process->id,
			  'indic_id' =>$indics->id,
			  'value' => $row[6], 
              'target' => $row[7],
              'annee'=>$row[0],
              'semaine'=>$row[1],
              'mois'=>$row[2],
              'trimestre'=>$row[3],
		      'created_at'=> Carbon::now(),
              ]);
	  }
    }
    return redirect()->route('indicators.index')
            ->with('success','Les données a été enregistrés avec succées.');

}


public function importerExcelprojet(Request $request)
{
        
      // Include PHPExcel_IOFactory (EXCEL)
   
		$inputFileName = Input::file('import_file')->getRealPath();

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

		// Read all rows of data into an array

		$rows = $sheet->rangeToArray('B5:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

		// Loop through each row of the worksheet in turn
 foreach ($rows as $row)
 { 
			// ** Show row data array 
            $projects=DB::table('projects')->where('project_name',$row[2])->first();
            $indicator=DB::table('indicatorsprojs')->where('name','OTD')->first();
			$indicator2=DB::table('indicatorsprojs')->where('name','RFT')->first();
			$indicator3=DB::table('indicatorsprojs')->where('name','Efficacité')->first();
			$indicator4=DB::table('indicatorsprojs')->where('name','Efficience')->first();

   if($row[3] > 0){
   
         $val_otd=(((int)$row[3]-(int)$row[6])/(int)$row[3])*100;
         $val_rft=(((int)$row[3]-(int)$row[4])/(int)$row[3])*100;

      DB::table('indicatorsproj_value')->insert([
         'projects_id' =>$projects->id,
         'value' => $val_otd, 
         'target' => $row[4],
         'indicatorsproj_id'=>$indicator->id,
         'created_at'=>$row[0],
		  ]);
	  DB::table('indicatorsproj_value')
		 ->insert(['projects_id' =>$projects->id,
		 'value' => $val_rft, 
		 'target' => $row[5],
		 'indicatorsproj_id'=>$indicator2->id,
		 'created_at'=>$row[0],
		  ]);
	}
			  		
    else if ($row[8] > 0)
    {
   
	   $efficacite=(((int)$row[8])/42)*100;
	
    	$efficience=(((int)$row[9])/42)*100;

		DB::table('indicatorsproj_value')
		->insert([ 'projects_id' =>$projects->id,
	     'value' => $efficacite, 
	     'target' => '97',
         'indicatorsproj_id'=>$indicator3->id,
	     'created_at'=>$row[0],
	      ]);
	  DB::table('indicatorsproj_value')
	     ->insert(['projects_id' =>$projects->id,
		  'value' => $efficience, 
		  'target' => '97',
	      'indicatorsproj_id'=>$indicator4->id,
		  'created_at'=>$row[0],
		  ]);
	}
 }
    return redirect()->route('indicators.index')
    ->with('success','Les données a été enregistrés avec succées.');
}

public function importerExcelcollabo(Request $request)
{
	
  // Include PHPExcel_IOFactory (EXCEL)

	$inputFileName = Input::file('import_file')->getRealPath();

	// Read your Excel workbook
	try {
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

	// Read all rows of data into an array

	$rows = $sheet->rangeToArray('B5:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

	// Loop through each row of the worksheet in turn
 foreach ($rows as $row)
 { 
		// ** Show row data array 
		$users=DB::table('users')->where('name',$row[2])->first();
		$projects=DB::table('projects')->where('project_name',$row[2])->first();
		$indicator=DB::table('indicatorusers')->where('name','OTD')->first();
		$indicator2=DB::table('indicatorusers')->where('name','RFT')->first();
		$indicator3=DB::table('indicatorusers')->where('name','Efficacité')->first();
		$indicator4=DB::table('indicatorusers')->where('name','Efficience')->first();

    if($row[3] > 0){

		$val_otd=(((int)$row[3]-(int)$row[6])/(int)$row[3])*100;
		$val_rft=(((int)$row[3]-(int)$row[4])/(int)$row[3])*100;

	  DB::table('indicatorsproj_indicatorsusers_valuevalue')
		   ->insert(['projects_id' =>$projects->id,
		  'value' => $val_otd, 
		  'target' => $row[4],
          'indicatorsproj_id'=>$indicator->id,
		  'created_at'=>$row[0],
		  ]);
	 DB::table('indicatorsusers_value')
		   ->insert(['projects_id' =>$projects->id,
		  'value' => $val_rft, 
		  'target' => $row[5],
	      'indicatorsproj_id'=>$indicator2->id,
		  'created_at'=>$row[0],
		 ]);
	}
				  
else if ($row[8] > 0)
   {

     $efficacite=(((int)$row[8])/42)*100;

     $efficience=(((int)$row[9])/42)*100;

     DB::table('indicatorsusers_value')
         ->insert(['users_id' =>$users->id,
	        'projects_id' =>$projects->id,
            'value' => $efficacite, 
            'target' => '97',
            'indicatorsproj_id'=>$indicator3->id,
            'created_at'=>$row[0],
            ]);
     DB::table('indicatorsusers_value') 
         ->insert(['users_id' =>$users->id,
	        'projects_id' =>$projects->id,
	        'value' => $efficience, 
	        'target' => '97',
            'indicatorsproj_id'=>$indicator4->id,
	        'created_at'=>$row[0],
	         ]);
    }
}
return redirect()->route('indicators.index')
->with('success','Les données a été enregistrés avec succées.');
}
}
