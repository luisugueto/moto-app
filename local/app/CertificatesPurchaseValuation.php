<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificatesPurchaseValuation extends Model
{
    protected $table = 'certificates_purchase_valuations';

    protected $fillable = [
    	'name', 'purchase_valuation_id'
    ];

    public function purchase_valuation(){
        return $this->belongsTo('App\PurchaseValuation', 'purchase_valuation_id');
    }
}
