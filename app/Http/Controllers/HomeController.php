<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
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
       
    public function test()
    {
       
       
        return view('test');
    }
    public function manager()
    {
        return view('manager');
    }
    public function cartographie()
    {
        return view('cartographie');
    }
    public function index(Request $request)
    {
       //****************************** Filter ***************************** */
     $procs=DB::table('processes')->select('id','name')->get();
     $mois=DB::table('indicatorsproc_value')->select(DB::raw('MONTH(created_at) nmoi'))->orderBy('created_at')->distinct()->get();
     $annes=DB::table('indicatorsproc_value')->select(DB::raw('YEAR(created_at) nanne'))->orderBy('created_at')->distinct()->get();
     $fproc=$request->input("fproc") ?: array_slice($procs->pluck('id')->toArray(),-1)[0];
     $fmois=$request->input("fmois") ?: array_slice($mois->pluck('nmoi')->toArray(),-1)[0];
     $fanne=$request->input("fanne") ?: array_slice($annes->pluck('nanne')->toArray(),-1)[0];
 
     $proc=DB::table('processes')->select('id','name')->find($fproc);
 
     $data=array("name" => $proc->name, "indics" => array());	
     
     $rows=DB::table('indicatorsprocs')
             ->join('indicatorsproc_value','indicatorsprocs.id','indicatorsproc_value.indic_id')
             ->select('indicatorsprocs.id','indicatorsprocs.name','indicatorsproc_value.value','indicatorsproc_value.target','indicatorsproc_value.created_at')
             ->where('indicatorsproc_value.process_id',$proc->id)
           ->whereMonth('indicatorsproc_value.created_at', $fmois)
         ->whereYear('indicatorsproc_value.created_at', $fanne)
             ->orderBy('indicatorsproc_value.created_at')
             ->get();
   
     $data['indics']=$rows;

  
    //***************************afficher les graphes des projets */
    
         // liste des projects qui existes dans les projects-indicators (id, name)
         $projects=DB::table('indicatorsproj_value')
         ->join('projects', 'indicatorsproj_value.projects_id', '=', 'projects.id')
        
         ->select('projects.id', 'projects.project_name')
         ->distinct()
         ->get();
 
         $idg=1;
         $datap=array();
         foreach ($projects as $project)
         {
             // liste des indicators qui existes pour cet project (id, name)
             $indicators=DB::table('indicatorsproj_value')
             ->join('indicatorsprojs', 'indicatorsproj_value.indicatorsproj_id', '=', 'indicatorsprojs.id')
             ->select('indicatorsprojs.id','indicatorsprojs.name')
             ->where('indicatorsproj_value.projects_id', $project->id)
             ->distinct()
             ->get();
 
             // ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
             $objpro=array("name" => $project->project_name, "indics" => array());
             $indics=array();
             foreach ($indicators as $ind)
             {
                 // selectionner les dates (mois) avec leurs valeurs & target.., qui sont dans cet $ind et dans cet $project
                 $months=DB::table('indicatorsproj_value')
                 ->where('indicatorsproj_id', $ind->id)
                 ->where('projects_id', $project->id)
                 ->orderBy('created_at')
                 ->get();
                                 
                 // pk "idg" dans indic? car chaque graphe est un indicator, il faut identifier chaque indicator ajouté
                 $indics[]=array("idg" => $idg, "name" => $ind->name, "months"=>$months->toArray());
                 
                 $idg++;
             }
             $objpro['indics']=$indics;
             $datap[]=$objpro;
         }
 
         return View('home',
         ['data'=>$data,
         'procs'=>$procs,
         'mois'=>$mois,
         'annes'=>$annes,
         'fproc'=>$fproc,
         'fmois'=>$fmois,
         'fanne'=>$fanne,
         'datap'=>$datap]);
 
    }
    public function index2(Request $request)
	{
		//****************************** Filter ***************************** */
        $procs=DB::table('processes')   
            -> join('projects','processes.id','projects.proc_id')
            ->select('processes.id','processes.name')
            ->get();
		
		$indis=DB::table('indicatorsusers_value')
		->join('indicatorusers', 'indicatorsusers_value.indicatorusers_id', '=', 'indicatorusers.id')
		->select('indicatorusers.id','indicatorusers.name')
		->distinct()
		->get();
		
		$projs=DB::table('projects')
		       ->select('id','project_name')
		       ->get();
        $colls=DB::table('users')
             ->select('id','name')
             ->get();
        $mois=DB::table('indicatorsusers_value')
             ->select(DB::raw('MONTH(created_at) nmoi'))
             ->orderBy('created_at')
             ->distinct()
             ->get();
        $annes=DB::table('indicatorsusers_value')
             ->select(DB::raw('YEAR(created_at) nanne'))
             ->orderBy('created_at')
             ->distinct()
             ->get();

		$fprocs=$request->input("fprocs") ?: $procs->pluck('id')->toarray();
		$findics=$request->input("findis") ?: $indis->pluck('id')->toarray();
		$fprojs=$request->input("fprojs") ?: $projs->pluck('id')->toarray();
		$fcolls=$request->input("fcolls") ?: $colls->pluck('id')->toarray();
		$fmois=$request->input("fmois") ?: $mois->pluck('nmoi')->toarray();
		$fanne=$request->input("fanne") ?: array_slice($annes->pluck('nanne')->toArray(),-1)[0];
		
		//$maxmois = 12;

		// liste des projects qui existes dans les collaborateurs (id, name)
		$projects=DB::table('projects')
		->join('project_has_users', 'project_has_users.projects_id', '=', 'projects.id')
		->select('projects.id', 'projects.project_name')
	    ->whereIn("projects.id", $fprojs)
		->whereIn('projects.proc_id', $fprocs)
		->distinct()
		->get();
        $idg=1;
        $idc=1;
		$data=array();
		foreach ($projects as $project)
		{	// liste des indicators qui existes dans cet project (id, name)
			$indicators=DB::table('indicatorsusers_value')
            ->join('project_has_users', 'indicatorsusers_value.users_id', '=', 'project_has_users.id')
            ->where('project_has_users.projects_id', $project->id)
			->join('indicatorusers', 'indicatorsusers_value.indicatorusers_id', '=', 'indicatorusers.id')
			->select("indicatorusers.id", "indicatorusers.name")
			->whereIn("indicatorusers.id", $findics)
			->distinct()
			->get();
			// ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
			$objpro=array("name" => $project->project_name, "indics" => array());
			$indics=array();
			foreach ($indicators as $ind)
				{	// liste des numeros des mois qui existes dans cet indicator
                    $months=DB::table('indicatorsusers_value')
                    ->select(DB::raw('MONTH(indicatorsusers_value.created_at) nmois'))
                    ->where('indicatorsusers_value.indicatorusers_id', $ind->id)
                    ->whereIn(DB::raw('MONTH(indicatorsusers_value.created_at)'), $fmois)
                    ->orderBy('created_at')  
                    ->distinct()
                    ->get();
                  $indics[]=array("idg" => $idg,"name" => $ind->name,"pmois" =>array());
                  $pmois=array();
                  $idg++;
                   foreach ($months as $month)
                   { $users=DB::table('users')
                       ->join ('project_has_users','users.id','project_has_users.users_id')
                       ->join('indicatorsusers_value','indicatorsusers_value.users_id', '=', 'project_has_users.id')
                       ->select('users.name','indicatorsusers_value.*')
                       ->where('indicatorsusers_value.indicatorusers_id', $ind->id)
                       ->where(DB::raw('MONTH(indicatorsusers_value.created_at)'), $month->nmois)
                       ->whereYear('indicatorsusers_value.created_at', $fanne)
                       ->distinct()
                       ->get();
                        $pmois[]=array("idc" => $idc,"month" => $month->nmois, "users" =>$users);
                        $idc++;
                   }$indics['pmois']=$pmois;
                }
			$objpro['indics']=$indics;
			$data[]=$objpro;
		} dd($data);
		//***************************return */
		return View('home2',['data'=>$data,
		'procs'=>$procs,
		'indis'=>$indis,
		'projs'=>$projs,
		'colls'=>$colls,
		'mois'=>$mois,
		'annes'=>$annes,
		'fprocs'=>$fprocs,
		'findics'=>$findics,
		'fprojs'=>$fprojs,
		'fcolls'=>$fcolls,
		'fmois'=>$fmois,
		'fanne'=>$fanne]);
	}
}
