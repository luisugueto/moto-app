<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinksRegister extends Model
{
    protected $table = 'links_registers';

    protected $fillable = [
    	'token', 'status', 'purchase_valuation_id'
    ];
}
