<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\indicatorsproc;
use App\indicatorsproj;
use Carbon\Carbon;
use App\Process;
use App\Projects;
use App\taches;
use App\programs;
use App\perimetre;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:manager', ['only' => ['manager']]);
    $this->middleware('permission:home-index', ['only' => ['index']]);
  // $this->middleware('permission:Home-cartographie');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
       
    
    public function parameters()
    {
        return view('parameters');
    }
    public function cartographie()
    {
        return view('cartographie');
    }
    public function index(Request $request)
    {
       //****************************** Filter ***************************** */
       
   $procs=DB::table('processes')->select('id','name')->get();
   $semaines=DB::table('indicatorsproc_value')->select('semaine')->orderBy('semaine')->distinct()->get();
   $mois=DB::table('indicatorsproc_value')->select('mois')->orderBy('mois')->distinct()->get();
   $annes=DB::table('indicatorsproc_value')->select('annee')->orderBy('annee')->distinct()->get();
   $fproc=$request->input("fproc") ?: $procs->pluck('id')->toArray();
   $fsemaine=$request->input("fsemaine") ?: $semaines->pluck('semaine')->toArray();
   $fmois=$request->input("fmois") ?: $mois->pluck('mois')->toArray();
   $fanne=$request->input("fanne") ?: $annes->pluck('annee')->toArray();
  
   $proc=DB::table('processes')->select('id','name')->find($fproc);

   $data=array("name" => $proc->name, "indics" => array());	
  // $unit=DB::table('unit')->select('id','name');
 
   $rows=DB::table('indicatorsprocs')
           ->join('indicatorsproc_value','indicatorsprocs.id','indicatorsproc_value.indic_id')
      
           ->select('indicatorsprocs.id','indicatorsprocs.detail','indicatorsprocs.target','indicatorsprocs.periodicity','indicatorsprocs.orange',
           'indicatorsprocs.operator_cp','indicatorsprocs.min','indicatorsprocs.max','indicatorsprocs.unit','indicatorsproc_value.value','indicatorsproc_value.semaine',
           'indicatorsproc_value.mois','indicatorsproc_value.annee')
           ->where('indicatorsproc_value.process_id',$proc->id)
           ->where('indicatorsproc_value.mois', $fmois)
           ->where('indicatorsproc_value.annee', $fanne)
           ->where('indicatorsproc_value.semaine', $fsemaine)
           ->orderBy('indicatorsproc_value.semaine')
           ->get();
        
   $data['indics']=$rows;
   
//dd($data);
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
             $hours=DB::table('hours')
             ->select('id','semaine')
             ->where('hours.project_id', $project->id)
             ->distinct()
             ->get();
 
             // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
             $objpro=array("id"=>$project->id,"name" => $project->project_name,"tache"=>$project->tache,"program"=>$project->program,"perimetre"=>$project->perimetre, "indics" => array());
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
           }  // dd($datah);
    //***************************afficher les graphes des projets 
         // liste des projects qui existes dans les indicatorsproj_value (id, name)
         $projects=DB::table('project_has_taches')
         ->join('projects', 'project_has_taches.projects_id', '=', 'projects.id')
         ->select('project_has_taches.id', 'projects.project_name','taches.tache','perimetres.perimetre','programs.program')
         ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
         ->join('programs','programs.id','perimetres.programs_id')
         ->join('taches','taches.id','programs.taches_id')
         ->distinct()
         ->get();
          // liste des indicateurs qui existes dans les indicatorsproj_value (id, name)
         $pjindicators=DB::table('associat_indics')
          ->join('indicatorsprojs', 'associat_indics.indic_id', '=', 'indicatorsprojs.id')
          ->select('indicatorsprojs.id','indicatorsprojs.name')
          ->distinct()
         ->get();
         $pjannee=DB::table('indicatorsproj_value')
         ->select('annee')
         ->distinct()
         ->get();
         $pjmois=DB::table('indicatorsproj_value')
         ->select('mois')
         ->distinct()
         ->get();
         $pjsemaine=DB::table('semaine')
         ->select('semaine','id')
         ->distinct()
         ->get();
         $idg=1;
         $datap=array();
         foreach ($projects as $project)
         {
             // liste des indicators qui existes pour cet project (id, name)
             $indicators=DB::table('associat_indics')
             ->select('associat_indics.id','indicatorsprojs.name')
             ->join('indicatorsprojs', 'associat_indics.indic_id', '=', 'indicatorsprojs.id')
             ->join('project_has_taches', 'associat_indics.project_id', '=', 'project_has_taches.id')
             ->where('project_has_taches.id', $project->id)
          
             ->distinct()
             ->get();
 
             // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
             $objpro=array("id"=>$project->id,"name" => $project->project_name,"tache"=>$project->tache,"program"=>$project->program,"perimetre"=>$project->perimetre, "indics" => array());
             $indics=array();
             foreach ($indicators as $ind)
             {   
                 // selectionner les dates (mois) avec leurs valeurs & target.., qui sont dans cet $ind et dans cet $project
                 $months=DB::table('indicatorsproj_value')
                 ->select('indicatorsproj_value.*','projects.project_name','indicatorsprojs.name','taches.tache','perimetres.perimetre','programs.program')
                 ->join('associat_indics', 'associat_indics.id', '=', 'indicatorsproj_value.associat_indic_id')
                 ->join('indicatorsprojs', 'associat_indics.indic_id', '=', 'indicatorsprojs.id')
                 ->join('project_has_taches', 'associat_indics.project_id', '=', 'project_has_taches.id')
                 ->join('projects','projects.id','project_has_taches.projects_id')
                 ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
                 ->join('programs','programs.id','perimetres.programs_id')
                 ->join('taches','taches.id','programs.taches_id')
                 ->where('associat_indic_id', $ind->id)
      
                 ->orderBy('annee')
                 ->orderBy('semaine')
                 ->orderBy('mois')
                 ->get();
            
                 // pk "idg" dans indic? car chaque graphe est un indicator, il faut identifier chaque indicator ajouté
                 $indics[]=array("idg" => $idg, "name" => $ind->name, "months"=>$months->toArray());
                 
                 $idg++;
             }
             $objpro['indics']=$indics;
             $datap[]=$objpro;
          
         } 
   // dd( $datap);
       $taches=taches::All();
      $perimetres=perimetre::All();
      $programs=programs::All();
        $projects=projects::All();

         return View('home',
         ['data'=>$data,
         'procs'=>$procs,
         'mois'=>$mois,
         'annes'=>$annes,
         'fproc'=>$fproc,
         'fmois'=>$fmois,
         'fanne'=>$fanne,
         'datap'=>$datap,
         'pjindicators'=>$pjindicators,
         'pjannee'=>$pjannee,
         'pjmois'=>$pjmois,
         'pjsemaine'=>$pjsemaine,
         'semaines'=>$semaines,
         'fsemaine'=>$fsemaine
         ,'projects'=>$projects
         ,'taches'=>$taches
         ,'programs'=>$programs
         ,'perimetres'=>$perimetres]);
 
    }
    public function findProjectName(Request $request)
	{
        $dataind = DB::table('indicatorsprojs')
        ->select('indicatorsprojs.id','indicatorsprojs.name')
        ->join('indicatorsproj_value','indicatorsproj_value.indicatorsproj_id','indicatorsprojs.id')
        ->where('indicatorsproj_value.projects_id',$request->id)
        ->get();
        return response()->json($dataind);
    }
     /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function taches()
    {$projects_name = Input::get('project_name');
        $taches = DB::table('project_has_taches')
        ->select('taches.tache','taches.id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','taches.id','programs.taches_id')
       ->where("projects.project_name",$projects_name)
       ->distinct()
        ->get();
        return response()->json($taches);
    }
    public function programs()
    {$taches_name = Input::get('tache_name');
        $programs = DB::table('programs')
        ->select('programs.program','programs.id')
        ->join('taches','taches.id','programs.taches_id')
        ->where("taches.tache",$taches_name)
        ->distinct()
        ->get();

        return response()->json($programs);
    }
    public function perimetres(){
        $programs_name = Input::get('programs_name');
        $perimetres = DB::table('perimetres')
        ->select('perimetres.perimetre','perimetres.id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->where("programs.program",$programs_name)
        ->distinct()
        ->get();
        
        return response()->json($perimetres);
      }
}
