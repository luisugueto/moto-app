<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseValuation extends Model
{
    protected $table = 'purchase_valuation';

    protected $fillable = [
    	'date', 'brand', 'model', 'year', 'km', 'email', 'name', 'lastname', 'phone', 'province', 'status_trafic', 'motocycle_state', 'price_min', 'observations', 'states_id', 'data_serialize', 'exist_model_brand', 'documents_destruction', 'destruction_code', 'destruction_deceased', 'destruction_code', 'possible_sale', 'possible_sale_code', 'possible_sale_deceased', 'sale_deceased_code'
    ];

    public function state(){
        return $this->belongsTo('App\States', 'states_id');
    }

    public function purchase_management(){
        return $this->hasMany('App\PurchaseManagement');
    }

    public function incidences(){
        return $this->hasMany('App\IncidencePurchase', 'purchase_valuation_id', 'id');
    }
}
