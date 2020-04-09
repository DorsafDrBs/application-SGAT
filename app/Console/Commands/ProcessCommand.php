<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calculate  process data from projects data and insert them ';

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
        //process's list that has projects 
        $processes= DB::table('processes')
        ->join('projects','processes.id','projects.proc_id')
        ->select('processes.id','processes.name')
        ->distinct()
        ->get();
       foreach($processes as $process) 
       {
        //indicator's list in process's list 
        $indicators=DB::table('indicatorsprocs')
        ->select('id','name','target')
        ->where('process_id',$process->id)
        ->distinct()
        ->get();
        $processdata=array("name" => $process->name, "indics" => array());	
        $indics=array();
        foreach($indicators as $indicator)
       {
        $moyenne=0;
        $somme=0;
         $cpt=0;
      for($i=1;$i<=53;$i++)
     {  //project's list  in process and  which has  the same indicator of process 
         $projects=DB::table('projects')
         ->select('projects.id','projects.project_name','indicatorsproj_value.value','indicatorsproj_value.trimestre','indicatorsproj_value.semaine','indicatorsproj_value.mois','indicatorsproj_value.annee')
         ->where('proc_id',$process->id)
         ->join('indicatorsproj_value','indicatorsproj_value.projects_id','projects.id')
         ->join('indicatorsprojs','indicatorsprojs.id','indicatorsproj_value.indicatorsproj_id')
         ->where('indicatorsprojs.name', $indicator->name)
         ->where('indicatorsproj_value.semaine',$i)
         ->get();
      // dd($projects);
      $nbprojet=$projects->count();
      //dd($nbprojet);
      $somme= $projects->sum('value');
      foreach($projects as $project)
      {
   // dd($somme);
 $cpt++;
      //  $indics[]=array("cpt" => $cpt,"name"=>$indicator->name,"projects"=>$projects->toArray());  
      //  dd($indics);
          if($cpt%$nbprojet==0)
            { 
          $moyenne=number_format (((($somme/$nbprojet) *100)/100), 2 );
               //dd($moyenne);
            $taken=DB::table('indicatorsproc_value')
            ->select('value')
            ->where('semaine',$i)
            ->where('semaine',$project->semaine)
            ->where('trimestre',$project->trimestre)
            ->where('mois',$project->mois)
            ->where('annee',$project->annee)
            ->where('process_id',$process->id)
            ->where('indic_id', $indicator->id)
            ->get();
            $test_existance=$taken->count();
 if ($test_existance>0)            
  {
  echo "data existed"; 
  }//test existance
else {
           // dd($moyenne);
 DB::table('indicatorsproc_value')
 ->insert(['target' => $indicator->target,
           'value' => $moyenne, 
       'indic_id'=>$indicator->id,
       'process_id'=>$process->id,
       'annee'=>$project->annee,
       'semaine'=>$project->semaine,
       'mois'=>$project->mois,
       'trimestre'=>$project->trimestre,
       'created_at'=> Carbon::now(),
      ]);
     echo  "data inserted successfully \n";
           
            $somme=0;
            $moyenne=0;
        }
    }    // if modulo
 } //foreach projects
        } //Boucle for i 
    
     }//foreach indic
     
     $processdata['indics']=$indics;
     $data[]=$processdata;
    } //foreach proc
    }//handle
}
