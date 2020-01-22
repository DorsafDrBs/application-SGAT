<?php
namespace App\Http\Controllers;
use DB;
use App\Process;
use App\Projects;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class WelcomController extends Controller
{
    
    public function index()
    {   
        $users = DB::table('users')->count();
        $projet = DB::table('projects')->count();
        $process = DB::table('processes')->count();

      return view("welcome",compact('users','projet','process'));
    }
}
