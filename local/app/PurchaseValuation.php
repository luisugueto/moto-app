<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseValuation extends Model
{
    protected $table = 'purchase_valuation';

    protected $fillable = [
    	'date', 'brand', 'model', 'year', 'km', 'email', 'name', 'lastname', 'phone', 'province', 'status_trafic', 'motocycle_state', 'price_min', 'observations', 'states_id', 'subprocesses_id', 'data_serialize'
    ];

    public function state(){
        return $this->belongsTo('App\States', 'states_id');
    }

    public function subprocesses(){
        return $this->belongsTo('App\SubProcesses', 'subprocesses_id');
    }

    public function purchase_management(){
        return $this->hasMany('App\PurchaseManagement');
    }
}
