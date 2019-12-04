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

include public_path().'/PHPExcel/PHPExcel/IOFactory.php';

class IndicatorsController extends Controller
{ public function __construct()
  {
   $this->middleware('permission:indic-proc-list');
  $this->middleware('permission:indic-proc-create');
  $this->middleware('permission:indic-proc-edit',['only' => ['edit','update']]);
  $this->middleware('permission:indic-proc-delete', ['only' => ['destroy']]);
  }
    public function index()
    {
     
      $indicproj=indicatorsproj::orderByRaw('created_at','desc')
      ->paginate(5);
      $indicusers=indicatorsusers::orderByRaw('created_at','desc')
      ->paginate(5);
      return view('indicators.index',compact('indicproj','indicusers'))
       ->with('i', (request()->input('page', 1) - 1) * 5);
    }
	
  
	
/**

         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request,indicatorsproc $indicatorsproc)
        {
			switch ($request->input('action')) {
			case 'save':
				// Save data
				
            request()->validate([
                'name' => 'required',
                'detail' => 'required',
            ]);
    
    
            indicatorsproc::create($request->all());
    
    
            return redirect()->route('indicators.index')
							->with('success','indicateur  cree avec succes.');
						break;
						case 'update':
							// update data
							request()->validate([
								'name' => 'required',
								'detail' => 'required',
							
							]);
					
					
							$process->update($request->all());
					
					
							return redirect()->route('indicators.index')
											->with('success','indicators updated successfully');
							break;}
				
        }
    
		
	
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\process  $process
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(process $process)
		{
			$process->delete();
	
	
			return redirect()->route('process.index')
							->with('success','process deleted successfully');
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
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		// Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		// Read all rows of data into an array

		$rows = $sheet->rangeToArray('A2:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

		// Loop through each row of the worksheet in turn
		foreach ($rows as $row){ 
      // ** Show row data array 
      
      $process=DB::table('processes')->where('name',$row[3])->first();
      $indics=DB::table('indicatorsprocs')->where('name',$row[0])->select('id','name')->first();
   
            DB::table('indicatorsproc_value')->insert([
             'value' => $row[1], 
             'target' => $row[2],
             'indic_id' =>$indics->id,
              'process_id' =>$process->id,
              'created_at'=>$row[4]
              ]);
         
    }
    return redirect()->route('indicators.index')
            ->with('success','Les données a été enregistrés avec succées.');

}


    public function importerExcelprojet(Request $request)
    {
        
      // Include PHPExcel_IOFactory (EXCEL)
   
		$inputFileName = Input::file('import_file')->getRealPath();

		// Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		// Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		// Read all rows of data into an array

		$rows = $sheet->rangeToArray('B5:'.$highestColumn.$highestRow, NULL, TRUE, TRUE);

		// Loop through each row of the worksheet in turn
		foreach ($rows as $row){ 
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
			  DB::table('indicatorsproj_value')->insert([
				'projects_id' =>$projects->id,
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

	DB::table('indicatorsproj_value')->insert([
	'projects_id' =>$projects->id,
	 'value' => $efficacite, 
	 'target' => '97',
'indicatorsproj_id'=>$indicator3->id,
	  'created_at'=>$row[0],
	  ]);
	  DB::table('indicatorsproj_value')->insert([
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
