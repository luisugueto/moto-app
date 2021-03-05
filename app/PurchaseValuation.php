<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseValuation extends Model
{
    protected $table = 'purchase_valuation';

    protected $fillable = [
    	'date', 'brand', 'model', 'year', 'km', 'email', 'name', 'lastname', 'phone', 'province', 'status_trafic', 'g_del', 'g_tras', 'av_elec', 'av_mec', 'old', 'price_min', 'observations', 'status' 
    ];
}
