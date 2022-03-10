<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WasteCompanies extends Model
{
    protected $fillable = [
        'email_id', 'name', 'nif_inst_destination', 'reason_social_inst_destination', 'nima_inst_destination', 'type_via', 'name_via', 'number', 'flat', 'door', 'postal_code', 'location', 'province', 'country', 'authorization_no'
    ];
}
