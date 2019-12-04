<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\projects;
use App\process;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
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
        {
            $projects = DB::table('projects')
            ->join('processes','processes.id','projects.proc_id')
            ->select('processes.name','projects.project_name','projects.id')
            ->orderByRaw('projects.created_at','desc')
            ->paginate(5);
            return view('projects.index',compact('projects'))
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
         * Display the specified resource.
         *
         * @param  \App\projects  $project
         * @return \Illuminate\Http\Response
         */
        public function show(projects $project)
        {
            return view('projects.show',compact('project'));
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
    }
    