<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [

        	[

        		'name' => 'record-list',

        		'display_name' => 'Mostrar lista de registros',

        		'description' => 'Mostrar lista de registros'

        	],

        	[

        		'name' => 'record-create',

        		'display_name' => 'Crear registro',

        		'description' => 'Crear nuevo registro'

        	],

        	[

        		'name' => 'record-edit',

        		'display_name' => 'Editar registro',

        		'description' => 'Editar registro'

        	],

        	[

        		'name' => 'record-delete',

        		'display_name' => 'Eliminar el registro',

        		'description' => 'Eliminar el registro'

        	],

        	[

        		'name' => 'record-view',

        		'display_name' => 'Ver registro',

        		'description' => 'Ver registro'

        	]

        ];


        foreach ($permission as $key => $value) {

        	Permission::create($value);

        }
    }
}
