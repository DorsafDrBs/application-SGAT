<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\programs;
use App\taches;
use Spatie\Permission\Models\Permission;
class ProgramsController extends Controller
{
   public function __construct()
     {
    
     $this->middleware('permission:program-create');
     $this->middleware('permission:program-edit',['only' => ['edit','update']]);
     $this->middleware('permission:program-delete', ['only' => ['destroy']]);
     }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     { $taches=DB::table('taches')
        ->select('tache','id')->get();
        $programs=DB::table('programs')
        ->select('programs.program','taches.tache')
        ->join('taches','taches.id','programs.taches_id')
        ->get();
        
        return view('programs.index',compact('programs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'programs' => 'required',
            'programs_id' => 'required',
          
        ]);

        $program = programs::find($request->input('programs_id'));
  $programs= $request->input('programs');
  $programs=$program->programs()->save($programs);


      return redirect()->route('programs.index')
                      ->with('success','projet ajouté avec succès.');
    }

 
 
    /**
     * Update the specified resource  in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\programs  $programs
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\programs  $programs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $programs = programs::findOrFail($request->programs_id);
        $programs->delete();
    }
}
