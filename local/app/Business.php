<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';

    protected $fillable = [
    	'service_id', 'email_id', 'name','phone', 'address', 'postal_code', 'city', 'province', 'cif',  'email'  
    ];

    public function service(){
        return $this->belongsTo('App\Service', 'service_id');
    }
}
