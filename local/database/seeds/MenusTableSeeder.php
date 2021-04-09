<?php
use App\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m1 = factory(Menu::class)->create([
            'name' => 'Administración',
            'slug' => 'administracion',
            'parent' => 0,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Empleados',
            'slug' => 'empleados',
            'parent' => $m1->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Perfiles',
            'slug' => 'perfiles',
            'parent' => $m1->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Permisos',
            'slug' => 'permisos',
            'parent' => $m1->id,
            'order' => 2,
        ]);
        factory(Menu::class)->create([
            'name' => 'Formularios',
            'slug' => 'formularios',
            'parent' => $m1->id,
            'order' => 3,
        ]);
        factory(Menu::class)->create([
            'name' => 'Calendarios',
            'slug' => 'calendarios',
            'parent' => $m1->id,
            'order' => 4,
        ]);

        $m2 = factory(Menu::class)->create([
            'name' => 'Empresas Colaboradoras',
            'slug' => 'empresas-colaboradoras',
            'parent' => 0,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Empresas',
            'slug' => 'empresas',
            'parent' => $m2->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Servicios',
            'slug' => 'servicios',
            'parent' => $m2->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Mensajes',
            'slug' => 'mensajes',
            'parent' => $m2->id,
            'order' => 2,
        ]);
        
        $m3 = factory(Menu::class)->create([
            'name' => 'Gestión de Compras',
            'slug' => 'gestion-compras',
            'parent' => 0,
            'order' => 2,
        ]);
        factory(Menu::class)->create([
            'name' => 'Motos que nos ofrecen',
            'slug' => 'motos-que-nos-ofrecen',
            'parent' => $m3->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Estados',
            'slug' => 'estados-gc',
            'parent' => $m3->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Mensajes',
            'slug' => 'mensajes-gc',
            'parent' => $m3->id,
            'order' => 2,
        ]);
        factory(Menu::class)->create([
            'name' => 'Documentos',
            'slug' => 'documentos-gc',
            'parent' => $m3->id,
            'order' => 3,
        ]);

        $m4 = factory(Menu::class)->create([
            'name' => 'Gestión de Taller',
            'slug' => 'gestion-taller',
            'parent' => 0,
            'order' => 3,
        ]);
        factory(Menu::class)->create([
            'name' => 'Estados',
            'slug' => 'estados-gt',
            'parent' => $m4->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Mensajes',
            'slug' => 'mensajes-gt',
            'parent' => $m4->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Documentos',
            'slug' => 'documentos-gt',
            'parent' => $m4->id,
            'order' => 2,
        ]);
        factory(Menu::class)->create([
            'name' => 'Calendario',
            'slug' => 'calendario-gt',
            'parent' => $m4->id,
            'order' => 3,
        ]);

        $m5 = factory(Menu::class)->create([
            'name' => 'Gestión de Subastas',
            'slug' => 'gestion-subastas',
            'parent' => 0,
            'order' => 4,
        ]);
        factory(Menu::class)->create([
            'name' => 'Estados',
            'slug' => 'estados-gs',
            'parent' => $m5->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Mensajes',
            'slug' => 'mensajes-gs',
            'parent' => $m5->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Documentos',
            'slug' => 'documentos-gs',
            'parent' => $m5->id,
            'order' => 2,
        ]);
        
        $m6 = factory(Menu::class)->create([
            'name' => 'Gestion de Desmontaje',
            'slug' => 'gestion-desmontaje',
            'parent' => 0,
            'order' => 5,
        ]);
        factory(Menu::class)->create([
            'name' => 'Estados',
            'slug' => 'estados-gd',
            'parent' => $m6->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Mensajes',
            'slug' => 'mensajes-gd',
            'parent' => $m6->id,
            'order' => 1,
        ]);

        $m7 = factory(Menu::class)->create([
            'name' => 'Clientes',
            'slug' => 'clientes',
            'parent' => 0,
            'order' => 6,
        ]);
        factory(Menu::class)->create([
            'name' => 'Grupos',
            'slug' => 'grupos',
            'parent' => $m7->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Clientes',
            'slug' => 'clientes-lt',
            'parent' => $m7->id,
            'order' => 1,
        ]);

        $m8 = factory(Menu::class)->create([
            'name' => 'Residuos',
            'slug' => 'residuos',
            'parent' => 0,
            'order' => 7,
        ]);
        factory(Menu::class)->create([
            'name' => 'Envíos Quincenales',
            'slug' => 'envios-quincenales',
            'parent' => $m8->id,
            'order' => 0,
        ]);
        factory(Menu::class)->create([
            'name' => 'Envíos Semestrales',
            'slug' => 'envios-semestrales',
            'parent' => $m8->id,
            'order' => 1,
        ]);
        factory(Menu::class)->create([
            'name' => 'Envíos Anuales',
            'slug' => 'envios-anuales',
            'parent' => $m8->id,
            'order' => 2,
        ]);
        factory(Menu::class)->create([
            'name' => 'Cargar CVS/Formulario',
            'slug' => 'cargar-cvs-formulario',
            'parent' => $m8->id,
            'order' => 3,
        ]);
        $m9 = factory(Menu::class)->create([
            'name' => 'Estadísticas',
            'slug' => 'estadisticas',
            'parent' => 0,
            'order' => 8,
        ]);
    }
}
