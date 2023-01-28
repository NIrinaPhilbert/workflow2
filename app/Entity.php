<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class Entity extends Model
{
    protected $fillable = ['entity_id','name','description','status'];

    public function EntityParent(){
        return $this->belongsTo('App\Entity');
    }
    public function entity(){
        return $this->belongsTo('App\Entity');
    }
    public function EntityFils(){
        return $this->hasMany('App\Entity');
    }
    public function users(){
        return $this->hasMany('App\User');
    }

    public static function getNameEntityById($entityId){
        $zEntName = "";
        $resultEnt = DB::table('entities')->where('id', $entityId)
        ->get();
        foreach($resultEnt as $oEnt){
            $zEntName = $oEnt->name;
        }
       
        return $zEntName;
    }

    public static function getListEntityByTypeRequestIDToolID($TypeRequestID,$ToolID){

        $ListRequestbyentity = DB::table('request_histories')
        ->join('entities','entities.id', '=', 'request_histories.destination_entity_id')
        ->join('requestwfs','requestwfs.id', '=', 'request_histories.requestwf_id')  
        ->where('requestwfs.tool_id',$ToolID)
        ->where('requestwfs.type_request_id',$TypeRequestID)
        ->orderBy('entities.name','ASC')
        ->select('request_histories.destination_entity_id as entityid','entities.name as entityname') 
        ->distinct('entities.name')  
        ->get();   

       
        $zContenuSelect = "";
        foreach($ListRequestbyentity as $oEntity){
            $zContenuSelect = $zContenuSelect."<option value=".$oEntity->entityid.">".$oEntity->entityname."</option>";
        }
        
        return $zContenuSelect;
       
    }
    public static function getListEntityByTypeEntEntiteParentID($TypeEntID,$EntityParentID){

        $ListEntity = DB::table('entities')
        ->where('entities.level_id',$TypeEntID)
        ->where('entities.entity_id',$EntityParentID)
        ->orderBy('entities.name','ASC')
        ->select('entities.id as entityid','entities.name as entityname') 
        ->distinct('entities.name')  
        ->get();   

       
        $zContenuSelect = "";
        foreach($ListEntity as $oEntity){
            $zContenuSelect = $zContenuSelect."<option value=".$oEntity->entityid.">".$oEntity->entityname."</option>";
        }
        
        return $zContenuSelect;
       
    }

    public static function getListEntityInProcessByTypeRequestIDToolID($TypeRequestID,$ToolID){
        $ListRequestbyentity = DB::table('process_users')
        ->join('entities','entities.id', '=', 'process_users.entity_id')
        ->join('processings','processings.id', '=', 'process_users.process_id')
        ->join('requestwfs','requestwfs.id', '=', 'processings.requestwf_id')  
        ->where('requestwfs.tool_id',$ToolID)
        ->where('requestwfs.type_request_id',$TypeRequestID)
        ->orderBy('entities.name','ASC')
        ->select('process_users.entity_id as entityid','entities.name as entityname') 
        ->distinct('process_users.entity_id')  
        ->get();   

       
        
       
        $zContenuSelect = "<option value='0'>Choisir entite</option>";
        foreach($ListRequestbyentity as $oEntity){
            $zContenuSelect = $zContenuSelect."<option value=".$oEntity->entityid.">".$oEntity->entityname."</option>";
        }
        
        return $zContenuSelect;
    }
   
}
