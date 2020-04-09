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
    { //***************************afficher les graphes des heures des projets */
        // liste des projects qui existes dans les indicatorsproj_value (id, name)
        $projects=DB::table('hours')
        ->join('projects', 'hours.project_id', '=', 'projects.id')
        ->select('projects.id', 'projects.project_name')
        ->distinct()
        ->get();
        $idh=1;
        foreach ($projects as $project)
               {
                   // liste des indicators qui existes pour cet project (id, name)
                   $hours=DB::table('hours')
                   ->select('id','semaine')
                   ->where('hours.project_id', $project->id)
                   ->distinct()
                   ->get();
       
                   // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
                   $objpro=array("id"=>$project->id,"name" => $project->project_name, "indics" => array());
                   $indics=array();
                   foreach ($hours as $hour)
                   {
                       // selectionner les dates (mois) avec leurs valeurs & target.., qui sont dans cet $ind et dans cet $project
                       $months=DB::table('hours')
                       ->where('id', $hour->id)
                       ->where('project_id', $project->id)
                       ->orderBy('annee')
                       ->orderBy('semaine')
                       ->orderBy('mois')
                       ->get();
                                       
                       // pk "idg" dans indic? car chaque graphe est un indicator, il faut identifier chaque indicator ajouté
                      $indics[]=array("idh" => $idh,"semaine" => $hour->semaine,"months"=>$months->toArray());
                       
                       $idh++;
                   }
                   $objpro['indics']=$indics;
                   $datah[]=$objpro;
             // dd($datah);
               }
        return view('test',compact('datah'));
    
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
