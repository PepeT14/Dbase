<?php

use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Equipo
        DB::table('clubs')->insert([
            'name' => 'Paquete U.D',
            'telephone' => '666666666',
            'escudo' => 'assets/escudos/paquete-ud.jpg',
            'country' => 'España',
            'city' => 'Jerez de la Frontera',
            'address' => 'Avenida Lebrija, 8',
            'state' => 'Andalucía'
        ]);

        DB::table('clubs')->insert([
            'name' => 'Marianistas A.D',
            'telephone' => '999999999',
            'escudo' => 'assets/escudos/marianistas.jpg',
            'country' => 'España',
            'city' => 'Jerez de la Frontera',
            'address' => 'Avenida Marianistas, 11',
            'state' => 'Andalucía'
        ]);

        //Instalaciones
        DB::table('instalaciones')->insert([
            ['name' => 'Pista 1','tipo' => 'Fútbol 7', 'club_id' => 1],
            ['name' => 'Pista 2','tipo' => 'Fútbol 7', 'club_id' => 2],
            ['name' => 'Pista 3','tipo' => 'Fútbol 11', 'club_id' => 1],
            ['name' => 'Pista 4','tipo' => 'Fútbol sala', 'club_id' => 2]
        ]);

        //Material
        DB::table('club_materials')->insert([
            ['cantidad' => 25,'stock' => 25, 'type' => 'Balones', 'subtype' => 'Fútbol 11','club_id' => 1],
            ['cantidad' => 30,'stock' => 25, 'type' => 'Balones', 'subtype' => 'Fútbol 7','club_id' => 2],
            ['cantidad' => 50,'stock' => 25, 'type' => 'Conos', 'subtype' => 'Rojos','club_id' => 1],
            ['cantidad' => 30,'stock' => 25, 'type' => 'Petos', 'subtype' => 'Pequeños','club_id' => 2],
            ['cantidad' => 30,'stock' => 25, 'type' => 'Petos', 'subtype' => 'Grandes','club_id' => 1],
        ]);
    }
}
