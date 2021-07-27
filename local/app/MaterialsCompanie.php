<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialsCompanie extends Model
{
    protected $table = 'materials_companies';
    
    protected $fillable = [
        'materials_id', 'waste_companies_id', 'stock',
    ];

}
