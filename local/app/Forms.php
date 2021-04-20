<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    protected $fillable = [
    	'name', 'form_original', 'form_display', 'status'
    ];
}
