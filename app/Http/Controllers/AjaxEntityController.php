<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entity;
use Redirect,Response;

class AjaxEntityController extends Controller
{
    //
   
    public function index()
    {
        
        //$entities = Entity::with('entity')->latest()->get();
        //dd($entities);
        $tab [] = 
            // Chaque tableau sera converti en objet
            array( 
              "id" => "1",
              "name" => "Frédéric Majory",
              "email" => "FredericMajory@dayrep.com",
              "telephone" => "+33 01.09.94.30.12"
            );
            
           /*$tab [] = array ( 
            // Chaque tableau sera converti en objet
            array( 
              "id" => "1",
              "name" => "Frédéric Majory",
              "email" => "FredericMajory@dayrep.com",
              "telephone" => "+33 01.09.94.30.12"
            ), 
            array(
              "id" => "2", 
              "name" => "Adorlee Miron",
              "email" => "AdorleeMiron@teleworm.fr",
              "telephone" => "+33 04.97.35.65.26"
            ), 
            array(
              "id" => "3", 
              "name" => "Christian Leclerc",
              "email" => "ChristianLeclerc@dayrep.com",
              "telephone" => "+33 03.56.16.29.48"
            ) 
          ); */
        //dd($tab);
        /*echo "<pre>";
        print_r($entities);
        echo "</pre>";*/
        //exit();
        //$entities = Entity::with('entity')->latest()->get();
        //================test=======================//
        /*$typeRequestByToolId = DB::table('entities')
                                ->join('entities','entities.id','=','entities.entity_id')
                                ->select('type_request_tools.*', 'type_requests.name as type_request_name')
                                ->where('type_request_tools.tool_id','=',$toolId)
                                ->orderByRaw('type_request_name')
                                ->get();*/
        //dd($entities);
        if(request()->ajax())
            {
                ///$entities = Entity::with('entity')->latest()->get();
          
                //dd($entities);
                //exit();
                //return datatables()->of(Entity::latest()->get())
                //json_encode($tab)
                return datatables()->of(json_encode($tab))
                        ->addColumn('action', function($data){
                            
                        
                        $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success edit-post">Edit</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="javascript:void(0);" id="delete-post" data-toggle="tooltip" data-original-title="Delete" data-id="'.$data->id.'" class="delete btn btn-danger">   Delete</a>';
                        return $button;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('entity.indexdt');
    }
    public function index2()
    {
        
        $dataEntities = Entity::with('entity')->orderBy('id', 'DESC')->get();
        return view('entity.indexdt2new', compact('dataEntities'));
    }
    public function store(Request $request)
    {  

        echo "pass store";
        
        $entityId = $request->id;
        $entity   =   Entity::updateOrCreate(['id' => $entityId],
                    ['entity_id' => $request->entity_id ,'name' => $request->name, 'description' => $request->description]);  
        echo "pass store";      
        //return Response::json($entity);
    }
    public function edit($id)
    {   
        
        $where = array('id' => $id);
        $entity  = Entity::where($where)->first();
        return Response::json($entity,200);
    }
    public function destroy($id)
    {
        $entity = Entity::where('entity_id',$id)->delete();
        $entity = Entity::where('id',$id)->delete();
        return Response::json($entity,200);
    }
    public function testrequete(){
        
        $vtyperequestid = 1;
        $vtoolid = 60;                
        $zRangMax = "select MAX(rank) as rangmax from validation_requests where type_request_id=".$vtyperequestid." and tool_id =".$vtoolid."";
        echo $zRangMax;
        $toRang = DB::select($zRangMax);
        foreach($toRang as $vrank2){
            $maxrang = $vrank2->rangmax;
        }
        echo "maxrang=".$maxrang;
        $ventityid = 6;
        $zRangMax2 = "select rank from validation_requests where entity_id=".$ventityid." and type_request_id=".$vtyperequestid." and tool_id =".$vtoolid."";
        echo $zRangMax2;
        //$vrank = 0;
        $getRank = DB::select($zRangMax2);
        foreach($getRank as $vrank1){
            $vrank = $vrank1->rank;
        }
        echo "rank=".$vrank;
        exit();
    }
     
}
