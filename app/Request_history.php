<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_history extends Model
{
    protected $fillable = [
        'requestwf_id ', 'etat_id', 'owner_request_user_id', 'sender_request_user_id', 'destination_entity_id', 'history_comment', 'is_finished',
    ];
}
