<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processing extends Model
{
    protected $fillable = [
        'requestwf_id ', 'etat_id', 'owner_request_user_id', 'sender_request_user_id' , 'process_comment', 'is_finished',
    ];
}
