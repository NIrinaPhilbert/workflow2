<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestwf_email_address extends Model
{
    protected $fillable = [
        'requestwf_id' , 'reply_email_address_id'
    ];
}
