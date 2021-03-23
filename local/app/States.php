<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $fillable = [
        'name', 'description', 'email_id', 'status',
    ];

    public function email(){
        return $this->belongsTo('App\Email', 'email_id');
    }

    public function purchase_valuation()
    {
        return $this->hasMany('App\PurchaseValuation');
    }
}
