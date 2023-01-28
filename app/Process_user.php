<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process_user extends Model
{
    protected $fillable = [
        'process_id', 'entity_id' , 'user_id'
    ];
}
