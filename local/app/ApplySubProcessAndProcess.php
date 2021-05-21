<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplySubProcessAndProcess extends Model
{
    protected $table = 'apply_sub_process_and_processes';

    protected $fillable = [
        'processes_id', 'subprocesses_id', 'purchase_valuation_id'
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
