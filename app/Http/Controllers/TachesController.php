<?php

namespace App\Http\Controllers;
use App\taches;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Spatie\Permission\Models\Permission;
class TachesController extends Controller
{ 
    public function __construct()
     {
    
     $this->middleware('permission:tache-create');
     $this->middleware('permission:tache-edit',['only' => ['edit','update']]);
     $this->middleware('permission:tache-delete', ['only' => ['destroy']]);
     }
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $taches=taches::all();
    
    
    return view('taches.index',compact('taches'))
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
        'tache' => 'required',
        
      
    ]);

  
    $tache->create($request->all());
    

  return redirect()->route('taches.index')
                  ->with('success','tacheadded succesfuly.');
}



/**
 * Update the specified resource  in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\taches  $taches
 *  * @param  \App\tache  $tache
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request)
{          $tache = taches::findOrFail($request->tache_id);
           $tache->update($request->all());
          
           return redirect()->route('taches.index')
           ->with('success','Tache updated succesfully');

}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\taches  $taches
 * @return \Illuminate\Http\Response
 */
public function destroy(Request $request)
{
    $taches = taches::findOrFail($request->taches_id);
    $taches->delete();
    return redirect()->route('taches.index')
    ->with('success','Tache deleted succesfully');

}
}
