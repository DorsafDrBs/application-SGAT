<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\projects;
use App\indicatorsproj;
use App\associat_indic;
use App\project_has_taches;
use App\unit;
use App\Http\ProjectsController\prog;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Gate;
use Validator,Redirect,Response,File;
use Carbon\Carbon;
class indicatorfortachesController extends Controller
{ /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function indexindic($id)
      { $indicators=indicatorsproj::All();
        $units=unit::All();
          $info=DB::table('project_has_taches')
        ->select('projects.project_name','taches.tache','programs.program','perimetres.perimetre','project_has_taches.id')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','programs.taches_id','taches.id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->where('project_has_taches.id',$id)
         ->first();
       $data=DB::table('associat_indics')
         ->select('associat_indics.id','associat_indics.target','associat_indics.operator_cp','associat_indics.orange','associat_indics.indic_id','associat_indics.unit_id','indicatorsprojs.name','units.unit')
         ->join('project_has_taches','project_has_taches.id','associat_indics.project_id')
         ->join('indicatorsprojs','indicatorsprojs.id','associat_indics.indic_id')
         ->join('units','units.id','associat_indics.unit_id')
         ->where('project_has_taches.id',$id)
         ->get();
    
          return view('tachesindicators.indexindic',compact('data','info','indicators','units'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
      }
      /**
 * Update the specified resource  in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 * */
      public function storeindics(Request $request)
      {  request()->validate([
        'project_id' => 'required',
        'unit_id' => 'required',
        'indic_id' => 'required',
        'target' => 'required',
        'operator_cp' => 'required',
        'orange' => 'required',
      
    ]);

  
    associat_indic::create($request->all());
    

  return redirect()->route('tachesindicators.indexindic')
                  ->with('success','indicator added succesfuly.');
      }
      
    /**
     * Update the specified resource  in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\associat_indic  $associat_indic
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  request()->validate([
        'project_id' => 'required',
        'unit_id' => 'required',
        'indic_id' => 'required',
        'target' => 'required',
        'operator_cp' => 'required',
        'orange' => 'required',
      
    ]);
          $associat_indic = associat_indic::findOrFail($request->indicator_id);
            $associat_indic->update($request->all());
           
            return redirect()->route('tachesindicators.indexindic')
            ->with('success','indicator updated succesfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\associat_indic  $associat_indic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $associat_indic = associat_indic::findOrFail($request->indicator_id);
          $associat_indic->delete();
    
            return redirect()->route('tachesindicators.indexindic')
                            ->with('success','indicator deleted succesfuly');
    }
}
