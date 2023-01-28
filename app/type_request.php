<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class type_request extends Model
{
    //
    protected $fillable = [
        'name', 'description',
    ];
    public function tools()
    {
        return $this->belongsToMany('App\Tool')->withTimestamps();

    }
    public function Requestwfs(){
        return $this->hasMany('App\Requestwf');
    }
    public static function approbationTypeRequest($_iTyPeRequestId){
        $zSqlDetailCommande = "SELECT * FROM validation_requests WHERE id=" . $_iTyPeRequestId ;
        $toDetailCommande = DB::select($zSqlDetailCommande); ; 
        return $toDetailCommande ;
    }
    public static function viewListApprobationByTypeRequestTool($typeRequestId,$toolId){
        $zSqlApprobation = "SELECT `validation_requests`.*,`type_requests`.name as type_request_name,`tools`.name as tool_name, `entities`.name as entity_name, `validation_requests`.rank  as rank FROM `validation_requests` 
        inner join `type_requests` on `validation_requests`.`type_request_id`= `type_requests`.id 
        inner join `tools` on `validation_requests`.tool_id = `tools`.id 
        inner join `entities` on `validation_requests`.entity_id = `entities`.id 
        where `type_request_id` = ".$typeRequestId." and `tool_id` = ".$toolId." order by `type_requests`.name ,`tools`.name,`validation_requests`.rank";
        $toApprobation = DB::select($zSqlApprobation);
        return $toApprobation;
        
    }
    public static function getTypeRequestByIdTool($toolId){
        
        $typeRequestByToolId = DB::table('tool_type_request')
                                ->join('type_requests','tool_type_request.type_request_id','=','type_requests.id')
                                ->select('tool_type_request.*', 'type_requests.name as type_request_name')
                                ->where('tool_type_request.tool_id','=',$toolId)
                                ->orderByRaw('type_request_name')
                                ->get();
       
        return $typeRequestByToolId;
    }
    public static function getToolByIdTypeRequest($TypeRequestId){
        
        $toolByTypeRequestId = DB::table('tool_type_request')
                                ->join('tools','tool_type_request.tool_id','=','tools.id')
                                ->select('tool_type_request.*', 'tools.id as tool_id','tools.name as tool_name')
                                ->where('tool_type_request.type_request_id','=',$TypeRequestId)
                                ->orderByRaw('tool_name')
                                ->get();
       
        return $toolByTypeRequestId;
    }
    public static function viewListApprobation(){
        $approbation = DB::table('validation_requests')
        ->join('type_requests', 'validation_requests.type_request_id', '=', 'type_requests.id')
        ->join('tools', 'validation_requests.tool_id', '=', 'tools.id')
        ->join('entities','validation_requests.entity_id', '=', 'entities.id')
        ->select('validation_requests.*', 'type_requests.name as type_request_name','tools.name as tool_name', 'entities.name as entity_name') 
        ->orderByRaw('type_request_name,tool_name,rank')
        ->get();
        return $approbation;
    }
    public static function deleteApprobation($_ityperequest,$_itool){
        $zSqlSupprDetailCommande = "DELETE FROM validation_requests WHERE type_request_id=".$_ityperequest." and tool_id=". $_itool ; 
        $zQuerySupprDetailCommande = DB::select($zSqlSupprDetailCommande) ;
    }
}
