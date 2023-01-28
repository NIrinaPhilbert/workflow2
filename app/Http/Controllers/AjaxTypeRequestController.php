<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Entity;
use App\User;
use App\type_request;
use App\tool_type_request;
use App\Helpers\Helper as Helper;

use Redirect,Response;


use Illuminate\Http\Request;

class AjaxTypeRequestController extends Controller
{
    public function __construct()
    {
        
        //$this->middleware('auth');
    }
    public function index()
    {
        
            $typerequests = DB::table('type_requests')
            ->orderBy('type_requests.name','ASC')
            ->get();
           
            $ListTypeRequest = DB::table('tool_type_request')
            ->join('tools','tools.id', '=', 'tool_type_request.tool_id')
            ->join('type_requests','type_requests.id', '=', 'tool_type_request.type_request_id')
            ->select('tool_type_request.id as ID','tool_type_request.tool_id as tool_id','tools.name as tool_name','type_requests.id as type_request_id','type_requests.name as type_requestname','type_requests.description as description')
            ->orderBy('tool_type_request.id','DESC')
            ->get();   
       
            
            
            return view('type demande.typerequestdt', compact('typerequests','ListTypeRequest'));
    }
    public function store(Request $request)
    {  
       
        $typerequesttool = $_POST['data'];
        $description = $_POST['description'];
        $tzTyperequesttool = explode("|",$typerequesttool);
        $typerequest = $tzTyperequesttool[0];
        $tztyperequest = explode('_',$typerequest);
        $isnewtyperequest = $tztyperequest[0];
        $valtyperequest = $tztyperequest[1];
       

        $toolsconcat = $tzTyperequesttool[1];
       
        $val = "";
        $tztoolsconcat = explode(":",$toolsconcat);
        if($isnewtyperequest == "true") //Type request existant
        {
            for($i = 0; $i < sizeof($tztoolsconcat);$i++){
                $toolid = $tztoolsconcat[$i];
                $type_request_tool = new tool_type_request();
                $type_request_tool->type_request_id = $valtyperequest;
                $type_request_tool->tool_id = $toolid;
                $type_request_tool->save();
               
                
            }
            //DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);    

        }//fin type request existant
        else{
            //echo "valtyperequest=".$valtyperequest."eeee";
            $idtyperequest = DB::table('type_requests')->insertGetId(
                ['name' => $valtyperequest,
                'description' => $description
                ]
            );
            for($i = 0; $i < sizeof($tztoolsconcat);$i++){
                $toolid = $tztoolsconcat[$i];
                $type_request_tool = new tool_type_request();
                $type_request_tool->type_request_id = $idtyperequest;
                $type_request_tool->tool_id = $toolid;
                $type_request_tool->save();
               
                
            }
        }
        //echo "ok";
        //return \App::call('AjaxTypeRequestController@index');
        
       
    }
    public function update(Request $request)
    {  
        //echo "pass store";
        //exit();
        echo $_POST['data'];
        //"true_1|60:63"
        $typerequesttool = $_POST['data'];
        $IdTypeDemande=$_POST['IdTypeDemande'];
        $LibTypeDemande=$_POST['LibTypeDemande']; 
        $Description=$_POST['Description'];
        $tzTyperequesttool = explode("|",$typerequesttool);
        $typerequest = $tzTyperequesttool[0];
        $tztyperequest = explode('_',$typerequest);
        $isnewtyperequest = $tztyperequest[0];
        $valtyperequest = $tztyperequest[1];
       

        $toolsconcat = $tzTyperequesttool[1];
        ///////////////////////////////////////////
        type_request::where('id',$IdTypeDemande)->update(array('name'=>$LibTypeDemande,'description'=>$Description));


        ///////////////////////////////////////////
       
        $val = "";
        $tztoolsconcat = explode(":",$toolsconcat);
        DB::table('type_request_tools')->where('type_request_id', $IdTypeDemande)
        ->delete();
        echo "1";
       
        for($i = 0; $i < sizeof($tztoolsconcat);$i++){
            $toolid = $tztoolsconcat[$i];
            $type_request_tool = new type_request_tool();
            $type_request_tool->type_request_id = $IdTypeDemande;
            $type_request_tool->tool_id = $toolid;
            $type_request_tool->save();
            
            
        }

       
        
        echo "ok";
        //return \App::call('AjaxTypeRequestController@index');
        
       
    }
}
