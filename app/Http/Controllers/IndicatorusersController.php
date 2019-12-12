<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\indicatorsusers;
class IndicatorusersController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicusers=indicatorsusers::orderByRaw('created_at','desc')
        ->paginate(5);
        return view('indicusers.index',compact('indicusers'))
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
       indicatorsusers::create($request->all());

      return redirect()->route('indicusers.index')
                      ->with('success','Un indicateur des utilisateur ajouté avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\indicatorsusers  $indicatorsusers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {       $indicatorsusers = indicatorsusers::findOrFail($request->indicator_id);
            $indicatorsusers->update($request->all());
           
            return redirect()->route('indicusers.index')
            ->with('success','Un indicateur des utilisateurs  mis à jour avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\indicatorsusers  $indicatorsusers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       $indicatorsusers = indicatorsusers::findOrFail($request->indicator_id);
        $indicatorsusers->update($request->all());

        return redirect()->route('indicusers.index')
        ->with('success','Un indicateur des utilisateurs  mis à jour avec succès');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\indicatorsusers  $indicatorsusers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $indicatorsusers = indicatorsusers::findOrFail($request->indicator_id);
          $indicatorsusers->delete();
    
            return redirect()->route('indicusers.index')
                            ->with('success','Un indicateur des utilisateurs supprimé avec succès');
      
    }
}
