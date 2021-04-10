<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role = [

        	[

        		'name' => 'admin',

        		'display_name' => 'Administrador',

        		'description' => 'Administrador'

        	],

        	[

        		'name' => 'user',

        		'display_name' => 'Usuario',

        		'description' => 'Usuario'

        	]
        ];

        foreach ($role as $key => $value) {

        	Role::create($value);

        }

    }
}
