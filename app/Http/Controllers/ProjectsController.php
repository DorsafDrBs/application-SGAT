<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\projects;
use App\process;
use App\indicatorsproj;
use App\taches;
use App\unit;
use App\perimetre;
use App\programs;
use App\Http\ProjectsController\prog;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

use App\associat_indic;
use Carbon\Carbon;
class ProjectsController extends Controller
{
       function __construct()
        {
             $this->middleware('permission:project-list');
             $this->middleware('permission:project-create', ['only' => ['create','store']]);
             $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:project-delete', ['only' => ['destroy']]);
        }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {   $indicators=indicatorsproj::All();
            $taches=taches::All();
            $perimetres=perimetre::All();
            $programs=programs::All();
            $units=unit::All();
            $processes=process::All();
            $projectslist=projects::All();
            $projects = DB::table('projects')
            ->join('processes','processes.id','projects.proc_id')
            ->select('processes.name','projects.project_name','projects.id')
            ->orderByRaw('projects.created_at','desc')
            ->paginate(5);
            $idh=1;
      //$projects=projects::with('users')->get();
   // $objpro=array("id"=>$project->id,"name" => $project->name,"project_name" => $project->project_name, "users"=>$users->toArray());
    // $datap[]=$objpro;
   //  dd($projects);
   //  $projects = projects::All();
            return view('projects.index',compact('projects','processes','indicators','projectslist','taches','programs','perimetres','units'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {   $processes=DB::table('processes')
           // ->join('projects','projects.proc_id','processes.id')
            ->select('name','id')
            ->get();
            return view('projects.create',compact('processes'));
        }
    
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            request()->validate([
                'proc_id' => 'required',
                'project_name' => 'required',
               
            ]);
    
          projects::create($request->all());
         

            return redirect()->route('projects.index')
                            ->with('success','project created successfully.');
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\projects  $project
         * @return \Illuminate\Http\Response
         */
        public function edit(projects $project)
        {$processes=DB::table('processes')
            ->join('projects','projects.proc_id','processes.id')
            ->select('processes.name','processes.id')
            ->get();
            return view('projects.edit',compact('project','processes'));
        }
    
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\projects  $project
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, projects $project)
        {
             request()->validate([
                'proc_id' => 'required',
                'project_name' => 'required',
              
             
            ]);
      
    
            $project->update($request->all());
    
    
            return redirect()->route('projects.index')
                            ->with('success','project updated successfully');
        }
    
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\projects  $project
         * @return \Illuminate\Http\Response
         */
       public function destroy(projects $project)
        {
            $project->delete();
    
    
            return redirect()->route('projects.index')
                            ->with('success','project deleted successfully');
        }
        /* public function destroyindicproj(association $association)
        {
           
    
            return redirect()->route('projects.index')
                            ->with('success','project deleted successfully');
        }*/
        /**
         * Display the specified resource.
         *
         * @param  \App\projects  $project
         * @return \Illuminate\Http\Response
         */
        public function show(projects $project)
        {
            $indicators=indicatorsproj::All();
            $taches=taches::All();
            $perimetres=perimetre::All();
            $programs=programs::All();
            $units=unit::All();
            $processes=process::All();
            $projectslist=projects::All();
            $process=DB::table('processes')
            ->join('projects','projects.proc_id','processes.id')
            ->where('projects.id',$project->id)
            ->distinct()
            ->get();
      $associations=DB::table('taches')
      ->select('taches.tache','programs.program','perimetres.perimetre','project_has_taches.id')
      ->join('programs','programs.taches_id','taches.id')
      ->join('perimetres','perimetres.programs_id','programs.id')
      ->join('project_has_taches','project_has_taches.perimetre_id','perimetres.id')
      ->where('project_has_taches.projects_id',$project->id)
       ->get();
//dd($associations->id); 
//$groups  = taches::with(['programs', 'programs.perimetres'])->get();
//dd($groups);
            return view('projects.show',compact('associations','project','associations','process','processes','indicators','projectslist','taches','programs','perimetres','units'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    /**
         * Display the specified resource.
         *
         * @param  \App\Request $request  
         * @return \Illuminate\Http\Response
         */
        public function store_taches(Request $request,projects $project)
        {

            $projects=projects::find( $request->input('projects_id'));
      
           $perimetre=perimetre::find( $request->input('perimetres'));
      
          //  dd($projects->id);
      
            $projects->perimetres()->attach($perimetre);
      
    
            return redirect()->route('projects.show')
                            ->with('success','indicator added  successfully.');
        }
          
/*$groups  = taches::whereHas(['programs'=> function ($query)use( $prog) {
                $query->where('id', 'like','%' .$prog. '%');},
                       'programs.perimetres'=> function ($q)use( $perimetre) {
                 $q->where('perimetre', 'like', '%' .$perimetre->perimetre. '%' );}])->get();
         */
        /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function taches()
    {$projects_id = Input::get('project_id');
        $taches = DB::table('project_has_taches')
        ->select('taches.tache','taches.id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','taches.id','programs.taches_id')
       ->where("projects.id",$projects_id)
        ->get();
        return response()->json($taches);
    }
    public function programs()
    {$taches_id = Input::get('tache_id');
        $programs = programs::where("taches_id",$taches_id)->get();
        return response()->json($programs);
    }
    public function perimetres(){
        $programs_id = Input::get('programs_id');
        $perimetres = perimetre::where('programs_id', '=', $programs_id)->get();
        return response()->json($perimetres);
      }
  
      public function indicator()
      {
        //  dd($id);
    
          return view('tachesindicators.index',compact())
      ;
      }

    
}