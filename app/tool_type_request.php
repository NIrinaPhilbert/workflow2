<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tool_type_request extends Model
{
    protected $table = 'tool_type_request'; //type the table name
    protected $fillable = ['type_request_id', 'tool_id'];
}
