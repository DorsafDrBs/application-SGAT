<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Projects;
use App\process;
use App\indicatorsproc;
use App\indicatorsproj;
use App\users;
use DB;
use Session;
use count;
use Validator;
use Response;
class CartographieController extends Controller

{
    public function cartographie(Request $request){
        $managements=DB::Table('processes')
        ->where('familles_id','2')
       ->select('id','name','detail')
       ->get();
     $idm=1;
$datam=array();
        foreach($managements as $mg)
        {   $objindic=array("idm"=>$idm,"name" => $mg->name,"detail" => $mg->detail, "indicators" => array());
	$idm++;
            $indicators=array();
            $indicator=DB::Table('indicatorsprocs')
        ->select('name','detail')
     ->where( 'process_id',$mg->id)
        ->get() ;
      
      
    $objindic['indicators']=$indicator;
    $datam[]=$objindic; } 

       $realisations=DB::Table('processes')
     ->where('familles_id','1')
    ->select('id','name','detail')
    ->get();
    $idr=1;
    $datar=array();
        foreach($realisations as $rs)
        {   $objindic=array("idr" => $idr,"name" => $rs->name, "detail" => $rs->detail,"indicators" => array());
	$idr++;
            $indicators=array();
            $indicator=DB::Table('indicatorsprocs')
        ->select('name','detail')
     ->where( 'process_id',$rs->id)
        ->get() ;
      
      
    $objindic['indicators']=$indicator;
    $datar[]=$objindic; } 
	$ids=1;   $datas=array();
    $supports=DB::Table('processes')
    ->where('familles_id','3')
   ->select('id','name','detail')
   ->get();
   $datas=array();
        foreach($supports as $sp)
        {   $objindic=array("ids" => $ids,"name" => $sp->name,"detail" => $sp->detail, "indicators" => array());
            $ids++;
            $indicators=array();
            $indicator=DB::Table('indicatorsprocs')
        ->select('name','detail')
     ->where( 'process_id',$sp->id)
        ->get() ;
      
      
    $objindic['indicators']=$indicator;
    $datas[]=$objindic; } 
    //dd($datas);
   return view('cartographie',compact('managements','realisations','supports','datam','datar','datas'));
    }

}
