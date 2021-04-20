<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsMenu extends Model
{
    protected $table = 'permissions_menus';

    protected $fillable = [
        'id', 'roles_id', 'menus_id', 'permissions'
    ];

    public function menu(){
        return $this->belongsTo('App\Menu', 'menus_id');
    }
}
