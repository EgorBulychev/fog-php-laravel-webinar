<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNote extends Model
{
    protected $fillable = [
        'id',
        'name',
        'number',
        'user_id',
    ];
}
