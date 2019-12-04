<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\process;
use DB;
use famille;
class ProcessController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:process-list');
         $this->middleware('permission:process-create', ['only' => ['create','store']]);
         $this->middleware('permission:process-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:process-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = DB::table('processes')
        ->join('familles','familles.id','processes.familles_id')
        ->select('familles.famille','processes.name','processes.id','processes.detail')
        ->orderByRaw('processes.created_at','desc')
     
        ->paginate(5);

        return view('process.index',compact('processes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $familles=DB::table('familles')->select('famille','id')->get();
        return view('process.create',compact('familles'));
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
            'familles_id' => 'required',
        ]);


        process::create($request->all());


        return redirect()->route('process.index')
                        ->with('success','process created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(process $process)
    {
        return view('process.show',compact('process'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(process $process)
    {
        return view('process.edit',compact('process'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, process $process)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'familles_id' => 'required',
        ]);


        $process->update($request->all());


        return redirect()->route('process.index')
                        ->with('success','process updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(process $process)
    {
        $process->delete();


        return redirect()->route('process.index')
                        ->with('success','process deleted successfully');
    }
}
