<?php

namespace App\Http\Controllers;

use App\indicatorsproc;
use Illuminate\Http\Request;


class IndicatorsprocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicprocess=indicatorsproc::orderByRaw('created_at','desc')
        ->paginate(5);
        return view('indicprocs.index',compact('indicprocess'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\indicatorsproc  $indicatorsproc
     * @return \Illuminate\Http\Response
     */
    public function show(indicatorsproc $indicatorsproc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\indicatorsproc  $indicatorsproc
     * @return \Illuminate\Http\Response
     */
    public function edit(indicatorsproc $indicatorsproc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\indicatorsproc  $indicatorsproc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, indicatorsproc $indicatorsproc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\indicatorsproc  $indicatorsproc
     * @return \Illuminate\Http\Response
     */
    public function destroy(indicatorsproc $indicatorsproc)
    {
        //
    }
}
