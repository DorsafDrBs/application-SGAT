<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use lluminate\Support\Collection; 
use App\projects;
use App\process;
use App\indicatorsproc;
use App\indicatorsproj;
use App\indicators;
use App\indicatorsindicatorusers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Validator,Redirect,Response,File;
use DB;
use Image;
class ProfileController extends Controller
{  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request )
    { // afficher les projet de l'utilisateur connecte
$id=3;
$idp=1; 
$dataproc=array();
         $processes=DB::table('processes')
              ->join('projects','processes.id','projects.proc_id')
              ->select('processes.name','processes.id')
              ->distinct()
              ->get();
             
foreach ($processes as $proc)
{
    $objproc=array("name" => $proc->name, "projects" => array());
	
    $indics=array();

    $projectslist = DB::table('projects')
                ->where('projects.proc_id',$proc->id)   
                ->join('project_has_users','project_has_users.projects_id','projects.id')  
                ->where('project_has_users.users_id',$id)  		
		     	->select('projects.project_name','projects.id')
                ->get();
            


	$objproc['projects']=$projectslist;
    $dataproc[]=$objproc;
  
} // dd($dataproc);
/*********************les graphes des utilisateurs************************* */
$idg=1; 
$data=array();
// liste des projects qui existes dans les users (id, name)
     $projs=DB::table('projects')
            ->join('project_has_users','project_has_users.projects_id','projects.id')
            ->join('users','users.id','project_has_users.users_id')
            ->where('users.id',$id)
		    ->select('projects.id', 'projects.project_name')
            ->distinct()
            ->get();
	
	$fprojs=$request->input("fprojs") ?:array_slice($projs->pluck('id')->toarray(),-1)[0];

	$projects=DB::table('projects')
->join('processes','processes.id','projects.proc_id')
		 ->select('projects.project_name','projects.id')
		 ->where('projects.id',$fprojs)
		 ->distinct()
		 ->get();
         
foreach ($projects as $project)
	{        // liste des indicators qui existes dans cet project (id, name)
		$indicators=DB::table('indicatorsusers_value')
			->join('project_has_users', 'indicatorsusers_value.users_id', '=', 'project_has_users.users_id')
            ->join('indicatorusers', 'indicatorsusers_value.indicatorusers_id', '=', 'indicatorusers.id')
			->select("indicatorusers.id", "indicatorusers.name")
			->where('project_has_users.projects_id', $project->id)
			->distinct()
			->get();
			// ajouter un projet avec son name dans la liste projets + declarer sa liste des indicators (graphes)
            $objpro=array("project_name" => $project->project_name, "indics" => array());
            
			$indics=array();
			foreach ($indicators as $ind)
			{
				// selectionner les users avec leurs valeurs & target.., qui sont dans cet $project et dans cet $ind
                $collabs=DB::table('indicatorsusers_value')
                    ->join('project_has_users','project_has_users.id','indicatorsusers_value.users_id')
					->join('users', 'users.id', '=', 'project_has_users.users_id')	
                    ->select('users.name','project_has_users.projects_id', 'indicatorsusers_value.*')
                    ->where('project_has_users.projects_id', $project->id)
					->where('indicatorsusers_value.indicatorusers_id', $ind->id)
					->orderBy('indicatorsusers_value.created_at')
					->get();
								
				// pk "idg" dans indic? car chaque graphe est un indicator, il faut identifier chaque indicator ajouté
				$indics[]=array("idg" => $idg, "name" => $ind->name, "collabs"=>$collabs->toArray());
              
				$idg++;
			}
            $objpro['indics']=$indics;
            $data[]=$objpro;
         
   
		}
/********************************les tableaux des utilisateurs de chaque projet*****************************************/
		$idc=1;
    $datac=array();

foreach ($projs as $proj)
    {
    $colls=DB::table('users')
          ->join('project_has_users','users.id','project_has_users.users_id')
          ->select('users.id','users.name','users.email')
          ->where('project_has_users.projects_id','=',$proj->id)
         ->get();

	// [FIXED] "collabs" not "collab"
    $objcol=array("project_name" => $proj->project_name, "collabs" => array());
    $collabs=array();

    foreach ($colls as $coll)
        {
            $pr=DB::table('users')
               ->select('users.id','users.name','users.email')
               ->where('users.id','=',$coll->id)
               ->get();
    $collabs[]=array("idc" => $idc,"id"=>$coll->id, "name" => $coll->name,"email" => $coll->email);
    $idc++;
        }
		// [FIXED] 'collabs' not 'collab'
        $objcol['collabs']=$collabs;
        $datac[]=$objcol;
            
     }
return view('profile.profile',
['dataproc'=>$dataproc,'datac'=>$datac,'data'=>$data,'projs'=>$projs,'fprojs'=>$fprojs]);

}
public function update(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $pictureName = $user->id.'_picture'.time().'.'.request()->picture->getClientOriginalExtension();

        $request->picture->storeAs('pictures',$pictureName);

        $user->picture = $pictureName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

 
    }
}
