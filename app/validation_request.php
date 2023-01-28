<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class validation_request extends Model
{
    protected $fillable = [
        'type_request_id', 'tool_id', 'entity_id', 'rank',
    ];

    public static function getFirstEntityValidator($toolId,$typeRequestId){
        
        /*$validation_request = validation_request::where('type_request_id',$typeRequestId)
        ->where('tool_id',$toolId)
        ->where('rank',1)
        ->get();*/
        $zEntityValidator = '';
        
        $FirstEntityValidation = DB::table('validation_requests')
                            ->join('entities','entities.id', '=', 'validation_requests.entity_id')
                            ->where('tool_id',$toolId)
                            ->where('rank',1)
                            ->get();   
        foreach($FirstEntityValidation as $vr){
            $entity_id = $vr->id.'_'.$vr->name;
        }
        return $entity_id;
    }

    public static function getCurrentRank($entityid,$toolid,$typerequestid){
        /*$getRank = DB::table('validation_requests')
                    ->where('entity_id',$entityid)
                    ->where('tool_id',$toolid)
                    ->where('type_request_id',$typequestid)
                    ->get();
        foreach($getRank as $vrank){
            $rank = $vrank->rank;
        }*/
        $zRangMax2 = "select validation_requests.rank from validation_requests where entity_id=".$entityid." and type_request_id=".$typerequestid." and tool_id =".$toolid."";
        
        $vrank = 0;
        $getRank = DB::select($zRangMax2);
        foreach($getRank as $vrank1){
            $vrank = $vrank1->rank;
        }
        return $vrank;       
    }
    public static function getMaxRank($toolid,$typerequestid){
        $zRangMax = "select MAX(validation_requests.rank) as rangmax from validation_requests where type_request_id=".$typerequestid." and tool_id =".$toolid."";
        //echo "zrangMax=".$zRangMax;
        $toRang = DB::select($zRangMax);
        foreach($toRang as $vrank2){
            $maxrang = $vrank2->rangmax;
        }
        return $maxrang;
    }
    public static function getNextEntityApprouv($toolid,$typequestid,$currentrank){
        $nextrank = $currentrank+1;
        $getEntity = DB::table('validation_requests')
                    ->where('rank',$nextrank)
                    ->where('tool_id',$toolid)
                    ->where('type_request_id',$typequestid)
                    ->get();
        foreach($getEntity as $ventity){
            $entityid = $ventity->entity_id;
        }
        return $entityid;       
    }
    public static function getRemainingEntityList($toolid,$typerequestid,$currentrank,$maxrank)
    {
        $zRemainingEntity = "";
        $getRemainingEntityList = DB::table('validation_requests')
        ->join('entities','entities.id', '=', 'validation_requests.entity_id')
        ->where('tool_id',$toolid)
        ->where('type_request_id',$typerequestid)
        ->where('rank','>',$currentrank)
        ->where('rank','<',$maxrank+1) 
        ->select('entities.name as entity_name')
        ->get();

        foreach($getRemainingEntityList as $remain){
            if($zRemainingEntity == "") $zRemainingEntity = $zRemainingEntity."".$remain->entity_name;
            else $zRemainingEntity =  $zRemainingEntity.",".$remain->entity_name;
        }
        return $zRemainingEntity;
        
    }
   
}
