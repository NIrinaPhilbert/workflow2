<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Etat extends Model
{
    protected $fillable = [
        'name',
    ];


    public static function getLibelleEtatById($etatId){
        $libetat = "";
        $result = DB::table('etats')
                    ->where('etats.id','=',$etatId)
                    ->get();
        foreach($result as $etat)
        {
            $libetat= $etat->name;
        }
        return $libetat;
    }

    public static function getLibelleEtatTraitementById($etatId){
        $libetat = "";
        $zLibstyle = "";
        $result = DB::table('etats')
                    ->where('etats.id','=',$etatId)
                    ->get();
        foreach($result as $etat)
        {
            $libetat= $etat->name;
        }
        
         if($etatId == 1){
            $zLibstyle = '<span class="badge badge-primary">'.$libetat.'</span>';
         }
         if($etatId == 2){
            $zLibstyle = '<span class="badge badge-info">'.$libetat.'</span>';
         }
         if($etatId == 3){
            $zLibstyle = '<span class="badge badge-info">'.$libetat.'</span>';
         }
         if($etatId == 4){
            $zLibstyle = '<span class="badge badge-success">'.$libetat.'</span>';
         }
         if($etatId == 5){
            $zLibstyle = '<span class="badge badge-danger">'.$libetat.'</span>';
         }
         return $zLibstyle;
        
    }
}
