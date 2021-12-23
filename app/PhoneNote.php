<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PhoneNote extends Model
{
    use Searchable;

    protected $fillable = [
        'id',
        'name',
        'number',
        'user_id',
    ];
}
