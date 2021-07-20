<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidencePurchase extends Model
{
    protected $table = 'incidence_purchases';

    protected $fillable = [
        'processes_id', 'subprocesses_id', 'purchase_valuation_id', 'description'
    ];

    public function processes(){
        return $this->belongsTo('App\Processes', 'processes_id');
    }

    public function subprocesses(){
        return $this->belongsTo('App\SubProcesses', 'subprocesses_id');
    }

    public function purchase_valuation(){
        return $this->belongsTo('App\PurchaseValuation', 'purchase_valuation_id');
    }
}
