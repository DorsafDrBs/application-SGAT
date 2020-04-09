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
          //  dd($datah);
         }
    //***************************afficher les graphes des projets 
         // liste des projects qui existes dans les indicatorsproj_value (id, name)
         $projects=DB::table('associat_indics')
         ->join('projects', 'associat_indics.project_id', '=', 'projects.id')
         ->select('projects.id', 'projects.project_name')
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
         $idg=1;
         $datap=array();
         foreach ($projects as $project)
         {
             // liste des indicators qui existes pour cet project (id, name)
             $indicators=DB::table('associat_indics')
             ->join('indicatorsprojs', 'associat_indics.indic_id', '=', 'indicatorsprojs.id')
             ->select('indicatorsprojs.id','indicatorsprojs.name')
             ->where('associat_indics.project_id', $project->id)
             ->distinct()
             ->get();
 
             // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
             $objpro=array("id"=>$project->id,"name" => $project->project_name, "indics" => array());
             $indics=array();
             foreach ($indicators as $ind)
             {
                 // selectionner les dates (mois) avec leurs valeurs & target.., qui sont dans cet $ind et dans cet $project
                 $months=DB::table('indicatorsproj_value')
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
         'semaines'=>$semaines,
         'fsemaine'=>$fsemaine]);
 
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
   
}
