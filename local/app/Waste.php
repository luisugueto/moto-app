<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    protected $table = 'waste';

    protected $fillable = [
        'name'
    ];
}
