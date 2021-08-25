<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residuos extends Model
{
    protected $table = 'residuos';

    protected $fillable = [
        'id_materials', 'delivery', 'in_installation', 'dcs'
    ];

    public function materialC(){
        return $this->belongsTo('App\MaterialsCompanie', 'id_materials');
    }
}
