<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'status',
    ];

    public function business()
    {
        return $this->hasMany('App\Business');
    }
}
