<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $fillable = [
        'LER', 'code', 'valorization','description','unit_of_measurement', 'percent_formula', 'fix_value','type'
    ];

    public function materials(){
        return $this->hasMany('App\MaterialsCompanie', 'materials_id', 'id');
    }
}


