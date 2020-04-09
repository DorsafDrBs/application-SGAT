<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\projects;

use App\taches;
use App\unit;
use App\perimetre;
use App\programs;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
class indicatorfortachesController extends Controller
{
    public function index(id $id)
      {
    dd($id);
    
          return view('tachesindicators.index')
      ;
      }
}
