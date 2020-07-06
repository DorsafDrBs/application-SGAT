<?php

namespace App\Http\Controllers;
use App\projects;
use App\process;
use App\indicatorsproj;
use App\taches;
use App\unit;
use App\perimetre;
use App\programs;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\associat_taches;
use Spatie\Permission\Models\Permission;

class testController extends Controller
{
      
    public function index()
    {
    $projects=projects::all();
    
    $pjannee=DB::table('indicatorsproj_value')
    ->select('annee')
    ->distinct()
    ->get();
 
    $pjsemaine=DB::table('semaine')
    ->select('semaine','id')
    ->distinct()
    ->get();
     //***************************afficher les graphes des heures des projets */
        // liste des projects qui existes dans les indicatorsproj_value (id, name)
        $projectsfohours=DB::table('project_has_taches')
        ->select('project_has_taches.id', 'projects.project_name','taches.tache','perimetres.perimetre','programs.program')
        ->join('projects', 'project_has_taches.projects_id', '=', 'projects.id')
        ->select('project_has_taches.id', 'projects.project_name','taches.tache','perimetres.perimetre','programs.program')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','taches.id','programs.taches_id')
        ->distinct()
        ->get();
        
        $idh=1;
        foreach ($projectsfohours as $project)
               {
                   // liste des indicators qui existes pour cet project (id, name)
                   $hoursweeks=DB::table('hours')
                   ->select('id','semaine','mois','trimestre','annee')
                   ->where('project_id', $project->id)
                   ->distinct()
                   ->get();
       
                   // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
                   $objpro=array("id"=>$project->id,"name" => $project->project_name,"tache"=>$project->tache,"program"=>$project->program,"perimetre"=>$project->perimetre, "weeks" => array());
                   $weeks=array();
                   foreach ($hoursweeks as $week)
                   {
                       // selectionner les dates (mois) avec leurs valeurs & target.., qui sont dans cet $ind et dans cet $project
                       $months=DB::table('hours')
                       ->select('hours.*','projects.project_name','taches.tache','perimetres.perimetre','programs.program')
                       ->join('project_has_taches', 'hours.project_id', '=', 'project_has_taches.id')
                       ->join('projects','projects.id','project_has_taches.projects_id')
                       ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                       ->join('programs','programs.id','perimetres.programs_id')
                       ->join('taches','taches.id','programs.taches_id')
                    
                       
                       ->where('project_id', $project->id)
                       ->orderBy('annee')
                       ->orderBy('semaine')
                       ->orderBy('mois')
                       ->get();
                                       
                       // pk "idg" dans indic? car chaque graphe est un indicator, il faut identifier chaque indicator ajouté
                      $weeks[]=array("idh" => $idh,"semaine" => $week->semaine,"mois" => $week->mois,"annee" => $week->annee,"months"=>$months->toArray());
                       
                       $idh++;
                   }
                   $objpro['weeks']=$weeks;
                   $datah[]=$objpro;
                 }  //dd($datah);
        return view('test',compact('datah','projects','pjannee','pjsemaine'));
    
    }

    public function store(Request $request)
    {
        request()->validate([
            'proc_id' => 'required',
            'project_name' => 'required',
            'indic_id' =>'required|integer',
            'unit_id '=>'required|integer',
            'target_general'=>'required|integer',
            'operator_cp'=> 'required',
            'tache'=> 'required',
            'program'=> 'required',
            'perimetre'=> 'required',


        ]);

      
       $tacheId = $request->input('tache');
       dd($tacheId);
       $tache=taches::find($tacheId);
       $programId = $request->input('program');
       $program=programs::find($programId);
       $perimetreId = $request->input('perimetre');
       $perimetre=perimetre::find($perimetreId);
       
       $alreadyExistingAssOcTache = associat_taches::where([
        ['tache_id', '=', $tache],
        ['program_id', '=', $program],
        ['perimetre_id', '=', $perimetre],
    ])->get();
    if ($alreadyExistingAssOcTache->isEmpty()) {
        $associat_taches = new associat_taches(['tache_id'=>$tache,'perimetre_id'=>$perimetre,'program_id'=>$program,'created_at'=> Carbon::now()]);
      //  dd($associat_taches);
        $associat_taches->save();

    }
        return redirect()->route('projects.index')
                        ->with('success','project created successfully.');
    }


}
