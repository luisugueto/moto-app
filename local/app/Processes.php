<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processes extends Model
{
    protected $fillable = [
        'name', 'description', 'status', 'destiny'
    ];
}
