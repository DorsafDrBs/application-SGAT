<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Projects;
use Illuminate\Support\Facades\Input;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection\projectusers;

use DB;
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'projects' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $project=$request->input('projects');

        $user_id = User::where('name',$user->name)->select('id')->get();
        $project = projects::where('project_name', $project)->select('id')->get();

         
            $project->projectusers()->attach($user_id);


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
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
            'email' => 'required|email|unique:users,email,'.$id,
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
}
