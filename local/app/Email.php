<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    protected $fillable = [
    	'name', 'subject', 'content', 'type'
    ];

    public function states()
    {
        return $this->hasMany('App\States');
    }
}
