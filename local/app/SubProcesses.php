<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProcesses extends Model
{
	protected $table = 'subprocesses';
	
    protected $fillable = [
        'name', 'description', 'status', 'processes_id', 'email_id', 'business_id'
    ];

    public function email(){
        return $this->belongsTo('App\Email', 'email_id');
    }
}
