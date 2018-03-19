<?php

use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('leagues')->insert([
            'name' => 'Tercera Andaluza',
            'state' => 'Andalucía',
            'province' => 'Cádiz',
            'category' => 'Pre-Benjamin',
        ]);

        //PARTIDOS
        DB::table('matchs')->insert([
            ['jornada'=>1,'title'=>'Paquete U.D A - Paquete U.D B','start'=>'2018-01-27 10:00','end' => '2018-01-27 12:00','league_id' => 1]
        ]);

    }
}
