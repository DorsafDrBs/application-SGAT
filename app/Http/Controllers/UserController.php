<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Projects;
use App\taches;
use App\programs;
use App\perimetre;
use App\project_has_taches;
use Illuminate\Support\Facades\Input;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection\projectusers;
use EmailDomainFacade;
use DB;
use Validator;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')
    
        ->paginate(5);
      /* $idh=1;
      foreach ($users as $user)
        {
            $datap=DB::table('users')
            ->join('project_has_users','project_has_users.users_id',$user->id)
             ->join('projects','projects.id','project_has_users.projects_id')
            ->select('projects.project_name')
            ->get();
         $objusers=array($users, "usersarray" => array());
         $indics=array();
         foreach ($datap as $projet)
            $projets=DB::table('projects')
             ->where('id',$projet->id)
             ->select('project_name')
             ->get();
          $usersarray[]=array("idh" => $idh,"project_name" => $projets->toArray());
                 
          $idh++;
      }
      $objusers['usersarray']=$usersarray;
      $datah[]=$objusers;
        dd($data);
*/
$projects=Projects::pluck('project_name','project_name')->all();
        $roles = Role::pluck('name','name')->all();
        return view('users.index',compact('data','roles','projects'))
       ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|domain:sogeclairaerospace.com|domainnot:gmail.com,yahoo.com|unique:users',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'projects' => 'required'
        ]);

        $input = $request->all();
  
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $user->assignRole($request->input('roles'));

        $project=projects::select('id')->where('project_name',$request->input('projects'))->get();

          $user->projectusers()->attach($project);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {$user=User::find($id);
          $users = DB::table('users')
        ->select('projects.project_name','taches.tache','programs.program','perimetres.perimetre','project_has_taches.id')
        ->join('project_has_users','project_has_users.users_id','users.id')
        ->join('project_has_taches','project_has_taches.id','project_has_users.projects_id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','taches.id','programs.taches_id')
        ->where('users.id',$id)
      ->paginate(5);
   
      $taches=taches::All();
      $perimetres=perimetre::All();
      $programs=programs::All();
        $projects=projects::All();
       // dd($users);
        return view('users.show',compact('user','users','projects','taches','programs','perimetres'))
         ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $user = User::findOrFail($request->user_id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|domain:sogeclairaerospace.com|domainnot:gmail.com,yahoo.com|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::findOrFail($request->user_id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
   $user=User::findOrFail($request->user_id);
   $user->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_projet(Request $request)
    {
        $this->validate($request, [
            'projects' => 'required',
            'perimetres' => 'required',
            'users_id' => 'required',
           
        ]);
        $users=projects::find( $request->input('users_id'));
        $project=projects::find( $request->input('projects'));
        $perimetre=perimetre::find( $request->input('perimetres'));
        $projects=DB::table('project_has_taches')
        ->select('projects_id','perimetre_id')
        ->where('projects_id',$project)
          ->where('perimetre_id',$perimetre);
       project_has_taches::with('project_has_taches')->find('18');

//$users->project_has_taches()->attach($projects);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
     /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function taches()
    {$projects_id = Input::get('project_id');
        $taches = DB::table('project_has_taches')
        ->select('taches.tache','taches.id')
        ->join('projects','projects.id','project_has_taches.projects_id')
        ->join('perimetres','perimetres.id','project_has_taches.perimetre_id')
        ->join('programs','programs.id','perimetres.programs_id')
        ->join('taches','taches.id','programs.taches_id')
       ->where("projects.id",$projects_id)
       ->distinct()
        ->get();
        return response()->json($taches);
    }
    public function programs()
    {$taches_id = Input::get('tache_id');
        $programs = programs::where("taches_id",$taches_id)->get();
        return response()->json($programs);
    }
    public function perimetres(){
        $programs_id = Input::get('programs_id');
        $perimetres = perimetre::where('programs_id', '=', $programs_id)->get();
        return response()->json($perimetres);
      }
  
}
