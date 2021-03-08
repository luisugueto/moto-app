<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
