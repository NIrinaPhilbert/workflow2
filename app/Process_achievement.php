<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Process_achievement extends Model
{
    protected $fillable = [
        'process_id', 'user_id' , 'achievement_comment', 'process_achievement_date'
    ];

    public static function getListProcessAchievementByProcessId($idprocess){
        $ListProcessAchievementbyProcessId = DB::table('process_achievements')
        ->where('process_achievements.process_id',$idprocess)
        ->orderBy('process_achievements.id','DESC')
        ->get();   
       return $ListProcessAchievementbyProcessId;
    }
    public static function getListProcessAchievementByrequesId($idrequest){
        $ListProcessAchievementbyRequestId = DB::table('process_achievements')
        ->join('processings','processings.id', '=', 'process_achievements.process_id')
        ->where('processings.requestwf_id',$idrequest)
        ->select('process_achievements.id as achievementid','user_id as achievementiduser','process_achievements.process_achievement_date as achievementdate','process_achievements.process_achievement_comment as achievementcomment')
        ->orderBy('process_achievements.id','DESC')
        ->get();   
       return $ListProcessAchievementbyRequestId;
    }
}
