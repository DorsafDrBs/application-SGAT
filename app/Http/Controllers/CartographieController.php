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
     //  $fprocs=$request->input("fprocs") ?:array_slice($managements->pluck('id')->toarray(),-1)[0];
       //$management=DB::Table('processes')
       //->where('id',$fprocs)
     // ->select('id','name','detail')
      //->get();

//dd($management);
       $realisations=DB::Table('processes')
     ->where('familles_id','1')
    ->select('id','name','detail')
    ->get();
    $supports=DB::Table('processes')
    ->where('familles_id','3')
   ->select('id','name','detail')
   ->get();
   return view('cartographie',compact('managements','realisations','supports'));
    }

     public function cartographie1(){
	$idg=1;
	$datam=array();
     $managements=DB::Table('process')
     ->where('famille_id','2')
    ->select('id','name')
    ->get();
foreach($managements as $management)
{
    $indicmg=DB::Table('indicatorsprocs')
    ->where('famille_id',$management->id)
    ->select('name')->distinct()->get() ;
    $objproc=array("name" => $management->name, "indicm" => array());	
    $indics=array();
    foreach($indicmg as $indic)
    {
        $mgindic=DB::Table('indicatorsprocs')
        ->where('name',$indic->name)
        ->select('name')
        ->get();
    	$indics[]=array("idg" => $idg, "name" => $indic->name);
		$idg++;
		}
		$objproc['indicm']=$indics;
		$datam[]=$objproc;
}
      /**********************************************************/ 
	$idgr=1;
	$datar=array();
     $realisations=DB::Table('process')
     ->where('famille_id','1')
     ->where('name','!=','R1')
    ->select('id','name')
    ->get();
foreach($realisations as $realisation)
{
    $indicrs=DB::Table('indicatorsprocs')
    ->where('famille_id',$realisation->id)
    ->select('name')
    ->distinct()
    ->get() ;
    $objproc=array("name" => $realisation->name, "indicr" => array());	
    $indics=array();
    foreach($indicrs as $indic)
        {
        $rsindic=DB::Table('indicatorsprocs')
        ->where('name',$indic->name)
        ->select('name')
        ->get();
    	$indics[]=array("idg" => $idg, "name" => $indic->name);
		$idg++;
		}
		$objproc['indicr']=$indics;
		$datar[]=$objproc;
}
//**************************************************************/ 
$idgr1=1;
$datar1=array();
$rR1=DB::Table('process')
->where('famille_id','1')
->where('name','=','R1')
->select('id','name')
->get();
foreach($rR1 as $R1)
{
    $indicr1=DB::Table('indicatorsprocs')
    ->where('famille_id',$R1->id)
    ->select('name')
    ->distinct()
    ->get() ;
    $objproc=array("name" => $R1->name, "indic"=>array());
    $indics=array();
    foreach($indicr1 as $indic)
       {
        $rsindic=DB::Table('indicatorsprocs')
        ->where('name',$indic->name)
        ->select('name')
    
        ->get();
      
        $indics[]=array("idg" => $idg, "name" => $indic->name);
      $idg++;
        }
        $objproc['indicr1']=$indics;
        $datar1[]=$objproc;
    }
    //***************************************************/
$idgs=1;
$datasp=array();
 $supports=DB::Table('process')
 ->where('famille_id','3')
->select('id','name')
->get();
foreach($supports as $support)
{
$indicsp=DB::Table('indicatorsprocs')
->where('famille_id',$support->id)
->select('name')
->distinct()
->get() ;
$objproc=array("name" => $support->name, "indicsp" => array());	
$indics=array();
foreach($indicsp as $indic)
    {
    $rsindic=DB::Table('indicatorsprocs')
    ->where('name',$indic->name)
    ->select('name')
    ->get();
    $indics[]=array("idg" => $idg, "name" => $indic->name);
        $idg++;
    }
    $objproc['indicsp']=$indics;
    $datasp[]=$objproc;
}    
    // return view('cartographie',['datam'=>$datam,'datar'=>$datar,'datar1'=>$datar1,'datasp'=>$datasp]);
    }

}
