<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['phone_number'];// Champ rempli automatiquement (on le mets dans un tableau)

    public function user(){
        return $this->belongsTo('App\user');
    }
}
