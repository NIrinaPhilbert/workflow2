<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'name',
    ];


    public static function getLibelleStatusById($statusId){
        $libstatus = "";
        $zLibstyle = "";
        $result = DB::table('statuses')
                    ->where('statuses.id','=',$statusId)
                    ->get();
        foreach($result as $status)
        {
            $libstatus= $status->name;
        }
        
         if($statusId == 1){
            $zLibstyle = '<span class="badge badge-primary">'.$libstatus.'</span>';
         }
         if($statusId == 2){
            $zLibstyle = '<span class="badge badge-info">'.$libstatus.'</span>';
         }
         if($statusId ==3){
            $zLibstyle = '<span class="badge badge-success">'.$libstatus.'</span>';
         }
         if($statusId ==4){
            $zLibstyle = '<span class="badge badge-danger">'.$libstatus.'</span>';
         }
         if($statusId ==5){
            $zLibstyle = '<span class="badge badge-warning">'.$libstatus.'</span>';
         }
         return $zLibstyle;
        
    }
}
