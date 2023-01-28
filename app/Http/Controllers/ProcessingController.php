<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Pour l'utilisation de mail on utilise le package suivant//
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper as Helper;

use App\Tool;
use App\Requestwf;
use App\Request_history;
use App\User;
use App\validation_request;
use Illuminate\Support\Facades\DB;
use Session;
//====================================//
//use App\Http\Controllers\RequestController;
//====================//
use App\Mail\RequestMail;

class ProcessingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    }

    public function show_processing()
    {
        $data = DB::table('entities')->orderBy('name','asc')->get();
        
            $ListRequestProcessing = DB::table('processings')
            ->join('requestwfs','requestwfs.id','=','processings.requestwf_id')
            ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
            ->join('tools','tools.id', '=', 'requestwfs.tool_id')
            ->select('requestwfs.id as idrequest','processings.id as idprocessings','processings.is_finished as is_finished','requestwfs.subject as Objetwf',
            'requestwfs.user_id as usersourceid','tools.name as toolname','tools.id as idtool','type_requests.id as idtyperequest',
            'type_requests.name as type_requestname',
            'requestwfs.created_at as created_at')
            ->where('processings.is_finished','=',0)
            ->orWhere('processings.is_finished','=',2)
            ->orderBy('processings.id','DESC')
            ->get();       
            
            
            
            //remove the ',' at the end of the variable;
           
            echo "l";
            
            return view('processing.processingrequest', compact('ListRequestProcessing','data'));

    }
    public function processrequest($id)
    {
    
        echo 'param='.$id;
        $entityid_userconnected = Session::get('s_entityid_user');
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        echo "request_history_id =".$request_history_id;
        $currentrank = validation_request::getCurrentRank(8,60,1);
        echo "rang=".$currentrank;
        
        $maxrank = validation_request::getMaxRank(60,1);
        echo "maxrang=".$maxrank;
        $nextentityapprouv = validation_request::getNextEntityApprouv(60,1,$currentrank);
        $req_histories = DB::table('request_histories')->where('id',$request_history_id)->first();
        echo "nextentityapprouv=".$nextentityapprouv;
        
        $id = DB::table('processings')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            'etat_id' => 2,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $req_histories->sender_request_user_id,
            'process_comment' => 'La résultat de votre demande est envoyée par mail', 
            'is_finished' => 0]
        );

        DB::table('processings')
        ->where('requestwf_id', $request_id)
        
        ->update(['is_finished' => 1]);

        DB::table('requestwfs')
        ->where('requestwf_id', $request_id)
        ->update(['status_id' => 3]);


        echo "valhistories=".$req_histories->owner_request_user_id;
            
        

    }
}
