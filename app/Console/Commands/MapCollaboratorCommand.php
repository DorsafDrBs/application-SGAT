<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MapCollaboratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapcollaborator:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert indicators data of users in map nantes ';

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
    { //take the file path
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
        $rows = $sheet->rangeToArray('B1:' .$highestColumn.$highestRow, NULL, TRUE, TRUE);
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
                          //echo "$value $collvl1 $collvl2 $collvl3 $collvl4 ";
                        $verif=DB::table('associat_users_indics')
                        ->join('project_has_users','project_has_users.id','associat_users_indics.users_id')
                        ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
                        ->join('projects','projects.id','project_has_taches.project_id')
                        ->join('users','users.id','project_has_taches.users_id')
                        ->join('indicatorsprojs','indicatorsprojs.id','associat_users_indics.indic_id')
                        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                        ->join('programs','programs.id','perimetres.programs_id')
                        ->join('taches','taches.id','programs.taches_id')
                        ->join('units','units.id','associat_indics.unit_id')
                        ->where('users.name',$row[6])
                        ->where('indicatorsprojs.name',$collvl1)
                        ->where('projects.project_name',$row[5])
                        ->where('programs.program',$collvl2)
                        ->where('taches.tache',$collvl4)
                        ->where('perimetres.perimetre',$collvl3)
                        ->get();
                        
                    foreach ($verif as $v) 
                    
				echo "Semaine:"; print_r($row[1]);echo "\n";
				print_r($verif);
				echo "value:"; print_r($value);
                     DB::table('indicatorsproj_value')
                     ->insert([ 'associat_users_indic_id' =>$verif->id,
                                'target' => $verif->target,
                                'value' => $value,  
                                'annee'=>$row[0],
                                'semaine'=>$row[1],
                                'mois'=>$row[2],
                                'trimestre'=>$row[3],
                                 'created_at'=> Carbon::now(),
                              ]);
                          echo "$verif data inserted successfully \n";
                 
             
                      
                        }
                      
                    }
                }
            } 
          } 
         }
        }