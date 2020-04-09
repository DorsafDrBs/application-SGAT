<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\programs;
use App\perimetre;
class PerimetreController extends Controller
{
    public function __construct()
    {
   
    $this->middleware('permission:perimetre-create');
    $this->middleware('permission:perimetre-edit',['only' => ['edit','update']]);
    $this->middleware('permission:perimetre-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $programs=DB::table('programs')
        ->select('program','id')
        ->get();
        $perimetres=DB::table('perimetres')
        ->select('perimetres.perimetre','perimetres.id','programs.program')
        ->join('programs','programs.id','perimetres.programs_id')
        ->get();
       

        return view('perimetres.index',compact('perimetres','programs'))
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
            'perimetre' => 'required',
            'programs_id' => 'required',
          
        ]);

       
        $perimetre = new perimetre(array('perimetre'=>$request->input('perimetre')));
        $program = programs::find($request->input('programs_id'));
         $perimetre=$program->perimetres()->save($perimetre);


      return redirect()->route('perimetres.index')
                      ->with('success','projet ajouté avec succès.');
    }

 
 
    /**
     * Update the specified resource  in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\perimetre  $perimetre
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\perimetre  $perimetre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $perimetre = perimetre::findOrFail($request->input('perimetre_id'));
       dd( $perimetre);
        return redirect()->route('perimetres.index')
                        ->with('success','projet ajouté avec succès.');
    }
}
