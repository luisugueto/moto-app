<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProcesses extends Model
{
	protected $table = 'subprocesses';
	
    protected $fillable = [
        'name', 'description', 'status', 'id_processes'
    ];
}
