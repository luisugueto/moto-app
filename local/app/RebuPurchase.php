<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RebuPurchase extends Model
{
    protected $table = 'rebu_purchases';
    
    protected $fillable = [
        'purchase_valuation_id', 'name', 'price'
    ];

    public function purchase_valuation(){
        return $this->belongsTo('App\PurchaseValuation', 'purchase_valuation_id');
    }
}
