<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'name', 'description','status',
    ];

    public function type_requests()
    {
        return $this->belongsToMany('App\type_request')->withTimestamps();
        
    }
    public function Requestwfs(){
        return $this->hasMany('App\Requestwf');
    }
}
