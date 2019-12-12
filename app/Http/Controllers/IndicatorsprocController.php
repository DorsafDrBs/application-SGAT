<?php

namespace App\Http\Controllers;

use App\indicatorsproc;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator,Redirect,Response,File;
use DB;
use Gate;

class IndicatorsprocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes=DB::table('processes')
        ->select('processes.name','processes.id')
        ->distinct()
        ->get();
        $indicprocess=indicatorsproc::orderByRaw('created_at','desc')
        ->paginate(5);
        return view('indicprocs.index',compact('indicprocess','processes'))
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
            'name' => 'required',
            'detail' => 'required',
           
        ]);


       indicatorsproc::create($request->all());


      return redirect()->route('indicprocs.index')
                      ->with('success','projet ajouté avec succès.');
    }

 
 
    /**
     * Update the specified resource  in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\indicatorsproc  $indicatorsproc
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       $indicatorsproc = indicatorsproc::findOrFail($request->indicator_id);
            $indicatorsproc->update($request->all());
           
            return redirect()->route('indicprocs.index')
            ->with('success','project  mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\indicatorsproc  $indicatorsproc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $indicatorsproc = indicatorsproc::findOrFail($request->indicator_id);
          $indicatorsproc->delete();
    
            return redirect()->route('indicprocs.index')
                            ->with('success','Indicateur supprimé avec succès');
    }
}
