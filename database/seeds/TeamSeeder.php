<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //EQUIPO
        DB::table('teams')->insert([
            'name' => 'Paquete U.D B',
            'league_id' => '1',
            'club_id' => '1',
            'category' => 'Pre-Benjamin'
        ]);
        DB::table('teams')->insert([
            'name' => 'Paquete U.D A',
            'league_id' => '1',
            'club_id' => '1',
            'category' => 'Benjamin'
        ]);

        // ESTADIO
        DB::table('stadiums')->insert([
            'name' => 'Manuel Millán',
            'address' => 'Abajo casa el torti',
            'team_id' => 1
        ]);



    }
}
