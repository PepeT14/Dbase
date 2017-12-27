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
        //
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
            'telephone' => '666666666',
            'escudo' => 'assets/escudos/marianistas.jpg',
            'country' => 'España',
            'city' => 'Jerez de la Frontera',
            'address' => 'Avenida Cruz Roja, 8',
            'state' => 'Andalucía'
        ]);
    }
}
