<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waste = [
            
        	[
                'name' => 'Baterias Usadas',
            ],
            [
                'name' => 'Filtros Aceite',
            ],
            [
                'name' => 'Aceite Caja',
            ],
            [
                'name' => 'Anticongelante',
            ],
            [
                'name' => 'Liquido Frenos',
            ],
            [
                'name' => 'Metales No Férricos',
            ],
            [
                'name' => 'Metales Ferricos',
            ],
            [
                'name' => 'Disolvente Orgánico No Halogenado',
            ],
            [
                'name' => 'Trapos Contaminados',
            ],
            [
                'name' => 'Envases Plásticos Contaminados',
            ],
            [
                'name' => 'Neumáticos',
            ]

        ];

        foreach ($waste as $key => $value) {

        	DB::table('waste')->insert($value);

        }
        
    }
}
