<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentsMailPurchaseValuation extends Model
{
    protected $table = 'documents_mail_purchase_valuations';

    protected $fillable = [
    	'name', 'purchase_valuation_id', 'type', 'send'
    ];

    public function purchase_valuation(){
        return $this->belongsTo('App\PurchaseValuation', 'purchase_valuation_id');
    }
}
 
