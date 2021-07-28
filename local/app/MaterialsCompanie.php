<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialsCompanie extends Model
{
    protected $table = 'materials_companies';
    
    protected $fillable = [
        'materials_id', 'waste_companies_id', 'stock',
    ];

    public function waste_companie(){
        return $this->belongsTo('App\WasteCompanies', 'waste_companies_id');
    }

    public function material(){
        return $this->belongsTo('App\Materials', 'materials_id');
    }

}
