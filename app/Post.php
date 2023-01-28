<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Relation one to Many : Un post appartient à un seul utilisateur
    protected $fillable = ['title','content']; //Champ autorisable à remplir 
    // protected $guarded = [] 2e option $fillable
    public function user()
    {
        return $this->belongsTo('App\User');//Relation one to Many
    
    }
}
