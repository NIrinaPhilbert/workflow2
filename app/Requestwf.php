<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requestwf extends Model
{
    //
    protected $fillable = ['user_id','tool_id','type_request_id','subject','content','status_id'];

    public function tool(){
        return $this->belongsTo('App\Tool');
    }

    public function type_request(){
        return $this->belongsTo('App\type_request');
    }

    public static function getListRequestByEntity($entity_id)
    {
        $ListRequestbyentity = DB::table('requestwfs')
        ->join('users','users.id', '=', 'requestwfs.user_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','users.name as username','tools.name as toolname','type_requests.name as type_requestname','statuses.id as statusid','statuses.name as status','requestwfs.created_at as created_at')
        ->where('users.entity_id',$entity_id)
        ->orderBy('requestwfs.id','DESC')
        ->get();   
       return $ListRequestbyentity;

    }
    public static function getRequestById($id){
        $RequestbyId = DB::table('requestwfs')
        ->join('users','users.id', '=', 'requestwfs.user_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','requestwfs.content as content','requestwfs.user_id as userid','users.name as username','users.email as useremail', 'tools.name as toolname','type_requests.name as type_requestname','statuses.id as statusid','statuses.name as status','requestwfs.created_at as created_at')
        ->where('requestwfs.id',$id)
        ->get();   
       return $RequestbyId;
    }

    public static function getListRequestPendingByEntity($entity_id)
    {
        $ListRequestPendingbyentity = DB::table('request_histories')
        ->join('users','users.id', '=', 'requestwfs.user_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','users.name as username','tools.name as toolname','type_requests.name as type_requestname','statuses.name as status','requestwfs.created_at as created_at')
        ->where('users.entity_id',$entity_id)
        ->orderBy('requestwfs.id','DESC')
        ->orderBy('requestwfs.id','DESC')
        ->get();   
        $users = DB::table('request_histories')
        -join('requestwfs','requestwfs.id','=','request_histories.requestwfs_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','users.name as username','tools.name as toolname','type_requests.name as type_requestname','statuses.name as status','requestwfs.created_at as created_at')
        ->where([['is_finished', '=', '0'],['destination_entity_id', '<>', $entity_id], ])
        ->groupBy('browser')
        ->orderBy('requestwfs.id','DESC')
        ->get();
       return $ListRequestbyentity;

    }

    public static function getListAllRequestInProcess()
    {
        $ListRequest = DB::table('processings')
        ->join('requestwfs','requestwfs.id','=','processings.requestwf_id')
        ->join('users','users.id', '=', 'requestwfs.user_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->groupBy('requestwfs.id')
        ->orderBy('requestwfs.id','DESC')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','users.name as username','tools.name as toolname','type_requests.name as type_requestname','statuses.id as statusid','statuses.name as status','requestwfs.created_at as created_at')
        ->get();   
       return $ListRequest;

    
    }
    public static function getListRequestByStatusProcess(){
        $ListRequest = DB::table('requestwfs')
        ->orderBy('requestwfs.id','DESC')
        ->get();
        $iNmbreEnreg = $ListRequest->count();
        $zRowTable = '';
        foreach($ListRequest as $requestwf){
            $zRowTable .= '' 
            .'<tr class="item-tr">
                <td><a href="">'.$requestwf->id.'</td>
                <td>'.$requestwf->subject.'</td>
                <td>'.$requestwf->tool_id.'</td>
                <td>'.$requestwf->type_request_id.'</td>
                <td>'.$requestwf->status_id.'</td>
                <td>'.$requestwf->created_at.'</td>
                <td><a href=""><i class="fas fa-eye text-primary"></i></a>                      
                </td>
            </tr>';
        }
        return $iNmbreEnreg.'_'.$zRowTable;
    }
}