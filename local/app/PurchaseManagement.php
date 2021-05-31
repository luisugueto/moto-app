<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseManagement extends Model
{
    protected $table = 'purchase_management';
    
    protected $fillable = [
        'purchase_valuation_id','file_no','current_year', 'collection_contract_date','documents_attached','non_existence_document','vehicle_delivers','name','firts_surname','second_surtname','dni','birthdate','phone','email' ,'street','nro_street','stairs','floor','letter','municipality','postal_code','province','iban','sale_amount','name_representantive','firts_surname_representative' ,'second_surtname_representantive','dni_representative','birthdate_representative','phone_representantive','email_representative','representation_concept','brand','model','version','type','kilometres','color','fuel','weight','registration_number','registration_date','registration_country','frame_no','motor_no','vehicle_state_trafic','vehicle_state', 'datos_del_mecanico', 'datos_internos'
    ];

    public function purchase_valuation(){
        return $this->belongsTo('App\PurchaseValuation', 'purchase_valuation_id');
    }
   
}
