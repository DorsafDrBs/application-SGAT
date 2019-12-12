<?php

namespace App\Http\Controllers;

use App\indicatorsproj;
use Illuminate\Http\Request;

class IndicatorsprojController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicproj=indicatorsproj::orderByRaw('created_at','desc')
        ->paginate(5);
        return view('indicprojs.index',compact('indicproj'))
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


       indicatorsproj::create($request->all());


      return redirect()->route('indicprojs.index')
                      ->with('success','projet ajouté avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\indicatorsproj  $indicatorsproj
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {       $indicatorsproj = indicatorsproj::findOrFail($request->indicator_id);
       
            $indicatorsproj->update($request->all());
           

            return redirect()->route('indicprojs.index')
            ->with('success','project  mis à jour avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\indicatorsproj  $indicatorsproj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       $indicatorsproj = indicatorsproj::findOrFail($request->indicator_id);
       
        $indicatorsproj->update($request->all());
       

        return redirect()->route('indicprojs.index')
        ->with('success','project  mis à jour avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\indicatorsproj  $indicatorsproj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $indicatorsproj = indicatorsproj::findOrFail($request->indicator_id);
          $indicatorsproj->delete();
    
            return redirect()->route('indicprojs.index')
                            ->with('success','Indicateur supprimé avec succès');
      
    }
}
